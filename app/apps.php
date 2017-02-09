<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/tamagotchi.php";
    session_start();
    if (empty($_SESSION['tamagotchi'])) {
        $_SESSION['tamagotchi']= new Tamagotchi();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app->post('/name', function () use($app) {
        $_SESSION['tamagotchi']->setName($_POST['name']);
        return $_SESSION['tamagotchi']->lifeDetermine($app);

    });

    $app->get('/', function() use ($app) {
        return $app['twig']->render('/hatch.html.twig');
    });

    $app->post('/nutrition', function() use ($app) {
        $_SESSION['tamagotchi']->useNutrition();
        return $_SESSION['tamagotchi']->lifeDetermine($app);
    });

    $app->post('/treats', function() use ($app) {
        $_SESSION['tamagotchi']->useTreats();
        return $_SESSION['tamagotchi']->lifeDetermine($app);
    });

    $app->post('/play', function() use ($app) {
        $_SESSION['tamagotchi']->usePlay();
        return $_SESSION['tamagotchi']->lifeDetermine($app);
    });

    $app->post('/bathe', function() use ($app) {
        $_SESSION['tamagotchi']->useBathe();
        return $_SESSION['tamagotchi']->lifeDetermine($app);
    });

    $app->post('/medicine', function() use ($app) {
        $_SESSION['tamagotchi']->useMedicine();
        return $_SESSION['tamagotchi']->lifeDetermine($app);
    });

    $app->post('/restart', function() use ($app) {
        $_SESSION['tamagotchi'] = new Tamagotchi();
        return $_SESSION['tamagotchi']->lifeDetermine($app);
    });

    $app->get('/time', function() use ($app) {
        $depletion = array('elapsedTime' => $_SESSION['tamagotchi']->elapsedTime(), 'filth' => $_SESSION['tamagotchi']->getFilth(), 'hunger' => $_SESSION['tamagotchi']->getHunger());
        return json_encode($depletion);

    });

    return $app;

?>

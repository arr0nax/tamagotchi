<?php
    Class Tamagotchi {
        private $love;
        private $health;
        private $happiness;
        private $nutrition;
        private $medicine;

        function __construct() {
            $this->love = 50;
            $this->health = 50;
            $this->happiness = 50;
            $this->nutrition = 20;
            $this->medicine = 5;
        }

        function getLove() {
            return $this->love;
        }

        function setLove($love) {
            $this->love = $love;
        }

        function getHealth() {
            return $this->health;
        }

        function setHealth($health) {
            $this->health = $health;
        }

        function getHappiness() {
            return $this->happiness;
        }

        function setHappiness($happiness) {
            $this->happiness = $happiness;
        }

        function getNutrition() {
            return $this->nutrition;
        }

        function setNutrition($nutrition) {
            $this->nutrition = $nutrition;
        }

        function useNutrition() {
            if ($this->nutrition > 0) {
                $this->nutrition -= 1;
                $this->happiness -= 3;
                $this->health += 5;
                if ($this->health >= 100) {
                    $this->health = 100;
                    $this->happiness -= 20;
                }
            }
        }

        function useTreats() {
            if ($this->health > 0) {
                $this->health -= 8;
                $this->happiness += 8;
                $this->love += 4;
            }
        }

        function usePlay() {
            $this->happiness += 2;
            $this->love += 5;
        }

        function useBathe() {
            $this->health += 2;
            $this->happiness -= 1;
            $this->love += 2;
        }

        function useMedicine() {
            if ($this->health < 30){
                $this->happiness -= 5;
                $this->health += 10;
                $this->medicine -= 1;
            }
        }


        function lifeDetermine($app) {
            if ($this->health <= 0 || $this->happiness <= 0) {
                return $app['twig']->render('dead.html.twig');
            }
            else {
                return $app['twig']->render('root.html.twig', array('tamagotchi' => $_SESSION['tamagotchi']));
            }
        }
    }

?>

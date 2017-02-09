<?php
    Class Tamagotchi {
        private $name;
        private $love;
        private $health;
        private $happiness;
        private $hunger;
        private $nutrition;
        private $medicine;
        private $mood;
        private $start_time;
        private $flith;

        function __construct() {
            $this->name = "";
            $this->love = 50;
            $this->health = 50;
            $this->happiness = 50;
            $this->hunger = 50;
            $this->nutrition = 20;
            $this->medicine = 5;
            $this->mood = 50;
            $this->filth = 0;
            $this->start_time = time();
        }
        function getName() {
            return $this->name;
        }

        function setName($name) {
            $this->name = $name;
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

        function getHunger() {
            return $this->hunger;
        }

        function setHunger($hunger) {
            $this->hunger = $hunger;
        }

        function getNutrition() {
            return $this->nutrition;
        }

        function setNutrition($nutrition) {
            $this->nutrition = $nutrition;
        }

        function getStartTime() {
            return $this->start_time;
        }

        function setStartTime($start_time) {
            $this->start_time = $start_time;
        }

        function elapsedTime() {
            $this->filth += 1;
            $this->hunger += 1;
            return time() - $this->start_time;
        }

        function useNutrition() {
            if ($this->nutrition > 0) {
                $this->nutrition -= 1;
                $this->happiness -= 3;
                $this->health += 5;
                $this->hunger -= 10;
                if ($this->health >= 100) {
                    $this->health = 100;
                    $this->happiness -= 20;
                }
                if ($this->hunger < 0) {
                    $this->happiness -= -$this->hunger;
                    $this->love -= 20;
                    $this->health -= 10;
                }
            }
        }

        function useTreats() {
            if ($this->health > 0) {
                $this->health -= 8;
                $this->happiness += 8;
                $this->hunger -=1;
                $this->love += 4;
                $this->filth += 3;
            }
        }

        function usePlay() {
            $this->happiness += 2;
            $this->love += 5;
            $this->hunger += 5;
            $this->filth += 5;
        }

        function useBathe() {
            $this->health += 2;
            $this->happiness -= 1;
            $this->love += 2;
            $this->filth -= 75;
            if ($this->filth <= 0) {
                $this->filth = 0;
            }
        }

        function useMedicine() {
            if ($this->health < 30){
                $this->happiness -= 5;
                $this->health += 10;
                $this->medicine -= 1;
                $this->hunger += 5;
                $this->love -= 10;
            }
        }

        function getMood() {
            return $this->mood;
        }

        function setMood($mood) {
            $this->mood = $mood;
        }

        function getFilth() {
            return $this->filth;
        }

        function determineMood() {
            $total = $this->happiness + $this->love/2 + $this->health/2;

            if ($this->health < 30) {
                return "sick";
            } elseif ($this->hunger > 50) {
                return "hungry";
            } elseif ($total > 150) {
                return "happy";
            } elseif ($total >= 100) {
                return "content";
            } elseif ($total < 60) {
                return "suicidal";
            } elseif ($total < 100) {
                return "sad";
            }

        }


        function lifeDetermine($app) {
            if (($this->health <= 0 || $this->happiness <= 0)||($this->hunger > 100)) {
                return $app['twig']->render('dead.html.twig');
            }
            else {
                return $app['twig']->render('root.html.twig', array('tamagotchi' => $_SESSION['tamagotchi']));
            }
        }
    }

?>

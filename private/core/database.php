<?php 

    class Fruit {
        protected $name;

        public function get_details(){
            echo "Name: " . $this->name . "\n";
        }
    }

    $apple = new Fruit();
    $apple->name = "Apple";
    $apple->get_details();
<?php

class Fruit {
    protected $name;

    public function setName($name) {
        $this->name = $name;
    }

    public function get_details(){
        // echo "Name: " . $this->name . "\n";
    }
}

$apple = new Fruit();
// $apple->setName("Apple");
$apple->get_details();
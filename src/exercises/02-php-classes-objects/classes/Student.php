<?php 

class Student {
    protected $name;
    protected $number;

    public function __construct($name, $number) {
        $this->name = $name;
        $this->number = $number;

        if (empty($number)) {
            throw new Exception("Enter a student number");
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getNumber() {
        return $this->number;
    }
}
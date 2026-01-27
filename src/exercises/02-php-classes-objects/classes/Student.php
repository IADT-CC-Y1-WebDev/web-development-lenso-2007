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

        echo "Creating student: " . $this->name . "<br>" . "<br>";
    }

    public function getName() {
        return $this->name;
    }

    public function getNumber() {
        return $this->number;
    }

    public function __toString() {
        $format = "Student name: %s, number: %s" . "<br>";
        return sprintf($format, $this->name, $this->number);
    }

    public function __destruct() {
        echo "Student " . $this->name . " has left the system<br><br>";
    }
}
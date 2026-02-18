<?php 

class Student {
    protected $name;
    protected $number;

    private static $students = [];

    public function __construct($name, $number) {
        $this->name = $name;
        $this->number = $number;

        if (empty($number)) {
            throw new Exception("Enter a student number");
        }

        self::$students[$this->number] = $this;

        echo "Creating student: " . $this->name . "<br>" . "<br>";
    }

    public function getName() {
        return $this->name;
    }

    public function getNumber() {
        return $this->number;
    }

    public static function getCount() {
        return count(self::$students);
    }

    public static function findAll() {
        return self::$students;
    }

    public static function findByNumber($num) {
        return self::$students[$num] ?? null;
    }

    public function __toString() {
        $format = "Student: %s, Number: %s";
        return sprintf($format, $this->name, $this->number);
    }

    public function leave() {
        unset(self::$students[$this->number]);
    }

    public function __destruct() {
        echo "Student {$this->name} has been destroyed<br><br>";
    }
}
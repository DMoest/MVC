<?php
/**
 * Testing class definition & class properties.
 * Class Person1.
 */
include(__DIR__ . "/../config.php");

/**
 * Showing example of class and its methods & properties.
 * Class Person1
 */
class Person1
    {
    /**
     * @var string $name    The name of person1
     * @var int $age        The age of person1
     */
    public $name;
    public $age;

    /**
     * Prints details about person1.
     * @return string
     */
    public function details() {
        return "My name is {$this->name} and I am {$this->age} years old. ";
    }
}

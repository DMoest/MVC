<?php
/**
 * Testing class definition & class properties.
 * Class Person2.
 */
include(__DIR__ . "/../config.php");

/**
 * Showing example of class and its methods & properties.
 * Class Person2
 */
class Person2
    {
    /**
     * @var string $name    The name of person2
     * @var int $age        The age of person2
     */
    private $name;
    private $age;

    /**
     * Prints details about person2
     * @return string
     */
    public function details() {
    return "My name is {$this->name} and I am {$this->age} years old. ";
    }
}

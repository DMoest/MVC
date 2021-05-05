<?php
/**
 * Testing getters & setters for class.
 * Class Person3.
 */
include(__DIR__ . "/../config.php");

/**
 * Showing example of getters and setters for private properties.
 * Class Person3
 */
class Person3
    {
    /**
     * @var string $name    The name of person3.
     * @var int $age        The age of person3.
     */
    private $name;
    private $age;

    /**
     * Setter for the name of person3.
     *
     * @param string $name      The name of person3.
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Settter for the age of Person3
     *
     * @param int $age      The age of person3.
     * @return void
     */
    public function setAge(int $age)
    {
        $this->age = $age;
    }

    /**
     * Getter for the name of person3
     *
     * @return string as the name of person3.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter for the name of person3.
     *
     * @return int as the name of person3.
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Prints details about person3.
     * @return string
     */
    public function details()
    {
        return "My name is {$this->name} and I am {$this->age} years old. ";
    }
}

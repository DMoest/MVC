<?php
/**
 * Testing constructor for class.
 * Class Person4.
 */
include(__DIR__ . "/../config.php");

/**
 * Showing example of class and its methods & properties.
 * Class Person4
 */
class Person4
    {
    /**
     * @var string $name    The name of person4.
     * @var int $age        The age of person4.
     */
    private $name;
    private $age;

    public function __construct(string $name = null, int $age = null)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * Destroy a person.
     */
    public function __destruct()
    {
        echo __METHOD__;
    }

    /**
     * Setter for the name of person4.
     *
     * @param string $name      The name of person4.
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Settter for the age of Person3
     *
     * @param int $age      The age of person4.
     * @return void
     */
    public function setAge(int $age)
    {
        $this->age = $age;
    }

    /**
     * Getter for the name of person4
     *
     * @return string as the name of person4.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter for the name of person4.
     *
     * @return int as the name of person4.
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Prints details about person4.
     * @return string
     */
    public function details()
    {
        return "My name is {$this->name} and I am {$this->age} years old. ";
    }
}

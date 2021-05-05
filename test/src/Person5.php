<?php
/**
 * Testing constructor for class.
 * Class Person5.
 */
include(__DIR__ . "/../config.php");



/**
 * Showing example of class and its methods & properties.
 * Class Person5
 */
class Person5
    {

    /**
     * @var string $name    The name of person5.
     * @var int $age        The age of person5.
     */
    private $name;
    private $age;


    /**
     * Person5 constructor.
     * @param string|null $name
     * @param int|null $age
     * @throws PersonAgeException
     */
    public function __construct(string $name = null, int $age = null)
    {
        /* Throw self defined exception if age is negative */
        if (!(is_int($age) && $age >= 0)) {
            throw new PersonAgeException("Age is only allowed to be a positive integer.");
        }

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
     * Setter for the name of person5.
     *
     * @param string $name      The name of person5.
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


    /**
     * Settter for the age of Person5
     *
     * @param int $age      The age of person5.
     * @return void
     */
    public function setAge(int $age)
    {
        if (!(is_int($age) && $age >= 0)) {
            throw new PersonAgeException("Age is only allowed to be a positive integer.");
        }
        $this->age = $age;
    }


    /**
     * Getter for the name of person5
     *
     * @return string as the name of person5.
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Getter for the name of person5.
     *
     * @return int as the name of person5.
     */
    public function getAge()
    {
        return $this->age;
    }


    /**
     * Prints details about person5.
     * @return string
     */
    public function details()
    {
        return "My name is {$this->name} and I am {$this->age} years old. ";
    }
}

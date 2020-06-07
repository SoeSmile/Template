<?php
declare(strict_types=1);

abstract class Employee
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}

class Minion extends Employee
{
    public function fire()
    {
        print "{$this->name}: я уберу co стола\п";
    }
}

class NastyBoss
{
    private $employees = [];

    public function addEmployee(string $employeeName)
    {
        $this->employees[] = new Minion($employeeName);
    }

    public function projectFails()
    {
        if (count($this->employees) > 0) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}


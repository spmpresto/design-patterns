<?php

// класс создает другой класс

class Worker {
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Worker constructor.
     * @param $name
     */
//    public function __construct(string $name)
//    {
//        $this->name = $name;
//    }


}

class WorkerFactory
{
    public static function make(): Worker
    {
        return new Worker();
    }
}

$worker = WorkerFactory::make();
$worker->setName('Boris');
var_dump($worker->getName());



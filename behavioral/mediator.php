<?php

interface Mediator
{
    public function getWorker();

}


abstract class Worker
{
    private $position;

    /**
     * Worker constructor.
     * @param $position
     */
    public function __construct($position)
    {
        $this->position = $position;
    }

    public function sayHello()
    {
        printf('Hello');
    }

    public function work(): string
    {
        return $this->position. ' is working';
    }
}

class InfoBase
{
    public function printInfo(Worker $worker)
    {
        printf($worker->work());
    }
}

class WorkerInfoBaseMediator implements Mediator
{

    private $worker;
    private $infoBase;

    /**
     * WorkerInfoBaseMediator constructor.
     * @param $worker
     * @param $infoBase
     */
    public function __construct(Worker $worker, InfoBase $infoBase)
    {
        $this->worker = $worker;
        $this->infoBase = $infoBase;
    }

    public function getWorker()
    {
        $this->infoBase->printInfo($this->worker);
    }
}

class Developer extends Worker
{

}

class Designer extends Worker
{

}

$developer = new Developer('developer middle');
$designer = new Designer('designer senior');

$infoBase = new InfoBase();
$workerInfoBaseMadiator = new WorkerInfoBaseMediator($developer, $infoBase);
$workerInfoBaseMadiator2 = new WorkerInfoBaseMediator($designer, $infoBase);


$workerInfoBaseMadiator2->getWorker();

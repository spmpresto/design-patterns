<?php

class Worker implements SplSubject
{
    private $observers;

    private $name = '';

    public function __construct()
    {
       $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function changeName($name): void
    {
        $this->name = $name;
        $this->notify();
    }

    public function notify(): void
    {
        foreach($this->observers as $observer){
            $observer->update($this);
        }
    }
}

class WorkerObserver implements SplObserver
{
    private $workers = [];

    /**
     * @return array
     */
    public function getWorkers(): array
    {
        return $this->workers;
    }

    public function update(SplSubject $subject): void
    {
        $this->workers[] = clone $subject;
    }
}

$observer = new WorkerObserver();

$worker = new Worker();

$worker->attach($observer);

$worker->changeName('Boris');
$worker->changeName('Bob');
$worker->changeName('Kate');

var_dump($observer->getWorkers());
var_dump(count($observer->getWorkers()));
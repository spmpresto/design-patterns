<?php

interface State
{
    public function toNext(Task $task);

    public function getStatus();
}

class Task
{
    private $state;

    /**
     * @return mixed
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public static function make(): Task
    {
        $self = new self();
        $self->setState(new Created());
        return $self;
    }

    public function processToNext()
    {
        $this->state->toNext($this);
    }
}

class Created implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Process());
    }

    public function getStatus()
    {
       return 'Created';
    }
}

class Process implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Test());
    }

    public function getStatus()
    {
        return 'Process';
    }
}

class Test implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Done());
    }

    public function getStatus()
    {
        return 'Test';
    }
}

class Done implements State
{

    public function toNext(Task $task)
    {

    }

    public function getStatus()
    {
        return 'Done';
    }
}

$task = Task::make();
$task->processToNext();
$task->processToNext();
$task->processToNext();

var_dump($task->getState()->getStatus());
<?php
// чтобы не использовать слово new, используется слово clone

abstract class WorkerPrototype
{
    protected $name;
    protected $position;

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
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }
}

class Developer extends WorkerPrototype
{
    protected $position = 'Developer';
}

$developer = new Developer();
$developer2 = clone $developer;
$developer2->setName('Boris');

var_dump($developer2->getName());
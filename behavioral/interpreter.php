<?php

abstract class Expression
{
    abstract public function interpret(Context $context): bool;

}

class Context
{
    private $worker = [];

    /**
     * @return array
     */
    public function getWorker(): array
    {
        return $this->worker;
    }


    public function setWorker(string $worker): void
    {
        $this->worker[] = $worker;
    }

    public function lookUp($key)
    {
        if(isset($this->worker[$key])){
            return $this->worker[$key];
        }
        return false;
    }
}

class VariableExp extends Expression
{
    private $key;

    /**
     * VaiableExp constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->key);
    }
}

class AndExp extends Expression
{
    private $keyOne;
    private $keyTwo;

    /**
     * AndExp constructor.
     * @param $keyOne
     * @param $keyTwo
     */
    public function __construct($keyOne, $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) && $context->lookUp($this->keyTwo);
    }
}

class OrExp extends Expression
{
    private $keyOne;
    private $keyTwo;

    /**
     * AndExp constructor.
     * @param $keyOne
     * @param $keyTwo
     */
    public function __construct($keyOne, $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) || $context->lookUp($this->keyTwo);
    }
}

$context = new Context();

$context->setWorker('Bob');
$context->setWorker('Boris');

$varExp = new VariableExp(1);
$andExp = new AndExp(1,3);
$orExp = new OrExp(5,4);


var_dump($varExp->interpret($context));
var_dump($andExp->interpret($context));
var_dump($orExp->interpret($context));

var_dump($context->getWorker());
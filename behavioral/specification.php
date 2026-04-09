<?php

interface Specification
{
    public function isNormal(Pupil $pupil): bool;
}

class Pupil
{
    private $rate = 0;

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * Pupil constructor.
     * @param int $rate
     */
    public function __construct(int $rate)
    {
        $this->rate = $rate;
    }
}

class PupilSpecification implements Specification
{
    private $needRate = 0;

    /**
     * PupilSpecification constructor.
     * @param int $needRate
     */
    public function __construct(int $needRate)
    {
        $this->needRate = $needRate;
    }

    public function isNormal(Pupil $pupil): bool
    {
        return $this->needRate < $pupil->getRate();
    }
}

class AndSpecification implements Specification
{
    private $specification = [];

    /**
     * AndSpecification constructor.
     * @param array $specification
     */
    public function __construct(Specification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification){
            if(!$specification->isNormal($pupil)){
                return false;
            }
        }
        return true;
    }
}


class OrSpecification implements Specification
{
    private $specification = [];

    /**
     * AndSpecification constructor.
     * @param array $specification
     */
    public function __construct(Specification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification){
            if($specification->isNormal($pupil)){
                return true;
            }
        }
        return false;
    }
}

class NotSpecification implements Specification
{

    private $specification;

    /**
     * NotSpecification constructor.
     * @param $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        return !$this->specification->isNormal($pupil);
    }
}


$specification1 = new PupilSpecification(5);
$specification2 = new PupilSpecification(10);

$pupil = new Pupil(8);

//var_dump($specification1->isNormal($pupil));
//var_dump($specification2->isNormal($pupil));

$andSpecification = new AndSpecification($specification1,$specification2);
var_dump($andSpecification->isNormal($pupil));

$orSpecification = new OrSpecification($specification1,$specification2);
var_dump($orSpecification->isNormal($pupil));

$notSpecification = new NotSpecification($specification1);
var_dump($notSpecification->isNormal($pupil));
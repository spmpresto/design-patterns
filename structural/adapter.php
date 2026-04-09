<?php

interface NativeWorker
{
    public function countSalary(): int;

}

interface OutsourceWorker
{
    public function countSalaryByHour($hour);
}

class NativeDeveloper implements NativeWorker
{

    public function countSalary(): int
    {
        return 300 * 20;
    }
}

class OutsourceDeveloper implements OutsourceWorker
{

    public function countSalaryByHour($hour): int
    {
        return $hour * 500;
    }
}

class OutsourceWorkerAdapter implements NativeWorker
{
    private $outsourceWorker;

    /**
     * OutsourceWorkerAdapter constructor.
     * @param $outsourceWorker
     */
    public function __construct(OutsourceWorker $outsourceWorker)
    {
        $this->outsourceWorker = $outsourceWorker;
    }

    public function countSalary(): int
    {
        return $this->outsourceWorker->countSalaryByHour(80);
    }
}

$nativeDeveloper = new NativeDeveloper();
$outsourceDeveloper = new OutsourceDeveloper();

$outsourceWorkerAdapter = new OutsourceWorkerAdapter($outsourceDeveloper);

var_dump($nativeDeveloper->countSalary());
var_dump($outsourceWorkerAdapter->countSalary());
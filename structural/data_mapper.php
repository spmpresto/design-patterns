<?php

class Worker
{
    public $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Worker constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function make($args): Worker
    {
        return new self($args['name']);
    }
}

class WorkerMapper
{
    private $workerStorageAdapter;

    /**
     * WorkerMapper constructor.
     * @param $workerStorageAdapter
     */
    public function __construct(WorkerStorageAdapter $workerStorageAdapter)
    {
        $this->workerStorageAdapter = $workerStorageAdapter;
    }

    public function findById($id){
        $res = $this->workerStorageAdapter->find($id);
        if($res === null){
            //throw new \Error('Worker with this id does not exists');
            return 'Worker with this id does not exists';
        }
        return $this->make($res);
    }

    private function make($args): Worker
    {
        return Worker::make($args);
    }

}


class WorkerStorageAdapter
{
    private $data = [];

    /**
     * WorkerStorageAdapter constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find($id){
        if(isset($this->data[$id])){
            return $this->data[$id];
        }
        return null;

    }

}

$data = [
  1 => ['name' => 'Boris']
];

$workerStorageAdapter = new WorkerStorageAdapter($data);

$workerMapper = new WorkerMapper($workerStorageAdapter);

//$worker = $workerMapper->findById(1);
$worker = $workerMapper->findById(2);

var_dump($worker->getName());
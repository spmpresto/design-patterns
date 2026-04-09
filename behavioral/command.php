<?php

interface Command
{
    public function execute();

}

interface Undoable extends Command{
    public function undo();
}

class Output
{
    private $isEnable = true;

    private $body = '';

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    public function write($str)
    {
        if($this->isEnable){
            $this->body = $str;
        }
    }

    public function enable()
    {
        $this->isEnable = true;
    }

    public function disable()
    {
        $this->isEnable = false;
    }
}

class Invoker
{
    private $command;

    /**
     * @param Command $command
     */
    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }

    public function run()
    {
        $this->command->execute();
    }
}

class Message implements Command
{
    private $output;

    /**
     * Message constructor.
     * @param $output
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }


    public function execute()
    {
        $this->output->write('some string from execute');
    }
}

class ChangerStatus implements Undoable
{
    private $output;

    /**
     * ChangerStatus constructor.
     * @param $output
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function execute()
    {
        $this->output->enable();
    }

    public function undo()
    {
        $this->output->disable();
    }
}

$output = new Output();

//$invoker = new Invoker(); // не нужен

$message = new Message($output);

$changerStatus = new ChangerStatus($output);

$changerStatus->undo(); // смена статуса
//$changerStatus->execute(); // смена статуса


//$invoker->setCommand($changerStatus); // не нужен
//$invoker->run(); // не нужен

$message->execute();

var_dump($output->getBody());
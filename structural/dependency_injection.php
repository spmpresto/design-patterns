<?php

class ControllerConfiguration
{
    private $name;
    private $action;

    /**
     * ControllerConfiguration constructor.
     * @param $name
     * @param $action
     */
    public function __construct($name, $action)
    {
        $this->name = $name;
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }



}

class Controller
{
    private $controllerConfiguration;

    /**
     * Controller constructor.
     * @param ControllerConfiguration $controllerConfiguration
     */
    public function __construct(ControllerConfiguration $controllerConfiguration)
    {
        $this->controllerConfiguration = $controllerConfiguration;
    }

    public function getConfigurtaion(): string
    {
        return $this->controllerConfiguration->getName(). '@' .$this->controllerConfiguration->getAction();
    }

}

$configuration = new ControllerConfiguration('PostConroller', 'Index');
$configuration1 = new ControllerConfiguration('PostConroller', 'Show');
$configuration2 = new ControllerConfiguration('TagConroller', 'Index');
$controller = new Controller($configuration);
$controller1 = new Controller($configuration1);
$controller2 = new Controller($configuration2);

var_dump($controller->getConfigurtaion());
var_dump($controller1->getConfigurtaion());
var_dump($controller2->getConfigurtaion());
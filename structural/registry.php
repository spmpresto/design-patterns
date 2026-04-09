<?php

abstract class Registry
{
    private static $services = [];

    final public static function setService($key, Service $service)
    {
        self::$services[$key] = $service;
    }

    final public static function getService($key)
    {
        if(isset(self::$services[$key])){
            return self::$services[$key];
        }
        return 'This service does not exists';

    }
}

interface Service {

}

class Service1 implements Service
{

}

class Service2 implements Service
{

}

$service = new Service1();
$service2 = new Service2();

Registry::setService(1,$service);
Registry::setService(2,$service2);

$service = Registry::getService(1);
$service2 = Registry::getService(2);

var_dump($service);
var_dump($service2);


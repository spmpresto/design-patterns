<?php

interface Mail
{
    public function render();
}

abstract class TypeMail
{
    private $text;

    /**
     * @return mixed
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * TypeMail constructor.
     * @param $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }
}

class BusinessMail extends TypeMail implements Mail
{

    public function render(): string
    {
        return $this->getText(). ' from business mail';
    }
}

class JobMail extends TypeMail implements Mail
{

    public function render(): string
    {
        return $this->getText(). ' from job mail';
    }
}

class MailFactory
{
    private $pool = [];

    public function getMail($id, $typeMail): Mail
    {
        if(!isset($this->pool[$id])){
            $this->pool[$id] = $this->make($typeMail);
        }
        return $this->pool[$id];
    }

    private function make($typeMail): Mail
    {
        if($typeMail === 'business'){
            return new BusinessMail('Business text');
        }
        return new JobMail('Job text');
    }
}


$mailFactory = new MailFactory();
$mail = $mailFactory->getMail(10,'business');
//$mail = $mailFactory->getMail(10,'dasdads');

var_dump($mail->render());
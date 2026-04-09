<?php

interface Renderable
{
    public function render();
}

class Mail implements Renderable{

    private $parts = [];
    public function render()
    {
        $result = '';
        foreach ($this->parts as $part){
            $result .= $part->render();
        }
        return $result;
    }

    public function addPart(Renderable $parts)
    {
        $this->parts[] = $parts;
    }
}

abstract class Part
{
    private $text;

    /**
     * Part constructor.
     * @param $text
     */
    public function __construct($text)
    {
        $this->text = $text.PHP_EOL;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }


}


class Header extends Part implements Renderable {

    public function render()
    {
        return $this->getText();
    }
}



class Body extends Part implements Renderable {

    public function render()
    {
        return $this->getText();
    }
}



class Footer extends Part implements Renderable {

    public function render()
    {
        return $this->getText();
    }
}


$mail = new Mail();
$mail->addPart(new Header('Header'));
$mail->addPart(new Body('Body'));
$mail->addPart(new Footer('Footer'));

var_dump($mail->render());


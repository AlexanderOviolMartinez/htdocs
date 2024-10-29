<?php

declare(strict_types= 1);

namespace lib;

class test
{
    public function __construct(string $methode = "", string $parameter = "")
    {
        
        if (method_exists($this, $methode))
        {

            echo "Hello from test class <br>";
            if($methode!="")
            {
                $this->$methode($parameter);
            }
        }
        else
        {
            echo "Ihre Methode existiert nicht";
        }
    }
    
    public function testmethode($testparameter)
    {
        echo "ich bin eine test methode <br>";
        if ($testparameter == "")
        {
            echo "Sie haben kein Parameter angegeben";
        }
        else
        {
        echo "Sie haben diesen wert \"$testparameter\" als Paramter angegeben";
        }
    }


}
<?php
 
namespace lib;
class cars {
    function __construct($method, $parameter) {
        echo "Car - Class<br/>";
        if (method_exists($this, $method)) {  
            $this->$method($parameter);
        }else{
            response::error(404);
        }
    }
 
    function message($parameter) {
        echo "The car is testing <br/>";
        echo "Parameter: $parameter <br/>";
    }
}
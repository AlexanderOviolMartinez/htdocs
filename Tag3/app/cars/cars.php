<?php
namespace app\cars;
use Exception;
use lib\test;

class cars{

    private test $test;

    public function __construct(string $methode = "", $parameter = "")
    {
        
        if(!empty($methode) && method_exists(object_or_class: $this, method: $methode))
        {
            try
            {
                $this->$methode($parameter);
            } catch(Exception $e)
            {
                echo "Error". $e->getMessage();
            }
        }
        else
        {
            $this->init();
        }
    }


    public function getData($id): void{
        if($id == ""){
            $sql = "SELECT * FROM cars";
            $data = [];
        }else{
            $sql = "SELECT * FROM cars Where id = :id";
            $data [] = ["id" => $id];
        }
        $data = $this->model->getData($sql,$data);
        $this->showData($data);
    }


    public function MeinTest($parameter): void
    {
        echo "MeinTest methode called with $parameter<br>W ";
        $this->test = new test(methode: $parameter, parameter: 4);
    }

    public function init(): void
    {
        $this->test = new Test("testmethode");
    }
}
<?php

abstract class Model {
    protected $id;

    function getId(){ return $this->id; }
    function setId(){ $this->id = $id; }

    function __CONSTRUCT($datas = []){
        $this->hydrate($datas);
    }

    protected function hydrate($datas){
        foreach($datas as $key => $data){
            $method = "set".ucfirst($ket);

            if(method_exists($this, $method)){
                $this->$method($data);
            }
        }
    }
}

?>
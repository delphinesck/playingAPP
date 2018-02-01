<?php

class Developer extends Model implements JsonSerializable {
    private $name;

    function setName($name) { $this->name = $name; }
    function getName() { return $this->name; }

    function jsonSerialize(){
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }
}

?>
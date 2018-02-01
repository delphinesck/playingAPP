<?php

class Label extends Model implements JsonSerializable {
    private $name;
    private $description;

    function setName($name) { $this->name = $name; }
    function getName() { return $this->name; }
    function setDescription($description) { $this->description = $description; }
    function getDescription() { return $this->description; }

    function jsonSerialize(){
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description
        ];
    }
}

?>
<?php

class Theme extends Model implements JsonSerializable {
    private $title;
    private $description;

    function setTitle($title) { $this->title = $title; }
    function getTitle() { return $this->title; }
    function setDescription($description) { $this->description = $description; }
    function getDescription() { return $this->description; }

    function jsonSerialize(){
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description
        ];
    }
}

?>
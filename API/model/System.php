<?php

class System extends Model implements JsonSerializable {
    private $full_name;
    private $short_name;
    private $company;
    private $color_bg;
    private $color_text;

    function setFull_name($full_name) { $this->full_name = $full_name; }
    function getFull_name() { return $this->full_name; }
    function setShort_name($short_name) { $this->short_name = $short_name; }
    function getShort_name() { return $this->short_name; }
    function setCompany($company) { $this->company = $company; }
    function getCompany() { return $this->company; }
    function setColor_bg($color_bg) { $this->color_bg = $color_bg; }
    function getColor_bg() { return $this->color_bg; }
    function setColor_text($color_text) { $this->color_text = $color_text; }
    function getColor_text() { return $this->color_text; }


    function jsonSerialize(){
        return [
            "id" => $this->id,
            "full_name" => $this->full_name,
            "short_name" => $this->short_name,
            "company" => $this->company,
            "color_bg" => $this->color_bg,
            "color_text" => $this->color_text
        ];
    }
}

?>
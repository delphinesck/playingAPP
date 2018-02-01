<?php

class Game extends Model implements JsonSerializable {
    private $title;
    private $summary;
    private $timeto_beat;
    private $timeto_complete;
    private $total_chapters;
    private $total_trophies;
    private $release_jp;
    private $release_na;
    private $release_eu;
    private $cover;
    private $banner;
    
    function setTitle($title) { $this->title = $title; }
    function getTitle() { return $this->title; }
    function setSummary($summary) { $this->summary = $summary; }
    function getSummary() { return $this->summary; }
    function setTimeto_beat($timeto_beat) { $this->timeto_beat = $timeto_beat; }
    function getTimeto_beat() { return $this->timeto_beat; }
    function setTimeto_complete($timeto_complete) { $this->timeto_complete = $timeto_complete; }
    function getTimeto_complete() { return $this->timeto_complete; }
    function setTotal_chapters($total_chapters) { $this->total_chapters = $total_chapters; }
    function getTotal_chapters() { return $this->total_chapters; }
    function setTotal_trophies($total_trophies) { $this->total_trophies = $total_trophies; }
    function getTotal_trophies() { return $this->total_trophies; }
    function setRelease_jp($release_jp) { $this->release_jp = $release_jp; }
    function getRelease_jp() { return $this->release_jp; }
    function setRelease_na($release_na) { $this->release_na = $release_na; }
    function getRelease_na() { return $this->release_na; }
    function setRelease_eu($release_eu) { $this->release_eu = $release_eu; }
    function getRelease_eu() { return $this->release_eu; }
    function setCover($cover) { $this->cover = $cover; }
    function getCover() { return $this->cover; }
    function setBanner($banner) { $this->banner = $banner; }
    function getBanner() { return $this->banner; }
    
    function jsonSerialize(){
        return [
            "id" => $this->id,
            "title" => $this->title,
            "summary" => $this->summary,
            "timeto_beat" => $this->timeto_beat,
            "timeto_complete" => $this->timeto_complete,
            "total_chapters" => $this->total_chapters,
            "total_trophies" => $this->total_trophies,
            "release_jp" => $this->release_jp,
            "release_na" => $this->release_na,
            "release_eu" => $this->release_eu,
            "cover" => $this->cover,
            "banner" => $this->banner
        ];
    }
}

?>
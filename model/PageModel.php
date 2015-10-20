<?php
namespace model;

class PageModel{
    private $title;
    private $url;
    private $content;

    public function __construct($title, $url, $content){
        $this->title = $title;
        $this->url = $url;
        $this->content = $content;
    }

    public function getPageContent(){
        return $this->content;
    }

    public function getPageURL(){
        return $this->url;
    }

    public function getPageTitle(){
        return $this->title;
    }

}
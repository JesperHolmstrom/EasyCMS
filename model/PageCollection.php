<?php
namespace model;

class PageCollection{
    private $pages;
    private $selectedPage;

    public function __construct(PageModel $page){
        $this->pages[] = $page;
        $this->selectedPage = $page;
    }

    public function add(PageModel $page){
        $this->pages[] = $page;
    }

    public function getPages(){
        return $this->pages;
    }

    public function selectPage($url){
        foreach($this->pages as $page){
            if(strcmp($page->getPageURL(),$url) === 0){
                $this->selectedPage = $page;
            }
        }
    }

    public function getSelectedPage(){
        return $this->selectedPage;
    }
}
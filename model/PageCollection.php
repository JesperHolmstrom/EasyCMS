<?php
namespace model;

class PageCollection{
    private $pages;
    private $selectedPage;
    private $dal;

    public function __construct(PageDAL $dal){
        $this->dal = $dal;
        $values = $this->dal->getPages();
        foreach($values as $value){
            $this->pages[] = $value;
        }
        $this->selectedPage = $this->pages[0];
    }

    public function add(PageModel $page){
        $result = $this->dal->createPage($page);
        if($result == true){
            $this->pages[] = $page;
            $this->selectedPage = $page;
        }
        return $result;
    }

    public function getPages(){
        return $this->pages;
    }

    public function selectPage($url){
        foreach($this->pages as $page) {
            if (strcmp($page->getPageURL(), $url) === 0) {
                $this->selectedPage = $page;
            }
        }
    }

    public function getSelectedPage(){
        return $this->selectedPage;
    }
}
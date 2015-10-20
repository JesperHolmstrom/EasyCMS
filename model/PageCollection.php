<?php
namespace model;

class PageCollection{
    private $pages;
    private $selectedPage;

    public function add(PageModel $page){
        $this->pages[] = $page;
        if($this->selectedPage == null)
            $this->selectPage($page);
    }

    public function getPages(){
        return $this->pages;
    }

    public function selectPage($pageURL){
        foreach($this->pages as $page){
            if(strcasecmp($page->getPageURL(),"hem")){
                $this->selectedPage = $page;
            }
        }
    }

    public function getSelectedPage(){
        return $this->selectedPage;
    }
}
<?php
namespace model;

class PageCollection{
    private $pages;
    private $selectedPage;
    private $dal;

    public function __construct(PageDAL $dal){
        $this->dal = $dal;
        $values = $this->dal->getPages();
        if($values){

            foreach($values as $value){
                $this->pages[] = $value;
            }
            $this->selectedPage = $this->pages[0];
        }
    }

    public function add(PageModel $page){
        $result = $this->dal->createPage($page);
        return $result;
    }

    public function update(PageModel $page, $oldurl){
        $result = $this->dal->updatePage($page, $oldurl);
        return $result;
    }

    public function delete($url){
        if(count($this->pages)>1){
            $result = $this->dal->deletePage($url);
            return $result;
        }
        else
            return \Settings::DELETE_ERROR;
    }

    public function getPages(){
        return $this->pages;
    }

    public function getPageByURL($url){
        foreach($this->pages as $page){
            if(strcmp($page->getPageURL(), $url) === 0)
                return $page;
        }
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
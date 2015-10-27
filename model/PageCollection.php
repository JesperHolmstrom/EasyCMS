<?php
namespace model;

class PageCollection{
    private $pages;
    private $selectedPage;
    private $dal;

    public function __construct(PageDAL $dal){
        $this->dal = $dal;
        $values = $this->dal->getPages(); //Get all pages in the DAL
        if($values){
            foreach($values as $value){
                $this->pages[] = $value; //Save all pages in the PageCollection
            }
            $this->selectedPage = $this->pages[0]; //Set the first Page as selected (It will be shown when no other page has been selected)
        }
    }

    /**
     * @param PageModel $page
     * @return String $result - If the operation was successful or not.
     * Tells the DAL to create a new Page
     */
    public function add(PageModel $page){
        $result = $this->dal->createPage($page);
        return $result;
    }

    /**
     * @param PageModel $page
     * @param $oldurl - URL of the page to update
     * @return String $result - If the operation was successful or not.
     * Tells the DAL to update a certain Page
     */
    public function update(PageModel $page, $oldurl){
        $result = $this->dal->updatePage($page, $oldurl);
        return $result;
    }

    /**
     * @param $url - URL of the page to delete
     * @return String $result - If the operation was successful or not.
     * Tells the DAL to delete a certain Page
     */
    public function delete($url){
        if(count($this->pages)>1){
            $result = $this->dal->deletePage($url);
            return $result;
        }
        else
            return \Settings::DELETE_ERROR;
    }

    /**
     * @return PageModel[] - All current Pages in this Model
     * Gets all Pages in the Model
     */
    public function getPages(){
        return $this->pages;
    }

    /**
     * @param $url - The url of the page to get
     * @return PageModel $page - The Page which URL matched the $url param
     * Gets the page which matches the $url sent as parameter
     */
    public function getPageByURL($url){
        foreach($this->pages as $page){
            if(strcmp($page->getPageURL(), $url) === 0)
                return $page;
        }
    }

    /**
     * @param $url - URL of the Page to select
     * Selects a Page - The selected page will be shown when a user loads the public page.
     */
    public function selectPage($url){
        foreach($this->pages as $page) {
            if (strcmp($page->getPageURL(), $url) === 0) {
                $this->selectedPage = $page;
            }
        }
    }

    /**
     * @return PageModel - The selected Page
     * Returns the currently selected Page to be shown in the public page view
     */
    public function getSelectedPage(){
        return $this->selectedPage;
    }
}
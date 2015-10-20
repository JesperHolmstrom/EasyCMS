<?php
namespace view;

class PageView{

    private $pages;

    public function __construct(\model\PageCollection $pages){
        $this->pages = $pages;
    }

    public function getPageContentHTML() {
        return '<div id="wrapper">
                    <h1>PHP-CMS Public page</h1>
                    <div id="menu">'.$this->getMenuListHTML().'</div>
                    <div id="content">'.$this->pages->getSelectedPage()->getPageContent().'</div>
                    <a href="?'.\Settings::ADMIN_PANEL_NAME.'">Admin login</a>
                    <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</em>
                </div>';
    }

    public function getMenuListHTML(){
        $links = "";
        $pageCollection = $this->pages->getPages();
        foreach($pageCollection as $page){
            $links .= '<li><a href="?'.\Settings::PAGE_NAME.'='. $page->getPageURL() .'">' . $page->getPageTitle() . '</a></li>';
        }
        return $links;
    }

    public function getPageTitle(){
        return $this->pages->getSelectedPage()->getPageTitle();
    }

    public function userWantsPage(){
        return isset($_GET[\Settings::PAGE_NAME]);
    }

    public function setCurrentPage(){
        if(isset($_GET[\Settings::PAGE_NAME])){
            $url = $_GET[\Settings::PAGE_NAME];
            $this->pages->selectPage($url);
        }
    }
}


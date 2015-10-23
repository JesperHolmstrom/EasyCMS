<?php
namespace view;

class PageView{

    private $pages;
    private $currentPage;

    public function __construct(\model\PageCollection $pages){
        $this->pages = $pages;
    }

    public function getPageContentHTML() {
        return '<main>
                    <header>
                        <h1>'. \Settings::HOMEPAGE_TITLE .'>'.$this->pages->getSelectedPage()->getPageTitle().'</h1>
                    </header>
                    <div id="menu">'.$this->getMenuListHTML().'</div>
                    <div id="content"><h1>'.$this->pages->getSelectedPage()->getPageTitle()."</h1>". $this->pages->getSelectedPage()->getPageContent().'</div>
                </main>
                <footer>
                    <a href="?'.\Settings::ADMIN_PANEL_NAME.'">Admin login</a>
                    <p>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</p>
                </footer>';
    }

    public function getMenuListHTML(){
        $links = "";
        $pageCollection = $this->pages->getPages();
        foreach($pageCollection as $page){
            $links .= '<li><a href="?'.\Settings::READ_PAGE.'='. $page->getPageURL() .'">' . $page->getPageTitle() . '</a></li>';
        }
        return $links;
    }

    public function getPageTitle(){
        $page = $this->pages->getSelectedPage();
        if($page != null)
            return $page->getPageTitle();
    }

    public function userWantsPage(){
        return isset($_GET[\Settings::READ_PAGE]);
    }

    public function setCurrentPage(){
        if(isset($_GET[\Settings::READ_PAGE])){
            $url = $_GET[\Settings::READ_PAGE];
            $this->pages->selectPage($url);
        }
    }
}


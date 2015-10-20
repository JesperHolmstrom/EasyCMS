<?php
namespace controller;

class PageController{
    private $model;
    private $view;

    public function __construct(\model\PageCollection $model, \view\PageView $view) {
        $this->model = $model;
        $this->view =  $view;
    }
    public function doControl(){
        if($this->view->userWantsPage())
            $this->view->setCurrentPage();
    }
}
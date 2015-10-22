<?php
/**
 * Solution for assignment 2
 * @author Daniel Toll
 */
namespace controller;

require_once("view/AdminPanelView.php");

class AdminPanelController {

    private $view;
    private $model;

    public function __construct(\view\AdminPanelView $view, \model\PageCollection $model) {
        $this->view =  $view;
        $this->model = $model;
    }

    public function doControl() {
        if($this->view->userCreatedAPage() && $this->view->formIsValid()){
            $pm = $this->view->getPageModel();
            $result = $this->model->add($pm);
            $this->view->setMessage($result);
        }
    }
}
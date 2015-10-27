<?php
namespace controller;


class MasterController {

    private $loginController;
    private $adminController;
    private $pageController;

    public function __construct(\model\LoginModel $model, \view\LoginView $view, \controller\AdminPanelController $ac, \controller\PageController $pc, \controller\LoginController $lc) {
        $this->model = $model;
        $this->view =  $view;
        $this->loginController = $lc;
        $this->pageController =  $pc;
        $this->adminController = $ac;
    }

    public function doControl() {

        //If the user is authenticated, he can create/update/delete pages
        $userClient = $this->view->getUserClient();
        if ($this->model->isLoggedIn($userClient)) {
            $this->adminController->doControl();
        }

        $this->loginController->doControl();
        $this->pageController->doControl();
    }
}
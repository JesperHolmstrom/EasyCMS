<?php
/**
 * Solution for assignment 2
 * @author Daniel Toll
 */
namespace controller;

require_once("view/AdminPanelView.php");

class AdminPanelController {

    private $view;

    public function __construct(\view\AdminPanelView $view) {
        $this->view =  $view;
    }

    public function doControl() {

    }
}
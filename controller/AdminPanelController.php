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

    /*
     * DoControl handles the Create/Update/Delete operations in the Admin Panel.
     * It first retreives the page and do the operation and tells the AdminPanelView what the outcome was.
     * For Update and Delete it also redirects the page so that the page is updated with the new values.
     */
    public function doControl() {
        if($this->view->userCreatedAPage() && $this->view->formIsValid()){
            $pm = $this->view->getPageModel();
            $result = $this->model->add($pm);
            $this->view->setMessage($result);
        }
        else if($this->view->userUpdatedAPage() && $this->view->formIsValid()){
            $pm = $this->view->getPageModel();
            $oldurl = $this->view->getPageToUpdate();
            $newurl = $pm->getPageURL();
            $result = $this->model->update($pm, $oldurl);
            $this->view->redirectToUpdate($newurl, $result);
        }
        else if($this->view->userDeletedAPage()){
            $page = $this->view->getPageToDelete();
            $result = $this->model->delete($page);
            $this->view->redirectToDelete($result);
        }
    }
}
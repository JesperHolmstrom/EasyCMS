<?php
 /**
  * Solution for assignment 2
  * @author Daniel Toll
  */
require_once("Settings.php");
require_once("controller/AdminPanelController.php");
require_once("controller/LoginController.php");
require_once("controller/PageController.php");
require_once("controller/MasterController.php");

require_once("view/LayoutView.php");
require_once("view/PageView.php");

require_once("model/PageModel.php");
require_once("model/PageCollection.php");
require_once("model/PageDAL.php");

if (Settings::DISPLAY_ERRORS) {
	error_reporting(-1);
	ini_set('display_errors', 'ON');
}

//session must be started before LoginModel is created
session_start();

//Create the models
$lm = new \model\LoginModel();
$pd = new \model\PageDAL();
$pages = new \model\PageCollection($pd); //Dependency inject the DAL

//Create the views
$v = new \view\LoginView($lm); 			//Dependency inject the LoginModel
$av = new \view\AdminPanelView($pages); //Dependency inject the PageCollection
$pv = new \view\PageView($pages);		//Dependency inject the PageCollection

//Create the controllers
$c = new \controller\LoginController($lm, $v);
$pc = new \controller\PageController($pages, $pv);
$ac = new \controller\AdminPanelController($av, $pages);
$mc = new \controller\MasterController($lm, $v,$ac,$pc,$c);

$mc->doControl();

//Generate output
$lv = new \view\LayoutView($pages);
$lv->render($lm->isLoggedIn($v->getUserClient()), $v, $pv, $av);


<?php
 /**
  * Solution for assignment 2
  * @author Daniel Toll
  */
require_once("Settings.php");
require_once("controller/AdminPanelController.php");
require_once("controller/LoginController.php");
require_once("controller/PageController.php");

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

//Dependency injection
$m = new \model\LoginModel();
$av = new \view\AdminPanelView();
$v = new \view\LoginView($m);
$c = new \controller\LoginController($m, $v);
$pd = new \model\PageDAL();

//Create some pages
//Create the pagecollection and dependency inject into the pageview and pagecontroller
$pages = new \model\PageCollection($pd);
$pv = new \view\PageView($pages);
$pc = new \controller\PageController($pages, $pv);
$ac = new \controller\AdminPanelController($av, $pages);

//Controller must be run first since state is changed
$ac->doControl();
$c->doControl();
$pc->doControl();

//Generate output
$lv = new \view\LayoutView($pages);
$lv->render($m->isLoggedIn($v->getUserClient()), $v, $pv, $av);


<?php
 /**
  * Solution for assignment 2
  * @author Daniel Toll
  */
require_once("Settings.php");
require_once("controller/AdminPanelController.php");
require_once("controller/LoginController.php");
require_once("controller/PageController.php");

require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");
require_once("view/PageView.php");

require_once("model/PageModel.php");
require_once("model/PageCollection.php");

if (Settings::DISPLAY_ERRORS) {
	error_reporting(-1);
	ini_set('display_errors', 'ON');
}

//session must be started before LoginModel is created
session_start(); 

//Dependency injection
$m = new \model\LoginModel();
$av = new \view\AdminPanelView();
$v = new \view\LoginView($m, $av);
$c = new \controller\LoginController($m, $v);
$ac = new \controller\AdminPanelController($av);

//Create some pages
$page = new \model\PageModel("Hem", "hem", '<h1>Hem</h1> <p>And this is some content that will be displayed in the content</p>');
$page2 = new \model\PageModel("Info", "info", "<h1>Content for Infolol</h1>");
$page3 = new \model\PageModel("Kontakt", "kontakt", "<h1>Content for Kontaktlol</h1>");
$page4 = new \model\PageModel("Mail", "mail", "<h1>Content for Mail</h1>");
$page5 = new \model\PageModel("Order", "order", "<h1>Content for Order</h1>");
//Create the pagecollection and dependency inject into the pageview and pagecontroller
$pages = new \model\PageCollection($page);
$pages->add($page2);
$pages->add($page3);
$pages->add($page4);
$pages->add($page5);
$pv = new \view\PageView($pages);
$pc = new \controller\PageController($pages, $pv);


//Controller must be run first since state is changed
$ac->doControl();
$c->doControl();
$pc->doControl();


//Generate output
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView($pages);
$lv->render($m->isLoggedIn($v->getUserClient()), $v, $dtv, $pv);


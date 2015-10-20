<?php
/**
  * Solution for assignment 2
  * @author Daniel Toll
  */
namespace view;

class LayoutView {

    public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, PageView $pv) {
    if($this->userClickedOnAdminPanel())
      $this->doAdminPanel($isLoggedIn,$v,$dtv);
    else
      $this->doPublicPage($pv);
    }

    public function doAdminPanel($isLoggedIn, LoginView $v, DateTimeView $dtv) {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title><?php echo \Settings::HOMEPAGE_TITLE ?> - Admin Panel</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
      </head>
      <body>
        <div id="wrapper" >
            <?php
              if ($isLoggedIn) {
                echo "<h1>Admin Panel</h1>";
              }
              else {
                echo "<h1>Log in</h1>";
              }
              echo $v->response();
            ?>
          <a href="?">Back to public page</a>
          <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</em>
        </div>
       </body>
    </html>
    <?php
    }

    public function doPublicPage(PageView $pv) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title><?php echo \Settings::HOMEPAGE_TITLE .' - '. $pv->getPageTitle(); ?></title>
            <link rel="stylesheet" type="text/css" href="css/style.css" />
        </head>
        <body>
            <?php echo $pv->getPageContentHTML() ?>
        </body>
        </html>
        <?php
    }

    public function userClickedOnAdminPanel(){
      return isset($_GET[\Settings::ADMIN_PANEL_NAME]);
    }

}

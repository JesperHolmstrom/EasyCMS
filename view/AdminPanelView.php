<?php
namespace view;


class AdminPanelView{

    private static $title = "AdminPanelView::Title";
    private static $url = "AdminPanelView::URL";
    private static $content = "AdminPanelView::Content";


    private static $messageSaveLocation = "AdminPanelView::Message";

    private static $create = "AdminPanelView::Create";
    private static $update = "AdminPanelView::Update";
    private static $delete = "AdminPanelView::Delete";
    private static $logout = \Settings::LOGOUT;

    private $message;
    private $pages;

    public function __construct(\model\PageCollection $pages){
        $this->pages = $pages;
        $message = $this->getSessionMessage();
        $this->setMessage($message);
    }


    public function response(){
        if($this->userWantsToCreatePage())
            return $this->getCreatePageHTML();
        else if($this->userWantsToUpdatePage() && $this->userChoseAPageToUpdate()){
            $page = $this->pages->getPageByURL($this->getPageToUpdate());
            if($page != null)
                return $this->getUpdatePageHTML($page);

        }
        else if($this->userWantsToUpdatePage())
            return "<h2><-- Please choose a page to update in the menu.</h2>";
        else if($this->userWantsToDeletePage() && $this->userChoseAPageToDelete()){
            return $this->getDeleteButtonHTML();
        }
        else if($this->userWantsToDeletePage())
            return "<label>".$this->message."</label><br><h2><-- Please choose a page to delete in the menu.</h2>";
    }

    public function getMenuHTML(){
        $list = '<li><a href="?adminpanel&'.\Settings::CREATE_PAGE.'">Create new Page</a></li>
                 <li><a href="?adminpanel&'.\Settings::UPDATE_PAGE.'">Update Page</a></li>';

        if($this->userWantsToUpdatePage()){
            $collection = $this->pages->getPages();

            foreach($collection as $page){
                $list .= "\n<li><a href='?adminpanel&".\Settings::UPDATE_PAGE."=". $page->getPageURL() . "' id='submenu'>".$page->getPageTitle()."</a></li>";
            }
        }
        $list .= '<li><a href="?adminpanel&'.\Settings::DELETE_PAGE.'">Delete Page</a></li>';

        if($this->userWantsToDeletePage()){
            $collection = $this->pages->getPages();

            foreach($collection as $page){
                $list .= "\n<li><a href='?adminpanel&".\Settings::DELETE_PAGE."=". $page->getPageURL() . "' id='submenu'>".$page->getPageTitle()."</a></li>";
            }
        }

        $list .= $this->getLogoutButtonHTML();

        return $list;
    }
    public function redirectToUpdate($url, $message){
        $_SESSION[self::$messageSaveLocation] = $message;
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".\Settings::ADMIN_PANEL_NAME . "&" . \Settings::UPDATE_PAGE."=" . $url;
        header("Location: $actual_link");
    }
    public function redirectToDelete($message){
        $_SESSION[self::$messageSaveLocation] = $message;
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".\Settings::ADMIN_PANEL_NAME . "&" . \Settings::DELETE_PAGE;
        header("Location: $actual_link");
    }

    private function getSessionMessage() {
        if (isset($_SESSION[self::$messageSaveLocation])) {
            $message = $_SESSION[self::$messageSaveLocation];
            unset($_SESSION[self::$messageSaveLocation]);
            return $message;
        }
        return "";
    }

    public function userWantsToCreatePage(){
        return isset($_GET[\Settings::CREATE_PAGE]);
    }
    public function userWantsToUpdatePage(){
        return isset($_GET[\Settings::UPDATE_PAGE]);
    }
    public function userWantsToDeletePage(){
        return isset($_GET[\Settings::DELETE_PAGE]);
    }
    public function userCreatedAPage(){
        return isset($_POST[self::$create]);
    }
    public function userUpdatedAPage(){
        return isset($_POST[self::$update]);
    }
    public function userDeletedAPage(){
        return isset($_POST[self::$delete]);
    }
    public function userChoseAPageToUpdate(){
        return strlen($_GET[\Settings::UPDATE_PAGE]) >= 3;
    }
    public function userChoseAPageToDelete(){
        return strlen($_GET[\Settings::DELETE_PAGE]) >= 3;
    }
    public function getPageToUpdate(){
        if(isset($_GET[\Settings::UPDATE_PAGE]))
            return $_GET[\Settings::UPDATE_PAGE];
    }
    public function getPageToDelete(){
        if(isset($_GET[\Settings::DELETE_PAGE]))
            return $_GET[\Settings::DELETE_PAGE];
    }

    public function formIsValid(){
        $message = "";

        if(!isset($_POST[self::$title]) || strlen($this->getFormTitle()) == 0) {
            $message .= "You need to fill in a Title.";
        }
        else if(!(strlen($this->getFormTitle()) >= 3 && strlen($this->getFormTitle()) <= 35)){
            $message .= "Title need to be between 3 and 35 characters long.";
        }

        if(!isset($_POST[self::$url]) || strlen($this->getFormURL()) == 0) {
            $message .= "You need to fill in an URL.";
        }
        else if(!(strlen($this->getFormURL())>= 3 && strlen($this->getFormURL()) <= 20)){
            $message .= "URL need to be between 3 and 25 characters long.";
        }

        if(!isset($_POST[self::$content]) || strlen($this->getFormContent()) == 0) {
            $message .= "You need to fill in some Content.";
        }
        else if(!(strlen($this->getFormContent()) >= 3 && strlen($this->getFormURL()) <= 10000)){
            $message .= "Content needs to be between 3 and 10000 charactes long.";
        }

        if($message === "")
            return true;
        else{
            $this->setMessage($message);
            return false;
        }
    }

    public function getFormTitle(){
        if(isset($_POST[self::$title]))
            return $_POST[self::$title];
    }
    public function getFormURL(){
        if(isset($_POST[self::$url]))
            return $_POST[self::$url];
    }
    public function getFormContent(){
        if(isset($_POST[self::$content]))
            return $_POST[self::$content];
    }

    public function getPageModel(){
        return new \model\PageModel($this->getFormTitle(),$this->getFormURL(),$this->getFormContent());
    }

    public function setMessage($message){
        if($message == "1")
            $this->message = "Successful!";
        else
            $this->message = $message;
    }

    private function getLogoutButtonHTML() {
        return "<li><form method='post' >
			<input type='submit' name='" . self::$logout . "' value='Log out'/>
			</form></li>";
    }

    private function getDeleteButtonHTML() {
        return "<h2>Do you really want to delete this page?</h2>
                <h3> This action can not be reversed.</h3>
                <form method='post' >
                    <input type='submit' name='" . self::$delete . "' value='Yes, delete this page!'/>
                </form>";
    }

    public function getCreatePageHTML(){
        return "<form method='post' >
				<fieldset>
					<legend>Create a new Page</legend>

					<label>".$this->message."</label><br>

					<label for='".self::$title."'>Title:</label><br>
					<input type='text' id='".self::$title."' name='".self::$title. "' placeholder='Title of the page'/><br>

					<label for='".self::$url."'>URL:</label><br>
					<input type='text' id='".self::$url."' name='".self::$url."' placeholder='URL to the page'/><br>

					<label for='".self::$url."'>Content:</label><br>
					<textarea type='text' cols='100' rows='20' id='".self::$content."' name='".self::$content."' placeholder='Content of the page'/></textarea><br><br>

					<input type='submit' name='".self::$create."' value='Create Page'/>
				</fieldset>
			</form>
		";
    }
    public function getUpdatePageHTML(\model\PageModel $page){
        return "<form method='post' >
				<fieldset>
					<legend>Update a Page</legend>

					<label>".$this->message."</label><br>

					<label for='".self::$title."'>Title:</label><br>
					<input type='text' id='".self::$title."' name='".self::$title. "' value='".$page->getPageTitle()."'/><br>

					<label for='".self::$url."'>URL:</label><br>
					<input type='text' id='".self::$url."' name='".self::$url."' value='".$page->getPageURL()."'/><br>

					<label for='".self::$url."'>Content:</label><br>
					<textarea type='text' cols='100' rows='20' id='".self::$content."' name='".self::$content."'/>".$page->getPageContent()."</textarea><br><br>

					<input type='submit' name='".self::$update."' value='Update Page'/>
				</fieldset>
			</form>
		";
    }
}
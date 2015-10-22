<?php
namespace view;


class AdminPanelView{

    private static $title = "AdminPanelView::Title";
    private static $url = "AdminPanelView::URL";
    private static $content = "AdminPanelView::Content";
    private static $create = "AdminPanelView::Create";
    private $message;

    public function response(){
        if($this->userWantsToCreatePage())
            return $this->getCreatePageHTML();
    }
    public function getMenuHTML(){
        return '<li><a href="?adminpanel&'.\Settings::CREATE_PAGE.'">Create new Page</a></li>';
    }

    public function userWantsToCreatePage(){
        return isset($_GET[\Settings::CREATE_PAGE]);
    }

    public function userCreatedAPage(){
        return isset($_POST[self::$create]);
    }

    public function formIsValid(){
        $message = "";
        var_dump($_POST);

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
            $this->message = "The Page was added successfully.";
        else
            $this->message = $message;
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

    public function printer($v){
        echo $v;
    }
}
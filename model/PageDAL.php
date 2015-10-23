<?php
namespace model;

class PageDAL
{
    private static $host = \Settings::DB_HOST;
    private static $table = \Settings::DB_TABLE;
    private static $username = \Settings::DB_USER;
    private static $password = \Settings::DB_PASS;

    private $db;
    private $pageArray;

    public function connect(){
        // Create connection
        $link = mysqli_connect(self::$host, self::$username, self::$password, self::$table);
        if (!$link) {
            die('Could not connect: ' . mysqli_error());
        }
        $this->db = $link;
    }
    public function getPages()
    {
        $this->connect();

        // prepare and bind
        $query = "SELECT * FROM " . self::$table;

        if ($stmt = mysqli_prepare($this->db, $query)) {

            /* execute statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $url, $title, $content);

            /* fetch values */
            while (mysqli_stmt_fetch($stmt)) {
                $this->pageArray[] = new \model\PageModel($title, $url, $content);
            }

            /* close statement */
            mysqli_stmt_close($stmt);
        }

        /* close connection */
        mysqli_close($this->db);

        return $this->pageArray;
    }

    public function createPage(PageModel $page)
    {
        $this->connect();

        //values to be inserted in database table
        $url = '"'.$this->db->real_escape_string($page->getPageURL()).'"';
        $title = '"'.$this->db->real_escape_string($page->getPageTitle()).'"';
        $content = '"'.$this->db->real_escape_string($page->getPageContent()).'"';

        //MySqli Insert Query
        $insert_row = $this->db->query("INSERT INTO ".self::$table." (url, title, content) VALUES($url, $title, $content)");

        if($insert_row){
            return true;
        }else{
            return $this->db->error;
        }
    }

    public function updatePage(PageModel $page, $oldurl)
    {
        $this->connect();
        $oldurl = '"'.$this->db->real_escape_string($oldurl).'"';
        $url = '"'.$this->db->real_escape_string($page->getPageURL()).'"';
        $title = '"'.$this->db->real_escape_string($page->getPageTitle()).'"';
        $content = '"'.$this->db->real_escape_string($page->getPageContent()).'"';

        //MySqli Insert Query
        $update_row = $this->db->query("UPDATE ".self::$table." SET url=$url ,title=$title, content=$content WHERE url=$oldurl");

        if($update_row){
            return $update_row;
        }else{
            return $this->db->error;
        }
    }

    public function deletePage($url)
    {
        $this->connect();
        $urlToDelete = '"'.$this->db->real_escape_string($url).'"';

        //MySqli Insert Query
        $delete_row = $this->db->query("DELETE FROM ".self::$table." WHERE url=$urlToDelete");

        if($delete_row){
            return $delete_row;
        }else{
            return $this->db->error;
        }
    }

}
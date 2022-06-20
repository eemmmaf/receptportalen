<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-20 02:48:32 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-20 13:11:19
 */
class Post
{
    //Properties
    private $db; //Databas-anslutning
    private $title; //Inläggets titel
    private $content; //Inläggets innehåll
    private $email;
    private $categoryname;



    //Konstruktor med databasanslutning
    function __construct()
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        //Kontrollerar om det finns något fel
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning" . $this->db->connect_error);
        }
    }
    //----Set-method-----//
    //Checks that nothing is empty and sets 
    public function setPost(string $title, string $content, string $categoryname): bool
    {
        if ($title && $content && $categoryname != "") {
            $this->title = $title;
            $this->content = $content;
            $this->categoryname = $categoryname;
            return true;
        } else {
            return false;
        }
    }

    //Lägg till inlägg
    public function addPost(string $title, string $content, string $categoryname, $email): bool
    {
        //Kontrollerar om set-metoder är uppfyllda
        if (!$this->setPost($title, $content, $categoryname)) return false;


        //Använder real_escape_string för att undvika att skadlig kod hamnar i databasen
        $title = $this->db->real_escape_string($title);
        $content = $this->db->real_escape_string($content);
        $categoryname = $this->db->real_escape_string($categoryname);

        //Använder strip_tags för att ta bort HTML-taggar. Tillåter vissa taggar för utskriftens skull
        $content = strip_tags($content, '<p><strong><em><a><ul><ol><li><br>');
        $title = strip_tags($title);
        $categoryname = strip_tags($categoryname);


        //SQL fråga
        $sql = "INSERT INTO posts(email,title, content, category_name)VALUES('" . $_SESSION['email'] . "', '" . $this->title . "', '" . $this->content . "', '" . $this->categoryname . "');";

        //Skicka frågan till servern
        return mysqli_query($this->db, $sql);
    }

    //Metod för att hämta inlägg från den inloggade användaren
    public function getPostByUser(): array
    {

        $sql = "SELECT * FROM posts where email='" . $_SESSION['email'] . "' ORDER BY post_created DESC";

        $result = mysqli_query($this->db, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-19 17:23:24 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-19 21:15:19
 */


//Class User to handle users 
class User
{
    private $email;
    private $blogname;
    private $password;
    private $fname;
    private $lname;
    private $age;
    private $info;
    private $db;

    //Constructor
    function __construct()
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        //Error-check
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning" . $this->db->connect_error);
        }
    }

    //----------SetMethods------------//

    //Checking if names, age and info is empty
    public function setUser(string $fname, string $lname, string $age, string $info): bool
    {
        //Checking if empty and setting
        if ($fname && $lname && $age && $info != "") {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->age = $age;
            $this->info = $info;
            return true;
        } else {
            return false;
        }
    }

    //Checking if email is in correct format 
    public function setEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        } else {
            return false;
        }
    }

    //Checking if blogname is >= 5 characters
    public function setBlogname(string $blogname): bool
    {
        if (strlen($blogname) >= 5) {
            $this->blogname = $blogname;
            return true;
        } else {
            return false;
        }
    }

    //Checking if password is >= 8 characters
    public function setPassword(string $password): bool
    {
        if (strlen($password) >= 8) {
            $this->password = $password;
            return true;
        } else {
            return false;
        }
    }


    //Kontroll för att se om bloggnamnet och mailen finns
    public function uniqueNames(string $blogname, string $email): bool
    {
        $blogname = $this->db->real_escape_string($blogname);
        $email = $this->db->real_escape_string($email);

        //SQL-fråga
        $sql = "SELECT blogname, email FROM users WHERE blogname='$blogname' OR email='$email'";
        $result = $this->db->query($sql);


        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Method for registration
    public function registerUser($fname, $lname, $age, $info, $blogname, $email, $password)
    {


        //Checking set-methods
        if (!$this->setUser($fname, $lname, $age, $info)) return false;
        if (!$this->setBlogname($blogname)) return false;
        if (!$this->setEmail($email)) return false;
        if (!$this->setPassword($password)) return false;



        //Hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //Sanitating the input from injections
        $blogname = $this->db->real_escape_string($blogname);
        $email = $this->db->real_escape_string($email);
        $password = $this->db->real_escape_string($password);
        $fname = $this->db->real_escape_string($fname);
        $lname = $this->db->real_escape_string($lname);
        $info = $this->db->real_escape_string($info);
        $age = $this->db->real_escape_string($age);

        //Strip_tags to remove HTML-tags
        $blogname = strip_tags($blogname);
        $email = strip_tags($email);
        $password = strip_tags($password);
        $fname = strip_tags($fname);
        $lname = strip_tags($lname);
        $age = strip_tags($age);
        $info = strip_tags($info);


        $sql = "INSERT INTO users(email, blogname, password, age, user_info, fname, lname) VALUES('$email', '$blogname', '$hashed_password', '$age', '$info', '$fname', '$lname')";

        $result = $this->db->query($sql);

        return $result;
    }
}

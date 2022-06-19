<?php
//Autoload for the classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php'; 
});

//Starting the session
session_start();

//Page title
$site_title = "Receptportalen";
$divider = " - ";

//Settings for the connection to the database. Variabel true when developing
$developer = true;
if($developer){
//Connection for localhost
define("DBHOST", "localhost");
define("DBUSER", "receptportalen");
define("DBPASS", "Password");
define("DBDATABASE", "receptportalen");
// Activating error messages 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}

?>
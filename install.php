<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-19 14:48:38 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-19 17:47:08
 */


//Including config-file
include('includes/config.php');

//Connecting
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if($db->connect_errno > 0) {
    die("Fel vid anslutning" . $db->connect_error);
}

//SQL-query for installation
$sql = "DROP TABLE IF EXISTS posts, users, category;";

$sql .= "
CREATE TABLE posts(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    content TEXT NOT NULL,
    post_created timestamp NOT NULL DEFAULT current_timestamp(),
    email VARCHAR(60) NOT NULL,
    category_name VARCHAR(50) NOT NULL
    ); 
    
    CREATE TABLE users(
    email VARCHAR(60) PRIMARY KEY NOT NULL,
    blogname VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(128),
    age VARCHAR(10),
    user_info TEXT,
    user_created timestamp NOT NULL DEFAULT current_timestamp(),
    fname VARCHAR(50),
    lname VARCHAR(50));

    CREATE TABLE category(
    category_name VARCHAR(128) PRIMARY KEY NOT NULL,
    category_description TEXT);
    
ALTER TABLE posts
ADD FOREIGN KEY (email) REFERENCES users(email);

ALTER TABLE posts
ADD FOREIGN KEY category_name REFERENCES category(category_name);
";
    

echo "<pre> $sql </pre>";

//Send the query to the server
if($db->multi_query($sql)){
    echo "Tabell installerad";
}else{
    "Fel vid installation av tabell";
}

<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-20 02:42:05 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-20 02:42:26
 */

include('includes/config.php');
unset($_SESSION["email"]);
header("Location:login.php");
?>
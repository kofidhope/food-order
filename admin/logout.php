<?php 
 // include constants
 include('../config/constant.php');
//1. destroy the section
session_destroy();
//2. redirect to the login page
header('location:'.HOMEURL.'admin/login.php');

?>
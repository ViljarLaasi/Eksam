<?php
require '../config.php';
session_start();
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ; 	
function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
  
 if(!$mysqli){
	  die('Andmebaasiga Ühendamine ebaõnnestus, veateade: ' . mysql_error());
 }
  if (isset($_SESSION['username'])){
	 echo'Tere, ' .$_SESSION['username'] .'!';
	 require 'db_data.php';
	 
	//kontrollime kas kasutaja soovib registreerida. 
 }elseif(isset($_GET['action']) and $_GET['action'] === 'registreeri'){
	 require 'register.php';
 }elseif(isset($_GET['action']) and $_GET['action'] === 'login'){
	 require 'login.php';
 }else{
	 require 'db_tav.php';
 }
 $mysqli->close();


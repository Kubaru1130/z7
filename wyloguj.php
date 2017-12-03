<?
session_start(); //odpalenie sesji
$_SESSION=array();
session_destroy();// Usunięcie sesji
Header('location: logowanie.php'); //Przekierowanie do logowania
exit;
?>
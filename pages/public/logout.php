<?php
// Suppression de toutes les variables de session en les réinitialisant à un tableau vide
$_SESSION = array();
// Destruction de la session en cours
session_destroy();
// Suppression de la variable $_SESSION
unset($_SESSION);
// Redirection vers la page index.php
header('Location:   index.php');
?>
<?php

session_start();

if (isset($_SESSION["profil"])) {
    

if (isset($_GET['page'])) { // Récupération de la page courante via requete 
    $page = $_GET['page'] ;
}
else {
    $page = 'home' ;
}

ob_start(); // Mise en mémoire tampon 

if ($page === 'home'){ 
    require 'pages/admin/home.php';
}
elseif ($page === 'logout'){
    require 'pages/admin/logout.php';
}
}
else{
    header('Location: index.php');
    $_SESSION = array();
    session_destroy();
    unset($_SESSION);
    header('Location:   index.php');
}

$content = ob_get_clean(); // Lire le contenu du tampon et l'effacer
    require 'template/template.php'; // inserer la page dans un template
?>

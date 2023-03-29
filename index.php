<?php
if (isset($_GET['page'])) { // Récupération de la page courante via requete 
    $page = $_GET['page'] ;
}
else {
    $page = 'home' ;
}

ob_start(); // Mise en mémoire tampon 

if ($page === 'home'){ 
    require 'pages/home.php';
}
elseif ($page === 'verification'){
    require 'pages/verification.php';
}
elseif ($page === 'home1'){
    require 'pages/home1.php';
}


$content = ob_get_clean(); // Lire le contenu du tampon et l'effacer
    require 'template/template.php'; // inserer la page dans un template
?>

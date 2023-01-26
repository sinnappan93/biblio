<?php
if (isset($_GET['page'])) { // Récupération de la page courante via requete 
    $page = $_GET['page'] ;
}
else {
    $page = 'home' ;
}

ob_start(); // Mise en mémoire tampon 

if ($page === 'home'){ 
    require 'home.php';
}
elseif ($page === 'public'){
    require 'pages/public/agendaa.php';
}


$content = ob_get_clean(); // Lire le contenu du tampon et l'effacer
    require 'template/template.php'; // inserer la page dans un template
?>

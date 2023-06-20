<?php
try{
    // Connexion à la base de données MySQL
    $db = new PDO('mysql:host=localhost;dbname=my_db', 'root', '');

    // Définition du mode de récupération par défaut des données (associatif)
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Activation du mode d'affichage des erreurs en mode warning
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
}catch (Exception $e){
    // Gestion des exceptions en cas d'erreur de connexion
    echo 'Impossible de se connecter à la base de données';
    echo $e->getMessage();
    die();
}
?>

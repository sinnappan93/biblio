<?php
    // Informations de connexion à la base de données
    $host     = 'localhost';  // Hôte de la base de données
    $username = 'root';       // Nom d'utilisateur de la base de données
    $password = '';           // Mot de passe de la base de données
    $dbname   ='my_db';       // Nom de la base de données

    // Connexion à la base de données MySQL
    $conn = new mysqli($host, $username, $password, $dbname);
    
    // Vérification de la connexion
    if(!$conn){
        // Arrêt du script en cas d'échec de la connexion
        die("Cannot connect to the database.". $conn->error);
    }
?>

<?php 
    // Inclusion du fichier de base de données

    require_once('database/bd.php');

        // Vérification de l'existence de l'identifiant de l'horaire dans la requête GET

    if(!isset($_GET['id'])){
                // Si l'identifiant est indéfini, afficher une alerte et rediriger vers la page d'accueil

        echo "<script> alert('Undefined Schedule ID.'); location.replace('?page=home') </script>";
        // Fermeture de la connexion à la base de données
        $conn->close();
        // Arrêt de l'exécution du script
        exit;
    }
    // Suppression de l'événement de la base de données en utilisant l'identifiant fourni

    $delete = $conn->query("DELETE FROM `schedule_list` where id = '{$_GET['id']}'");

    if($delete){
                // Si la suppression est réussie, afficher une alerte de succès et rediriger vers la page d'accueil

        echo "<script> alert('Event has deleted successfully.'); location.replace('?page=home') </script>";
    }else{
                // Si une erreur se produit lors de la suppression, afficher les détails de l'erreur

        echo "<pre>";
        echo "An Error occured.<br>";
        // Affichage de l'erreur de la base de données
        echo "Error: ".$conn->error."<br>";
        // Affichage de la requête SQL
        echo "SQL: ".$sql."<br>";
        echo "</pre>";
    }
     // Fermeture de la connexion à la base de données
    $conn->close();
?>
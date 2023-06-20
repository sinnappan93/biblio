<?php 
    require_once('database/bd.php'); // Inclusion du fichier de connexion à la base de données

    if($_SERVER['REQUEST_METHOD'] != 'POST'){ // Vérification de la méthode de requête HTTP utilisée
        echo "<script> alert('Error: No data to save.'); location.replace('?page=home') </script>"; // Affichage d'une alerte et redirection vers la page d'accueil en cas d'absence de données à enregistrer
        $conn->close(); // Fermeture de la connexion à la base de données
        exit; // Arrêt de l'exécution du script
    }

    extract($_POST); // Extraction des variables POST dans le contexte actuel

    $allday = isset($allday); // Vérification si la case à cocher "allday" est cochée ou non

    if(empty($id)){ // Vérification si l'identifiant est vide, ce qui indique qu'il s'agit d'une nouvelle entrée
        $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`) VALUES ('$title','$description','$start_datetime','$end_datetime')"; // Construction de la requête SQL d'insertion
    }else{ // Si l'identifiant n'est pas vide, il s'agit d'une mise à jour d'une entrée existante
        $sql = "UPDATE `schedule_list` SET `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' WHERE `id` = '{$id}'"; // Construction de la requête SQL de mise à jour
    }

    $save = $conn->query($sql); // Exécution de la requête SQL d'enregistrement

    if($save){ // Vérification si l'enregistrement a réussi
        echo "<script> alert('Schedule Successfully Saved.'); location.replace('?page=home') </script>"; // Affichage d'une alerte et redirection vers la page d'accueil en cas de succès
    }else{
        echo "<pre>";
        echo "An Error occured.<br>"; // Affichage d'un message d'erreur en cas d'échec de l'enregistrement
        echo "Error: ".$conn->error."<br>"; // Affichage de l'erreur spécifique retournée par la base de données
        echo "SQL: ".$sql."<br>"; // Affichage de la requête SQL qui a provoqué l'erreur
        echo "</pre>";
    }
    
    $conn->close(); // Fermeture de la connexion à la base de données
?>

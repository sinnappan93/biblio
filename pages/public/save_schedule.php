<?php 
    require_once('database/bd.php');


  //------------------------------------------------------------------------------


  $debut = new DateTime('2023-05-01'); // Date de début
  $fin = new DateTime('2023-05-31'); // Date de fin
  $jour = explode('-', $fin);
  $semaine = $jour[2]; // Nombre de jours à incrémenter
  
  // Vérification si le nombre de jours à incrémenter est supérieur à zéro
  if ($semaine > 0) {
      // Copie de la date de début
      $date = clone $debut;
  
      // Incrémentation de la date en ajoutant le nombre de jours
      $interval = new DateInterval('P'.$fin.'D');
      $date->add($interval);
  
      // Vérification si la date incrémentée dépasse la date de fin
      if ($date > $fin) {
          // Réduire le nombre de jours à incrémenter pour atteindre la date de fin
          $diff = $date->diff($fin);
          $semaine -= $diff->days;
          $date = clone $fin;
      }
  
      // Affichage des dates depuis la date de début jusqu'à la date incrémentée
      while ($debut <= $date) {
          echo $debut->format('Y-m-d') . "<br>";
          $debut->add(new DateInterval('P7D')); // Incrémentation d'un jour
      }
  } else {
      echo "Le nombre de jours à incrémenter doit être supérieur à zéro.";
  }  





  //-----------------------------------------------------------------------------






/*


    if($_SERVER['REQUEST_METHOD'] !='POST'){
        //echo "<script> alert('Error: No data to save.'); location.replace('?page=home') </script>";
        $conn->close();
        exit;
    }

    extract($_POST);
    $allday = isset($allday);

  

    if(empty($id)){
        $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`) VALUES ('$title','$description','$start_datetime','$end_datetime')";
    }else{
        $sql = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
    }

    $save = $conn->query($sql);

    if($save){
        //echo "<script> alert('Schedule Successfully Saved.'); location.replace('?page=home') </script>";
    }else{
        echo "<pre>";
        echo "An Error occured.<br>";
        echo "Error: ".$conn->error."<br>";
        echo "SQL: ".$sql."<br>";
        echo "</pre>";
    }
    
    $conn->close();
?>*/
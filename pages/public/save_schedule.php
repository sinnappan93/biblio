<?php 

require_once('database/bd.php');

if($_SERVER['REQUEST_METHOD'] !='POST'){
        //echo "<script> alert('Error: No data to save.'); location.replace('?page=home') </script>";
        $conn->close();
        exit;
}

    if (!empty($_POST['recursif']) && !empty($_POST['end_datetime_r'])) {

        $date1 = $_POST['start_datetime'];
        $date2 = $_POST['end_datetime_r'];
        $date3 = $_POST['end_datetime'];
        
        // Convertir les chaînes de caractères en objets DateTime
        $startDate = new DateTime($date1);
        $endDate_r = new DateTime($date2);
        $endDate = new DateTime($date3);
        
        // Définir l'intervalle d'une semaine
        $interval = new DateInterval('P1W');
        
        // Créer un objet DatePeriod pour itérer sur les dates
        $datePeriod = new DatePeriod($startDate, $interval, $endDate_r);
        $datePeriod2 = new DatePeriod($endDate, $interval, $endDate_r);

        $array_startDate = array();
        $array_endDate = array();
        
        extract($_POST);
        $allday = isset($allday);
        
        // Parcourir et ajouter les dates dans un tableau
        foreach ($datePeriod as $date) {
            $test =  $date->format('Y-m-d H:i') . "<br>";
            array_push($array_startDate, $test);
        }
        
        foreach ($datePeriod2 as $dates) {
            $test2 =  $dates->format('Y-m-d H:i') . "<br>";
            array_push($array_endDate, $test2);

        }
        
        foreach($array_startDate as $index => $value) {
            $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`, `end_datetime_r`) VALUES ('$title','$description','$array_startDate[$index]','$array_endDate[$index]', '$end_datetime_r')";
            $save = $conn->query($sql); 
         }

         if($save){
            echo "<script> location.replace('?page=home') </script>";
        }else{
            echo "<pre>";
            echo "An Error occured.<br>";
            echo "Error: ".$conn->error."<br>";
            echo "SQL: ".$sql."<br>";
            echo "</pre>";
        }
        
        $conn->close();


      } else {
        
        extract($_POST);
        $allday = isset($allday);

        if(empty($id)){
            $sql = "INSERT INTO `schedule_list` (`title`,`description`, `participant2` ,`start_datetime`,`end_datetime`, `end_datetime_r`) VALUES ('$title','$description', '$participant2' ,'$start_datetime','$end_datetime', '$end_datetime_r')";
        }else{
            $sql = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}',`participant2` = '{$participant2}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
        }
    
        $save = $conn->query($sql);
    
        if($save){
            echo "<script> location.replace('?page=home') </script>";
        }else{
            echo "<pre>";
            echo "An Error occured.<br>";
            echo "Error: ".$conn->error."<br>";
            echo "SQL: ".$sql."<br>";
            echo "</pre>";
        }
        
        $conn->close();

      }

      if(empty($participant2)){

      }

?>
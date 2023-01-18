<?php


function requete($tables, $colonnes, $conditions){
    include('database/bd.php');
    $select = $db->prepare('SELECT '.$tables.' FROM '.$colonnes.' '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
    $result=$select->fetchAll();
    return $result;
}

function requete_distinct($tables, $colonnes, $conditions){
    include('database/bd.php');
    $select = $db->prepare('SELECT DISTINCT '.$tables.' FROM '.$colonnes.' '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
    $result=$select->fetchAll();
    return $result;
}

function delete1($tables, $conditions){
    include('database/bd.php');
    $select = $db->prepare('DELETE FROM '.$tables.' '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
}


function insert($tables, $colonnes, $conditions){
    include('database/bd.php');
    $select = $db->prepare('INSERT INTO '.$tables.'('.$colonnes.') '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
}

?>

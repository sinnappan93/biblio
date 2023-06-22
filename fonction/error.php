<?php

// Cette fonction exécute une requête SELECT avec des conditions et retourne les résultats sous forme d'objet
function requete($tables, $colonnes, $conditions){
    include('database/bd.php');
    $select = $db->prepare('SELECT '.$tables.' FROM '.$colonnes.' '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
    $result=$select->fetchAll();
    return $result;
}

// Cette fonction exécute une requête SELECT DISTINCT avec des conditions et retourne les résultats sous forme d'objet
function requete_distinct($tables, $colonnes, $conditions){
    include('database/bd.php');
    $select = $db->prepare('SELECT DISTINCT '.$tables.' FROM '.$colonnes.' '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
    $result=$select->fetchAll();
    return $result;
}

// Cette fonction exécute une requête DELETE avec des conditions pour supprimer des données de la table spécifiée
function delete1($tables, $conditions){
    include('database/bd.php');
    $select = $db->prepare('DELETE FROM '.$tables.' '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
}

// Cette fonction exécute une requête INSERT pour insérer des données dans la table spécifiée
function insert($tables, $colonnes, $conditions){
    include('database/bd.php');
    $select = $db->prepare('INSERT INTO '.$tables.'('.$colonnes.') '.$conditions.'');
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
}

?>

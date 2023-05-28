<?php
session_start();
require 'database/db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $login = $_SESSION['identifiant'] ;
    $mdp = $_POST['passwordconnect'];

    $pswd = $db->prepare("SELECT password, username FROM user WHERE id= '".$login."'"); // Requete SQL
    $pswd->setFetchMode(PDO::FETCH_OBJ); // Def méthode d'affichage 
    $pswd->execute(); 
    $results=$pswd->fetchAll();
    foreach($results as $result);
    $mdp_saisi =  $result->password;
    $profil = $result->username;
    $hash = password_hash($mdp, PASSWORD_DEFAULT); // hash le mdp pour comparaison

    if (password_verify($mdp, $mdp_saisi)) { // comparaison sur les passwords 
        if ($pswd->rowCount() == 1) {
            $_SESSION['profil'] = $profil;
            $authOK = true;
        }
    } 
}
?>

<div class="container">

    <?php
    if (isset($authOK)) {?>
    <?php
    if($_SESSION['profil'] == "administrateur"){
            ?><script>setTimeout(function(){window.location.href='index_admin.php'},0);</script><?php
        }else{
            ?><script>setTimeout(function(){window.location.href='index_public.php'},0);</script><?php
        }
    ?>    
    <?php
    }
    else { 
        ?>
        <div class="gif">
        <img src="assets/images/log_error.gif" class ="img-loading-erro"r>
        </div>

        <div class="texte-redirection">
        <h1>Vous n'avez pas été reconnu(e), redirection en cours ...</h1>
        <script>setTimeout(function(){window.location.href='index.php'},3000);</script>
        </div>
    <?php }?>

</div>


<?php
// mdp admi : testadmin
// mdp public : testpublic

?>


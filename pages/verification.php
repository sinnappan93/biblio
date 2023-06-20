<?php
session_start(); // Démarrage de la session
require 'database/db.php'; // Inclusion du fichier de connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérification si la méthode de requête HTTP utilisée est POST
    
    $login = $_SESSION['identifiant']; // Récupération de l'identifiant de session
    $mdp = $_POST['passwordconnect']; // Récupération du mot de passe saisi dans le formulaire

    $pswd = $db->prepare("SELECT password, username FROM user WHERE id= '".$login."'"); // Préparation de la requête SQL pour récupérer le mot de passe correspondant à l'identifiant
    $pswd->setFetchMode(PDO::FETCH_OBJ); // Définition du mode d'affichage des résultats de la requête
    $pswd->execute(); // Exécution de la requête
    $results = $pswd->fetchAll(); // Récupération de tous les résultats de la requête
    foreach($results as $result); // Parcours des résultats (un seul résultat attendu)
    $mdp_saisi =  $result->password; // Récupération du mot de passe stocké dans la base de données
    $profil = $result->username; // Récupération du nom d'utilisateur (profil) associé à l'identifiant
    $hash = password_hash($mdp, PASSWORD_DEFAULT); // Hachage du mot de passe saisi pour comparaison

    if (password_verify($mdp, $mdp_saisi)) { // Comparaison des mots de passe hachés
        if ($pswd->rowCount() == 1) { // Vérification si la requête a renvoyé un seul résultat
            $_SESSION['profil'] = $profil; // Stockage du profil dans la variable de session
            $authOK = true; // Authentification réussie
        }
    } 
}
?>

<div class="container">

    <?php
    if (isset($authOK)) { // Vérification si l'authentification est réussie
    ?>
    <?php
    if($_SESSION['profil'] == "administrateur"){ // Vérification du profil de l'utilisateur
            ?><script>setTimeout(function(){window.location.href='index_admin.php'},0);</script><?php // Redirection vers la page d'accueil de l'administrateur
        }else{
            ?><script>setTimeout(function(){window.location.href='index_public.php'},0);</script><?php // Redirection vers la page d'accueil du public
        }
    ?>    
    <?php
    }
    else { 
        ?>
        <div class="gif">
        <img src="assets/images/log_error.gif" class="img-loading-erro">
        </div>

        <div class="texte-redirection">
        <h1>Vous n'avez pas été reconnu(e), redirection en cours ...</h1>
        <script>setTimeout(function(){window.location.href='index.php'},3000);</script>
        </div>
    <?php }?>
</div>

<?php
// Mots de passe : admin - "testadmin", public - "testpublic"
?>

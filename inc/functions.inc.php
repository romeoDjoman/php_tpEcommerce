<?php
// Session utilisateur et session admin
function type_session(){
    if (!empty($_SESSION['membre']['id_membre'])) {
        // Recupérer le numéro de statut
        $statut = $_SESSION['membre']['statut'];
        if ($statut == 0) {
            // session user 
            return "Utilisateur"; 
        } else {
            return "Administrateur";
        }
        
    } else {
        return "notConnected";
    }
}

$affiche_statut = type_session();



// Système de déconnexion 
function deconnexion(){
     // Vérifier si l'utilisateur a cliqué sur le bouton de déconnexion
     if(isset($_GET['deconnexion'])){
        // Si oui, détruire la session et rediriger l'utilisateur vers la page de connexion
        session_destroy();
        header('Location:index.php');
        exit;
    }
}

deconnexion();

?>
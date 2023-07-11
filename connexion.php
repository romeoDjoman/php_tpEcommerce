<?php
require_once("inc/init.inc.php");
require_once("inc/functions.inc.php");


// Session connexion utilisateur
if (isset($_POST['connexion'])) {
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);
    

    if(!empty($pseudo) && !empty($mdp)){
        $pseudo = htmlspecialchars($pseudo); 

        $recup_bdd = $pdo->prepare('SELECT * FROM membre WHERE pseudo = :pseudo'); 
        $recup_bdd->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $recup_bdd->execute();

        if ($recup_bdd->rowCount() > 0) {
            $donnees = $recup_bdd->fetch(PDO::FETCH_ASSOC);
            $mdp_hash = $donnees['mdp'];

            if (password_verify($mdp, $mdp_hash)) {
                
                
                $_SESSION['membre'] = $donnees; 
                unset($_SESSION['mdp']); 
                // var_dump($_SESSION); 
                
                
                // Varibale de contrôle erreur = false 
                $message_connexion .= "<div class='alert alert-danger' role='alert'>
                Bravo, $pseudo ! Votre connexion est réussie !
                </div>";
                
                header('location:user.php');
            } else {
                $erreur = true;
                $message_connexion .= "<div class='alert alert-danger' role='alert'>
                Il semble que votre pseudo ou votre mot de passe soient incorrects. Veuillez essayer à nouveau, s'il vous plaît. 
                </div>";
            } 
        } else {
            $message_connexion .= "<div class='alert alert-danger' role='alert'>
                Votre pseudo n'exite pas dans la base de donnée ! 
            </div>";
        }
    }
   
}
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php"); // Menu de navigation
?>


<!-- Begin incription content -->
<br>
<div class="container justify-content-center  my-5"
    style="width: 30%; border-radius: 6px; background-color: #cfe2ff; ">
    <br>
    <h1 class="text-center">Connexion</h1>
    <br>
    <form method="post" action="" enctype="multipart/form-data" style="padding-left: 40px; padding-right: 40px;">
        <div class="row">
            <!-- Message de connexion -->
            <div><?= $message_connexion ?></div>
            <div class="col-md-12">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" placeholder="Enter votre pseudo" name="pseudo"
                    autocomplete="off" required>
            </div>
            <div class="col-md-12">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Enter mot de passe" name="mdp"
                    autocomplete="off" required>
            </div>
        </div>
        <div class="col-auto text-center"> <br>
            <button type="submit" class="btn btn-primary mb-3" name="connexion">Connexion</button>
        </div>
        <br>
    </form>
</div>



<!-- Footer -->
<?php
require_once("inc/footer.inc.php"); // Footer = </body> à </html>
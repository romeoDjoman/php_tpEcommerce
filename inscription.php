<?php
require_once("inc/init.inc.php"); // init.php  
require_once("inc/functions.inc.php"); // Les fonctions.php



// Controles du formulaire d'inscription
if (
    isset(
        $_POST['pseudo'],
        $_POST['mdp'],
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['sexe'],
        $_POST['ville'],
        $_POST['cp'],
        $_POST['adresse']
    )

) {

    // Traitement des champs
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $sexe = trim($_POST['sexe']);
    $ville = trim($_POST['ville']);
    $cp = trim($_POST['cp']);
    $adresse = trim($_POST['adresse']);
    $statut = 0;  // Numéro des clients 


    if (
        empty($pseudo) ||
        empty($mdp) ||
        empty($nom) ||
        empty($prenom) ||
        empty($email) ||
        empty($sexe) ||
        empty($ville) ||
        empty($cp) ||
        empty($adresse)
    ) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, toutes les saisies sont obligatoires !
      </div>';
    }

    // Controle sur la taille du pseudo 
    if (iconv_strlen($pseudo) < 3 || iconv_strlen($pseudo) > 15) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, le pseudo doit avoir une taille entre 3 et 15.
        </div>';
    }

    // Controle sur l'email
    if (iconv_strlen($email) > 50) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, l\'email ne doit pas contenir plus de 50 caractères .
        </div>';
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        // cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, votre email n\'est pas valide !
      </div>';
    }

    // Controle sur le mot de passe 
    if (iconv_strlen($mdp) < 8 || iconv_strlen($mdp) > 100) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, le mot de passe doit être compris entre 8 et 32.
        </div>';
    }

    // Controle sur le nom, prenom et la ville 
    if (iconv_strlen($nom) < 3 || iconv_strlen($nom) > 20) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, Votre nom doit comprendre 3 à 20 caractères
        </div>';
    }

    if (iconv_strlen($prenom) < 3 || iconv_strlen($prenom) > 20) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, Votre nom doit comprendre 3 à 20 caractères
        </div>';
    }

    $caractere_autorise_nom = preg_match('#^[a-zA-Z._-]+$#', $nom);
    $caractere_autorise_prenom = preg_match('#^[a-zA-Z._-]+$#', $prenom);
    // Controle sur les caractères autorisés de nom et prenom
    if ($caractere_autorise_nom == false) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Votre nom ne peut contenir que les caractères suivants : <br>
        <ul>
            <li>Minuscules<li> 
            <li>Majuscules<li> 
            <li>Points<li> 
            <li>Underscores<li>
        </ul> </div>';
    }

    if ($caractere_autorise_prenom == false) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Votre prenom ne peut contenir que les caractères suivants : <br>
        <ul> 
            <li>Minuscules<li> 
            <li>Majuscules<li> 
            <li>Points<li> 
            <li>Underscores<li>
        </ul> </div>';
    }


    // Controle sur la ville 
    if (iconv_strlen($ville) < 3 || iconv_strlen($ville) > 20) {
        // Cas d'erreur 
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, le nom de votre ville doit être compris en 3 et 20 caractères
        </div>';
    }

    // Controle sur le code postale
    if (is_numeric($cp) && iconv_strlen($cp) != 5) {
        // cas d'erreur
        $erreur = true;
        $message_inscription .= '<div class="alert alert-danger" role="alert">
        Attention, le code postale doit être composé de 5 chiffres
        </div>';
    }


    if ($erreur == false) {

        // Hasher le mot de passe 
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

        // Enregistrement dans la base de données 
        $bdd_enreg = $pdo->prepare('INSERT INTO membre (pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse, 0)');

        $bdd_enreg->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':mdp', $mdp_hash, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':nom', $nom, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':email', $email, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':ville', $ville, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':cp', $cp, PDO::PARAM_STR);
        $bdd_enreg->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $bdd_enreg->execute();

        $message_inscription .= '<div class="alert alert-success" role="alert">
            Vous êtes bien inscrit ! </div>';

        header('location:connexion.php');
    }
}

require_once("inc/header.inc.php"); // Header = Doctype à <body>
require_once("inc/nav.inc.php"); // Menu de navigation

?>


<!-- Begin incription content -->

<div class="container justify-content-center text-center my-5" style="width: 40%; border-radius: 6px; background-color: #cfe2ff;">
    <br>
    <h1>Inscription</h1>
    <br>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="row">
            <!-- $message_inscription d'errer -->
            <div><?= $message_inscription ?></div>
            <div class="col">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" placeholder="Enter votre pseudo" name="pseudo" required>
            </div>
            <div class="col">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Enter mot de passe" name="mdp" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" placeholder="Enter votre nom" name="nom" required>
            </div>
            <div class="col">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" placeholder="Enter votre prenom" name="prenom" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter votre email" name="email" required>
            </div>
            <div class="col">
                <label for="sexe" class="form-label">Sexe (M/F)</label>
                <select class="form-control" name="sexe" required>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" placeholder="Enter votre ville" name="ville" required>
            </div>
            <div class="col">
                <label for="cp" class="form-label">Code Postal</label>
                <input type=" " class="form-control" placeholder="Enter votre code postal" name="cp" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" placeholder="Enter votre adresse" name="adresse" required>
            </div>
        </div>
        <div class="col-auto"> <br>
            <button type="submit" class="btn btn-primary mb-3">Inscription</button>
        </div>
        <br>
    </form>

</div>

<!-- Footer -->
<?php
require_once("inc/footer.inc.php"); // Footer = </body> à </html>
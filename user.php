<?php
require_once("inc/init.inc.php");
require_once("inc/functions.inc.php");


// Je fais cette vérification mais les informations sont déjà stockés dans le session
$informations_user = array();
if (isset($_SESSION['membre']['id_membre'])) {
    try {
        // Récupérer les informations du membre dans la bdd en utilisant une requête préparée
        $informations = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
        $informations->bindParam(':pseudo', $_SESSION['membre']['pseudo'], PDO::PARAM_STR);
        $informations->execute();
        $informations_user = $informations->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $error) {
        echo "Une erreur est survenue lors de la récupération des informations du membre : " . $error->getMessage();
    }
}

require_once("inc/header.inc.php");
require_once("inc/nav.inc.php"); // Menu de navigation

?>

<!-- Begin user content -->

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4">
            <h2 style="margin-left: 20px;">A propos</h2>
            <p style="margin-left: 30px; font-size: 1em;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                    <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z" />
                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                </svg>
                Premium
            </p>
            <div class="fakeimg">
                <img src="http://via.placeholder.com/150x150" alt="" style="border-radius: 50%;">
            </div>
            <h3 class="mt-4">Navigation</h3>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Mes commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Suivi livraison</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mes retours</a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link" href="#mes_informations">Mes informations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Mode de paiement </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Changement de mot de passe</a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Déconnexion</a>
                </li>
            </ul>
            <hr class="d-sm-none">
        </div>
        <div class="col-sm-8">
            <h2>Dernière commande</h2>
            <h5>Basket nike, 13 Juin, 2023</h5>
            <div class="fakeimg">Photo commande
                <img src="http://via.placeholder.com/700x250" alt="">
            </div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>

            <h2 class="mt-5">TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2020</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <h2 style="margin-left: 20px; text-align: center;" id="mes_informations">Mes Informations</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" value="<?= $_SESSION['membre']['pseudo'] ?>" name="pseudo">

                    <!-- Dans le cas ou j'utilise la vérification qui est plus haut -->
                    <!-- <input type="text" class="form-control" value="isset($informations_user['pseudo']) ? $informations_user['pseudo'] : '' ?>" name="pseudo"> -->
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control"  name="nom" value="<?= $_SESSION['membre']['nom'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control"  name="prenom" value="<?= $_SESSION['membre']['prenom'] ?>">
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control"  name="email" value="<?= $_SESSION['membre']['email'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="sexe" class="form-label">Sexe (M/F)</label>
                    <select class="form-control" name="sexe">
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-3">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control"  name="ville" value="<?= $_SESSION['membre']['ville'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="cp" class="form-label">Code Postal</label>
                    <input type=" " class="form-control"  name="cp" value="<?= $_SESSION['membre']['cp'] ?>">
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control"  name="adresse" value="<?= $_SESSION['membre']['adresse'] ?>">
                </div>
            </div>
            <div class="col-md-6"> <br>
                <button type="submit" class="btn btn-primary mb-3 col-md-6 offset-6 ">Modifier mes informations</button>
            </div>
        </form>
    </div>
</div>





<!-- Footer -->
<?php
require_once("inc/footer.inc.php"); // Footer = </body> à </html>
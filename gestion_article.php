<?php
require_once("inc/init.inc.php"); // init.php  
require_once("inc/functions.inc.php"); // Les fonctions.php 


if (
    isset(
        $_POST['reference'],
        $_POST['categorie'],
        $_POST['titre'],
        $_POST['description'],
        $_POST['couleur'],
        $_POST['taille'],
        $_POST['sexe'],
        $_POST['prix'],
        $_POST['stock']
    ) &&
    isset($_FILES['photo'])
) {

    // Traitement des champs
    $reference = trim($_POST['reference']);
    $categorie = trim($_POST['categorie']);
    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);
    $couleur = trim($_POST['couleur']);
    $taille = trim($_POST['taille']);
    $sexe = trim($_POST['sexe']);
    $prix = trim($_POST['prix']);
    $stock = trim($_POST['stock']);
    $photo = $_FILES['photo']['name'];

    if (
        empty($reference) ||
        empty($categorie) ||
        empty($titre) ||
        empty($description) ||
        empty($couleur) ||
        empty($taille) ||
        empty($sexe) ||
        empty($prix) ||
        empty($stock)
    ) {
        // cas d'erreur 
        $erreur = true;
        $message_enreg_article .= '<div class="alert alert-danger" role="alert">
            Attention, tous les champs sont obligatoires !
        </div>';
    } else {

        // Expression regulière pour prix
        if (!preg_match('/^\d{1,5}(\.\d{1,2})?$/', $prix)) {
            // cas d'erreur 
            $erreur = true;
            $message_enreg_article .= '<div class="alert alert-danger" role="alert">
                Montant non valide ! Veuillez entrer un nombre décimal avec un maximum de 5 chiffres avant la virgule et 2 chiffres après la virgule.
            </div>';
        }

        // Expression regulière pour stock
        if (!preg_match('/^\d{1,4}$/', $stock)) {
            // cas d'erreur 
            $erreur = true;
            $message_enreg_article .= '<div class="alert alert-danger" role="alert">
                La quantité en stock ne peux dépasser 4 chiffres.
            </div>';
        }

        // Retirer les injections HTML
        if (isset($description)) {
            $description = htmlspecialchars($description);
        }
    }
}

// Enregistrement dans la BBD 
if (isset($_POST['submit'])) {
    // requete préparée
    $bdd_enreg_article = $pdo->prepare('INSERT INTO article (
    reference, categorie, titre, description, couleur, taille, sexe, photo, prix, stock) 
    VALUES (
    :reference,
    :categorie,
    :titre,
    :description,
    :couleur,
    :taille,
    :sexe,
    :photo,
    :prix,
    :stock)');

    // Recupérer les valeurs dans les variables 
    $bdd_enreg_article->bindParam(':reference', $reference);
    $bdd_enreg_article->bindParam(':categorie', $categorie);
    $bdd_enreg_article->bindParam(':titre', $titre);
    $bdd_enreg_article->bindParam(':description', $description);
    $bdd_enreg_article->bindParam(':couleur', $couleur);
    $bdd_enreg_article->bindParam(':taille', $taille);
    $bdd_enreg_article->bindParam(':sexe', $sexe);
    $bdd_enreg_article->bindParam(':photo', $photo);
    $bdd_enreg_article->bindParam(':prix', $prix);
    $bdd_enreg_article->bindParam(':stock', $stock);
    $bdd_enreg_article->execute();

    $message_enreg_article .= '<div class="alert alert-success" role="alert">
            L\'article a été ajouté dans la Base de données ! </div>';
}


// Ajouter ou supprimer à la bdd 
// // $suppression_article = $pdo->query('DELETE FROM article WHERE condition');
// if (isset($_GET['reference'])) {
//     $reference = $_GET['reference'];

//     // Execute the DELETE statement on the database here
//     // ...

//     // If the deletion is successful, return "success"
//     echo "success";
// } else {
//     // If the article ID is not provided, return an error
//     echo "error";
// }

require_once("inc/header.inc.php"); // Header = Doctype à <body>
require_once("inc/nav.inc.php"); // Menu de navigation

?>

<!-- Begin content gestion article -->

<br>
<div class="container" style="width: 50%; border-radius: 6px; background-color: #cfe2ff; ">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="" enctype="multipart/form-data">
                <div><?= $message_enreg_article ?></div>
                <br>
                <h1 class="text-center">Ajout d'article</h1>
                <p class="text-center">L'article ajouté sera affiché dans le tableau ci-dessous</p>
                <div class="form-group">
                    <label>Reference:</label>
                    <input type="text" class="form-control" name="reference">
                </div>
                <div class="form-group">
                    <label>Categorie:</label>
                    <select class="form-control" name="categorie">
                        <option>Choisissez votre catégorie</option>
                        <option>Nouveautés</option>
                        <option>Vêtements</option>
                        <option>Chaussures</option>
                        <option>Vacances</option>
                        <option>Grandes occasions</option>
                        <option>Denim</option>
                        <option>Sport</option>
                        <option>Accessoires</option>
                        <option>Topman</option>
                        <option>Visage & Corps</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Titre:</label>
                    <select class="form-control" name="titre">
                        <option disabled selected>Choisissez votre article</option>
                        <option>Topman - Short à fines rayures coupe slim - Gris</option>
                        <option>Polo Ralph Lauren - Chemise Oxford cintrée - Blanc</option>
                        <option>schuh - Rogan - Mocassins chunky en cuir - Marron</option>
                        <option>Walk London - Terry - Mocassins en cuir à enfiler - Noir</option>
                        <option>Tommy Hilfiger - Pull en laine mérinos - Bleu marine</option>
                        <option>Levi's - 511 Slim Fit - Jean en denim - Noir</option>
                        <option>Adidas Originals - Sweat-shirt avec logo - Gris</option>
                        <option>H&M - T-shirt en jersey - Blanc</option>
                        <option>Zara - Pantalon chino skinny - Beige</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <input type="text" class="form-control" name="description">
                </div>
                <div class="form-group">
                    <label>Couleur:</label>
                    <select class="form-control" name="couleur">
                        <option disabled selected>Choisissez votre couleur</option>
                        <option>Argenté</option>
                        <option>Blanc</option>
                        <option>Bleu</option>
                        <option>Bleu marine</option>
                        <option>Gris</option>
                        <option>Jaune</option>
                        <option>Marron</option>
                        <option>Multicolore</option>
                        <option>Noir</option>
                        <option>Orange</option>
                        <option>Rose</option>
                        <option>Rouge</option>
                        <option>Sans opinion</option>
                        <option>Vert</option>
                        <option>Violet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Taille:</label>
                    <select class="form-control" name="taille">
                        <option disabled selected>Choisissez votre taille</option>
                        <option>FR 56</option>
                        <option>EU 36</option>
                        <option>EU 38</option>
                        <option>EU 40</option>
                        <option>EU 42</option>
                        <option>EU 44</option>
                        <option>EU 46</option>
                        <option>2XS</option>
                        <option>XS</option>
                        <option>S</option>
                        <option>S Tall</option>
                        <option>M</option>
                        <option>M tall</option>
                        <option>L</option>
                        <option>L Tall</option>
                        <option>XL</option>
                        <option>XL Tall</option>
                        <option>XXL</option>
                        <option>2XL</option>
                        <option>3XL</option>
                        <option>4XL</option>
                        <option>5XL</option>
                        <option>6XL</option>
                        <option>2XL Long</option>
                        <option>3XS</option>
                        <option>W26</option>
                        <option>W26-29</option>
                        <option>W28 L32</option>
                        <option>W29 L32</option>
                        <option>W29-32</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sexe</label>
                    <select class="form-control" name="sexe">
                        <option disabled selected>Choisissez votre sexe</option>
                        <option value="m">Homme</option>
                        <option value="f">Femme</option>
                </div>
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control-file" id="photo" name="photo">
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input type="text" class="form-control" id="prix" name="prix">
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock">
                </div>
                <div class="col-auto text-center"> <br>
                    <a href="gestion_article.php?supprimer=Ok">
                        <button type="submit" class="btn btn-primary mb-3" name="submit">Enregistrer l'article</button>
                    </a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
<br><br>

<!-- Elements du tableau -->

<?php
$recup_article = $pdo->query('SELECT * FROM article');
$tableau = array();

while ($ligne = $recup_article->fetch(PDO::FETCH_ASSOC)) {
    $tableau[] = $ligne;
}
?>

<div class="container-fluid">
    
    <div class="text-center">
        <br>
        <h1>Liste des articles</h1>
        <br>
    </div>
    <table class="table"    >
        <thead>
            <tr>
                <th scope="col">Reference</th>
                <th scope="col">Categorie</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Couleur</th>
                <th scope="col">Taille</th>
                <th scope="col">Sexe</th>
                <th scope="col">Photo</th>
                <th scope="col">Prix</th>
                <th scope="col">Stock</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableau as $affiche_ligne_article) { ?>
                <tr>
                    <td><?= $affiche_ligne_article['reference'] ?></td>
                    <td><?= $affiche_ligne_article['categorie'] ?></td>
                    <td><?= $affiche_ligne_article['titre'] ?></td>
                    <td><?= $affiche_ligne_article['description'] ?></td>
                    <td><?= $affiche_ligne_article['couleur'] ?></td>
                    <td><?= $affiche_ligne_article['taille'] ?></td>
                    <td><?= $affiche_ligne_article['sexe'] ?></td>
                    <td><img src="<?= $affiche_ligne_article['photo'] ?>" alt="photo"></td>
                    <td><?= $affiche_ligne_article['prix'] ?></td>
                    <td><?= $affiche_ligne_article['stock'] ?></td>
                    <td>
                        <button type="button" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                            </svg>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</div>

<?php
require_once("inc/footer.inc.php"); // Footer = </body> à </html>

?>
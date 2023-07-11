<!-- Begin header -->
<header>
    <!-- Barre logo, recherche et connexion  -->
    <div class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">eShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                    <li class="nav-item dropdown">

                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                            <?php
                            
                            if ($affiche_statut == "Utilisateur" || $affiche_statut == "Administrateur") { ?>
                                <li class="nav-item"><a class="nav-link" href="user.php">Profil</a></li>
                            <?php
                            }

                            if ($affiche_statut == "Administrateur") {
                                echo '<li class="nav-item"><a class="nav-link" href="gestion_article.php">Gestion des articles</a></li>';
                            }

                            

                            if ($affiche_statut == "notConnected") { ?>
                                <li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>
                                <li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>
                            <?php
                            }
                            ?>

                                                        <?php
                            if ($affiche_statut == "Utilisateur" || $affiche_statut == "Administrateur") { ?>
                                <li class="nav-item"><a class="nav-link btn btn-danger " href="connexion.php?deconnexion=ok">Déconnexion</a></li>
                            <?php
                            }
                            ?>

                        </ul>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Rechercher des articles" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Menu principal -->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Catégories</a>

            <div class="collapse navbar-collapse" id="navbarN av">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Nouveautés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vêtements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Chaussures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vacances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Grandes occasions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Denim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sport</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  
</header>
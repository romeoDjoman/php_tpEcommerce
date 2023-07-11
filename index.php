<?php
require_once("inc/init.inc.php"); // init.php  
require_once("inc/functions.inc.php"); // Les fonctions.php 
require_once("inc/header.inc.php"); // Header = Doctype à <body>
require_once("inc/nav.inc.php"); // Menu de navigation

?>


<!-- Begin Accueil content -->
<main>


    <!-- Caroussel -->
    <div id="carouselExampleCrossfade" class="carousel slide carousel-fade" data-mdb-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/img_bann.jpg" class="d-block w-100" alt="Wild Landscape" />
            </div>
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp" class="d-block w-100" alt="Camera" />
            </div>
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="d-block w-100" alt="Exotic Fruits" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Panneau publicitaire -->
    <!-- <div class="p-5 bg-primary text-white text-center">
        <p style="font-size: 2.5em; font-weight: bold;">Les soldes en ce moment !</p>
        <p style="font-size: 1.5em;">Reduction jusqu'à -80%</p>
        <p>Il n'y a pas de meilleur moment que celui-ci pour te faire plaisir.</p>
    </div> -->

    <br><br>

    <!-- Begin section 1 : Categories -->
    <section class="container">
        <h1>Produits</h1>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="width: 12rem;">
                    <img src="http://via.placeholder.com/200x250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">CHEMISES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 12rem;">
                    <img src="http://via.placeholder.com/200x250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">SHORTS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 12rem;">
                    <img src="http://via.placeholder.com/200x250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">COSTUMES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 12rem;">
                    <img src="http://via.placeholder.com/200x250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">T-SHIRTS</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Espacement provisoire -->
    <br><br>


    <!-- Begin section 2 : Caroussel -->
    <section class="container">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="http://via.placeholder.com/1200x600" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="http://via.placeholder.com/1200x600" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="http://via.placeholder.com/1200x600" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </section>

    <!-- Espacement provisoire -->
    <br><br>

    <!-- Begin section 3 : Marques -->
    <section class="container">
        <h1>Marques</h1>
        <br>
        <div class="row justify-content-center justify-content-between ">

            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="http://via.placeholder.com/300x250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">ADIDAS <br>Trois bandes qui font ton look</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="http://via.placeholder.com/300x250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">NIKE <br>La virgule du bonheur</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="http://via.placeholder.com/300x250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">LOUIS VUITTON <br>Le luxe au rendez-vous</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>



<?php
require_once("inc/footer.inc.php"); // Footer = </body> à </html>

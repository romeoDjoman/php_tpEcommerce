<?php 
// Session 
// Connexion à la base de donnée
// bdd en local : tic_site
$host = 'mysql:host=localhost;dbname=tic_site';
$login = 'root'; // login
$password = ''; // mdp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
$pdo = new PDO($host, $login, $password, $options); // La Bdd en local tic_site
session_start();


// Formulaire d'inscription et de connexion
$message_inscription = "";
$message_connexion = "";
$erreur = false; // Varibale de contrôle 
$statut = null;
$message_enreg_article = "";

// URL absolue
define("URL", "localhost/eshop");

// Fonction user et admin 
$affiche_statut = null;

// Fonction déconnexion 



?>
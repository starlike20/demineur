<?php
// Création de la connexion
$connexion = new mysqli("localhost", "root", "", "source_db");
$connexion->set_charset("utf8");

// Vérification de la connexion
if ($connexion->connect_error) {
    printf("Erreur : Connexion impossible : ". $connexion->connect_error);
    exit();
} 	
?>
<?php
if(isset($_SESSION['login'])) {
    include('connexion.php');
    $nomp=$_SESSION['login'];
    $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$nomp."'");
    $recupid = $sqlRecupId->fetch();
    $idClient=$recupid['idClient'];
    $results = $dbh->query("SELECT * FROM Client WHERE idClient='". $idClient."'");
    echo("<h2>Infos de ".$nomp."</h2>");
    echo("<table class='Horaires' >"); // nom a changer mais bug avec le ftp :/
    echo("<tr>");
    echo('<td>NomDeLaDonnée</td>');
    echo('<td>Valeur</td>');
    echo("</tr>");
    $ligne = $results->fetch();
    echo("<tr>");
    echo('<td>Nom</td>');
    echo('<td>'. $ligne['NomClient'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>Prenom</td>');
    echo('<td>'. $ligne['PrenomClient'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>Naissance</td>');
    echo('<td>'. $ligne['DateNaissanceClient'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>Adresse</td>');
    echo('<td>'. $ligne['AdresseClient'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>tel</td>');
    echo('<td>'. $ligne['TelClient'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>mail</td>');
    echo('<td>'. $ligne['mail'] .'</td>');
    echo("</tr>");
    $results2 = $dbh->query("SELECT * FROM Skieur WHERE idClient='". $idClient."'");
    $ligne2 = $results2->fetch();
    echo("<tr>");
    echo('<td>Niveau</td>');
    echo('<td>'. $ligne2['NiveauSkieur'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>Taille</td>');
    echo('<td>'. $ligne2['TailleSkieur'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>Poids</td>');
    echo('<td>'. $ligne2['PoidsSkieur'] .'</td>');
    echo("</tr>");
    echo("<tr>");
    echo('<td>Pointure</td>');
    echo('<td>'. $ligne2['PointureSkieur'] .'</td>');
    echo("</tr>");


    echo("</table>");
}
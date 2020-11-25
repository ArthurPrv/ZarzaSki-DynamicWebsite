<?php //affiche les groupe et les chef de ces derniers
include ('affichagebefore.php');
if(isset($_SESSION['login'])&&$_SESSION['admin']==1) {

    include('connexion.php');
    $nomp=$_GET['nomp'];
    $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$nomp."'");
    $recupid = $sqlRecupId->fetch();
    $idClient=$recupid['idClient'];
    $results = $dbh->query("SELECT Groupe.NomGroupe,idChef FROM Groupe,Appartenir WHERE idClient='". $idClient."' AND Appartenir.NomGroupe=Groupe.NomGroupe;");
    echo("<h2>Groupes de ".$nomp."</h2>");
    echo("<table class='Horaires' >"); // nom a changer mais bug avec le ftp :/
    echo("<tr>");
    echo('<td>NomDuGroupe</td>');
    echo('<td>ChefDuGroupe</td>');
    echo("</tr>");

    while ($ligne = $results->fetch()) {
        echo("<tr>");
        echo('<td>' . $ligne['NomGroupe'] . '</td>');
        $sqlRecupName = $dbh->query("SELECT NomClient,PrenomClient from Client where idClient='".$ligne['idChef']."'");
        $recupName = $sqlRecupName->fetch();
        echo('<td>' . $recupName['NomClient']." ".$recupName['PrenomClient'] . '</td>');
        echo("</tr>");
    }
    $results->closeCursor();

    $resulta = $dbh->query("SELECT count(*) as 'ct' FROM Groupe,Appartenir WHERE idClient='". $idClient."' AND Appartenir.NomGroupe=Groupe.NomGroupe;");
    while ($ligne = $resulta->fetch()) {
        echo("<tr>");
        echo('<td>Total</td>');
        echo('<td>' . $ligne["ct"] . '</td>');
        echo("</tr>");
    }
    echo("</table>");
    $resulta->closeCursor();
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


    echo("</table>");

}


include ('affichageafter.php');
 
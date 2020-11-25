<?php //affichage des membres d'un groupe dans un cas particulier
include('affichagebefore.php');
if(isset($_SESSION['login'])&&$_SESSION['admin']==1) {
    include('connexion.php');
    $nomg = $_GET['nomg'];
    $results = $dbh->query("SELECT NomClient,PrenomClient,mail FROM Appartenir,Client WHERE Appartenir.idClient=Client.idClient AND NomGroupe='" . $nomg . "';");
    echo("<h2>Membres de '" . $nomg . "'</h2>");
    echo("<table class='Horaires' >"); // nom a changer mais bug avec le ftp :/
    echo("<tr>");
    echo('<td>Membres</td>');
    echo('<td>Mails</td>');
    echo("</tr>");

    while ($ligne = $results->fetch()) {
        echo("<tr>");
        echo('<td>' . $ligne['NomClient'] . " " . $ligne['PrenomClient'] . '</td>');
        echo('<td>' . $ligne['mail'] . '</td>');
        echo("</tr>");
    }
    $results->closeCursor();

    echo("</table>");
}
elseif(isset($_SESSION['login'])&&$_SESSION['admin']==0) {
    include('connexion.php');
    $nomg = $_GET['nomg'];
    $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$_SESSION['login']."'");
    $recupid = $sqlRecupId->fetch();
    $id=$recupid['idClient'];

    $verifie = $dbh->query("SELECT COUNT(*) FROM Groupe WHERE NomGroupe='".$nomg."' and idChef='".$id."'");
    $verified= $verifie->fetch();
    $verification= $verified['COUNT(*)'];


    if($verification!=0) {
        include('connexion.php');
        $nomg = $_GET['nomg'];

        $results = $dbh->query("SELECT NomClient,PrenomClient,mail FROM Appartenir,Client WHERE Appartenir.idClient=Client.idClient AND NomGroupe='" . $nomg . "';");
        echo("<h2>Membres de '" . $nomg . "'</h2>");
        echo("<table class='Horaires' >"); // nom a changer mais bug avec le ftp :/
        echo("<tr>");
        echo('<td>Membres</td>');
        echo('<td>Mails</td>');
        echo("</tr>");

        while ($ligne = $results->fetch()) {
            echo("<tr>");
            echo('<td>' . $ligne['NomClient'] . " " . $ligne['PrenomClient'] . '</td>');
            echo('<td>'.$ligne['mail'].'</td>');
            echo("</tr>");
        }
        $results->closeCursor();

        echo("</table>");
    }
}
include ('affichageafter.php');
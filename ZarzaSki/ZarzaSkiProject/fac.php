<?php //afficher la facture grace a la vue qui calcul le prix par utilisateur
include("affichagebefore.php");
if(isset($_SESSION['login'])) {
    include('connexion.php');
    $nomg=$_GET['nomg'];
    //recuperer l'id du chef
    $sqlRecupIdCurrent = $dbh->query("SELECT idClient from Client where mail='".$_SESSION['login']."'");
    $recupidCurrent = $sqlRecupIdCurrent->fetch();
    $idChef=$recupidCurrent['idClient'];

    $verifie = $dbh->query("SELECT COUNT(*) FROM Groupe WHERE NomGroupe='".$nomg."' and idChef='".$idChef."'");
    $verified= $verifie->fetch();
    $nbrxPersonne= $verified['COUNT(*)'];

    if($nbrxPersonne==0){ header('location:formulairelogin.php');}
    else {


        $recupPrix = $dbh->query("SELECT Tarif_Par_Groupe FROM Tarifgroupe where NomGroupe='".$nomg."'");
        $prixtemp = $recupPrix->fetch();
        $prixTotal = $prixtemp['Tarif_Par_Groupe'];

        $restePersonne=$nbrxPersonne;
        $sortie=true;
        $chambre6=0;
        $chambre4=0;
        $chambre2=0;
        do {
            $tempPersonne=$restePersonne;
            if ($restePersonne >= 6) {
                $restePersonne = $restePersonne % 6;
                $chambre6+= ($tempPersonne-$restePersonne)/6;
            } elseif ($restePersonne >= 4) {

                $restePersonne = $restePersonne % 4;
                $chambre4+= ($tempPersonne-$restePersonne)/4;
            } elseif ($restePersonne >= 2) {

                $restePersonne = $restePersonne % 2;
                $chambre4+= ($tempPersonne-$restePersonne)/2;
            } else {
                $sortie = false;
            }
        }while($sortie);
        if($restePersonne==1)$chambre2+=1;
        $prixTotal += $restePersonne*150;

        /*
         * Calculer le prix par client
         * l'additionner
         * tarif de bases = 510 € Non skieur = 420 enfant<12 = tarif*0.8 -2 ans == free
         * Chambre = 2 4 et 6 personnes
         * Si un lit pas occupé on paye le lit vide
         *
         */

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
            echo("Vous aurez donc besoin de $chambre2 chambre de 2 personnes, $chambre4 chambre(s) de 4 personnes, $chambre6 chambre(s) de 6 personnes </br> Le total vous coutera donc $prixTotal pour la totalité des membres du groupes chambres comprises");





    }
} else {
    header('location:formulairelogin.php');
}
include ("affichageafter.php");
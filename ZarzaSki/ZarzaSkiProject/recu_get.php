<?php // permet de changer le gérant d'un groupe en vérifiant que la personne qui change est bien gérant, admin et que l'utilisateur est bien dans ce groupe
session_start();
if(isset($_SESSION['login'])) {//verifie qu'il est login et admin
    include('connexion.php');
    $nomG=$_POST['nomg'];
    $mail=$_POST['mail'];

    $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$mail."'");
    $recupid = $sqlRecupId->fetch();
    $idC=$recupid['idClient'];

    $sqlRecupIdCurrent = $dbh->query("SELECT idClient from Client where mail='".$_SESSION['login']."'");
    $recupidCurrent  = $sqlRecupIdCurrent->fetch();
    $idCurrent=$recupidCurrent ['idClient'];

    $sqlVerifie = $dbh->query("SELECT COUNT(*) from Appartenir where  NomGroupe='".$nomG."' and idClient='".$idC."'");
    $result = $sqlVerifie->fetch();

    if( !($result["COUNT(*)"]!=0))header('location:formulairelogin.php');//déjà dans le groupe on peut tjr ajouter des aides avec le get ( a faire a la fin)
    else {
        if($_SESSION['admin']==1) {
            $sql = "UPDATE Groupe SET idChef='" . $recupid['idClient'] . "' where NomGroupe='" . $nomG . "'";
            $dbh->exec($sql);
        }
        elseif ($_SESSION['admin']==0){
            $sql ="UPDATE Groupe SET idChef='".$idC."' where NomGroupe='".$nomG."' and idChef='".$idCurrent."'";
            $dbh->exec($sql);
        }
        /*
        $sqlVerifie = $dbh->query("SELECT COUNT(*) from Appartenir where  NomGroupe='".$nomG."' and idClient='".$recupid['idClient']."'");
        $result = $sqlVerifie->fetch();
        */

        header('location:formulairelogin.php');
    }

}
else{header('location:formulairelogin.php');}


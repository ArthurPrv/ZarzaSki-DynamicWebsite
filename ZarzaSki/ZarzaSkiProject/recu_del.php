<?php // permet d'éxécuter le delete d'un utilisateur dans un groupe en vérifiant que la commande à été éxécuté par le gérant de ce dernier ou par un admin
session_start();
if(isset($_SESSION['login'])) {//verifie qu'il est login et admin
    include('connexion.php');
    $nomG=$_POST['nomg'];
    $mail=$_POST['mail'];

    $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$mail."'");
    $recupid = $sqlRecupId->fetch();

    $sqlRecupIdCurrent = $dbh->query("SELECT idClient from Client where mail='".$_SESSION['login']."'");
    $recupidCurrent  = $sqlRecupIdCurrent->fetch();
    $idCurrent=$recupidCurrent ['idClient'];

    $sqlVerifie = $dbh->query("SELECT COUNT(*) from Groupe,Appartenir where  Groupe.NomGroupe='".$nomG."' and idClient=".$recupid['idClient']." and IdChef!=".$recupid['idClient']." and Groupe.NomGroupe=Appartenir.NomGroupe");
    $result = $sqlVerifie->fetch();

    echo "1";

    if( ($result["COUNT(*)"]==0))header('location:formulairelogin.php');//déjà dans le groupe
    else {
        echo "2";

        $sqlVerifPerm = $dbh->query("SELECT COUNT(*) from Groupe where idChef=" . $idCurrent . " and NomGroupe='".$nomG."'");
        $verifPerm= $sqlVerifPerm->fetch();
        $perm= $verifPerm['COUNT(*)'];

        if($_SESSION['admin']==0&&$perm==1) { //supréssion dans un cas utilisateur
            $sql = "DELETE FROM Appartenir  WHERE NomGroupe='" . $nomG . "' and idClient=" . $recupid['idClient'] . " and '" . $nomG . "' in (SELECT NomGroupe from Groupe where idChef=" . $idCurrent . ")";
            $dbh->exec($sql);
            echo "3";

        }
        else if  ($_SESSION['admin']==1){ //suppréssion dans un cas admin
            $sql = "DELETE FROM Appartenir  WHERE NomGroupe='" . $nomG . "' and idClient=" . $recupid['idClient'] ;
            $dbh->exec($sql);
        }

        header('location:formulairelogin.php');

    }
}
else{header('location:formulairelogin.php');}


<?php // permet de disband un groupe
include('affichagebefore.php');
$nomG=$_GET['nomg'];
if(isset($_SESSION['login'])&&$_SESSION['admin']==1) {//verifie qu'il est login et admin
    include('connexion.php');
    $sqlVerifie = $dbh->query("SELECT COUNT(*) from Groupe where  NomGroupe='".$nomG."'");
    $result = $sqlVerifie->fetch();

    if( ($result["COUNT(*)"]==0))header('location:formulairelogin.php');//déjà dans le groupe
    else {
        $sql = "DELETE FROM Groupe  WHERE NomGroupe='".$nomG."'";
        $dbh->exec($sql);

        $sqlVerifie = $dbh->query("SELECT COUNT(*) from Groupe where  NomGroupe='".$nomG."'");
        $result = $sqlVerifie->fetch();


        if ($result["COUNT(*)"]==0)header('location:formulairelogin.php');
        else{header('location:dis.php');}

    }
}
elseif(isset($_SESSION['login'])&&$_SESSION['admin']==0){
    include('connexion.php');
    $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$_SESSION['login']."'");
    $recupid = $sqlRecupId->fetch();
    $idC=$recupid['idClient'];


    $sqlVerifie = $dbh->query("SELECT COUNT(*) from Groupe where  NomGroupe='".$nomG."' and idChef='".$idC."'");
    $result = $sqlVerifie->fetch();

    if( ($result["COUNT(*)"]==0))header('location:formulairelogin.php');//déjà dans le groupe
    else {
        $sql = "DELETE FROM Groupe  WHERE NomGroupe='".$nomG."' and idChef='".$idC."'";
        $dbh->exec($sql);

        $sqlVerifie = $dbh->query("SELECT COUNT(*) from Groupe where  NomGroupe='".$nomG."' and idChef='".$idC."'");
        $result = $sqlVerifie->fetch();


        if ($result["COUNT(*)"]==0)header('location:formulairelogin.php');
        else{header('location:dis.php');}

    }
}
else{header('location:formulairelogin.php');}
include('affichageafter.php');

<?php //permet de supprimer un comtpe
include('affichagebefore.php');
$nomp=$_GET['nomp'];
if(isset($_SESSION['login'])&&$_SESSION['admin']==1) {//verifie qu'il est login et admin
    include('connexion.php');
    $sqlVerifie = $dbh->query("SELECT COUNT(*) from Client where  mail='".$nomp."'");
    $result = $sqlVerifie->fetch();

    if( ($result["COUNT(*)"]==0))header('location:formulairelogin.php');//déjà dans le groupe
    else {
        $sql = "DELETE FROM Client  WHERE mail='".$nomp."'";
        $dbh->exec($sql);

        $sqlVerifie = $dbh->query("SELECT COUNT(*) from Client where  mail='".$nomp."'");
        $result = $sqlVerifie->fetch();

        if ($result["COUNT(*)"]==0)header('location:formulairelogin.php');
        else{header('location:dis.php');}

    }
}
else{header('location:formulairelogin.php');}
include('affichageafter.php');

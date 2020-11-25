<?php
include('connexion.php');
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$mail=$_POST['mail'];
$password=$_POST['password'];
$nee=$_POST['nee'];
$adresse =$_POST['adresse'];
$tel=$_POST['tel'];
$niveau=$_POST['niveau'];
$taille=$_POST['taille'];
$poids=$_POST['poids'];
$pointure=$_POST['pointure'];




if(!(isset($mail)&&isset($nom)&&isset($password)&&isset($prenom)&&isset($tel)&&isset($nee)&&isset($adresse)&&isset($niveau)&&isset($taille)&&isset($poids)&&isset($pointure)))
    header('location:RegisterAccount.php');
else{

    $sqlVerifieMail = $dbh->query("SELECT COUNT(*) from Client where  mail='".$mail."'");
    $result = $sqlVerifieMail->fetch();

    if( $result["COUNT(*)"]!=0)header('location:RegisterAccount.php?errormsg=Cette e-mail est déjà utilisé');
    else {
        $sql = "INSERT INTO `Client`(`NomClient`, `PrenomClient`, `DateNaissanceClient`, `AdresseClient`, `TelClient`, `mail`, `password`) VALUES ('".$nom."','".$prenom."','".$nee."','".$adresse."','".$tel."','".$mail."','".sha1($password)."')";
        $dbh->exec($sql);

        $req=$dbh->query("SELECT idClient FROM Client WHERE mail='".$mail."'");
        $res=$req->fetch();
        $id=$res["idClient"];
        echo $id;

        $sql2 = "INSERT INTO `Skieur`(`idClient`,`NiveauSkieur`, `TailleSkieur`, `PoidsSkieur`, `PointureSkieur`) VALUES ('".$id."','".$niveau."','".$taille."','".$poids."','".$pointure."')";
        $dbh->exec($sql2);

        $sqlVerifieMail = $dbh->query("SELECT COUNT(*) from Client where  mail='".$mail."'");
        $result = $sqlVerifieMail->fetch();

        if ($result["COUNT(*)"]==1)header('location:formulairelogin.php');
        else{header('location:RegisterAccount.php?errormsg=Une erreur est survenue lors de la création vérifié l\'entierté des paramètres');}

    }
}

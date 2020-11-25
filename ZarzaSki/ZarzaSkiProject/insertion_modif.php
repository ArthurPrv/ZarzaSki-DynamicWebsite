<?php
include('connexion.php');
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$mail=$_POST['mail'];
$password=$_POST['password'];
$nee=$_POST['nee'];
$adresse =$_POST['adresse'];
$tel=$_POST['tel'];
$ancienpassword=$_POST['ancienpassword'];
$id=$_POST['id'];
$niveau=$_POST['niveau'];
$taille=$_POST['taille'];
$poids=$_POST['poids'];
$pointure=$_POST['pointure'];
$pass=0;
$passmail=0;

$sqlMail = $dbh->query("SELECT mail from Client WHERE idClient<>$id");
while($ligne=$sqlMail->fetch()){
  if($mail==$ligne['mail']){
    $passmail=1;
  }
}
$sqlMail->closeCursor();

if($passmail==1){
  header('location:modifUser.php?errormsg=Cette adresse mail est déjà utilisé');
}
else{
  $sqlVerifieMail = $dbh->query("SELECT COUNT(*) from Client where  mail='".$_SESSION['login']."' and password='".sha1($ancienpassword)."'");
  $result = $sqlVerifieMail->fetch();

  $sqlCount = $dbh->query("SELECT idClient from Skieur");
  while($ligne=$sqlCount->fetch()){
    if($id==$ligne['idClient']){
      $pass=1;
      break;
    }
  }
  $sqlCount->closeCursor();

  if($result['COUNT(*)'==0]) header('location:modifUser.php?errormsg="Le mdp n\'est pas bon"');
  else{
      session_start();
      if(!(isset($mail)&&isset($nom)&&isset($password)&&isset($prenom)&&isset($tel)&&isset($nee)&&isset($adresse)&&isset($_SESSION['login']))) header('location:modifUser.php?errormsg=');
      else{

          $sql="UPDATE `Client` SET `NomClient`='".$nom."',`PrenomClient`='".$prenom."',`DateNaissanceClient`='".$nee."',`AdresseClient`='".$adresse."',`TelClient`='".$tel."',`mail`='".$mail."',`password`='".sha1($password)."' WHERE mail='".$_SESSION['login']."'";
          $dbh->exec($sql);

          if($pass==0){
            $sql2 = "INSERT INTO `Skieur`(`idClient`,`NiveauSkieur`, `TailleSkieur`, `PoidsSkieur`, `PointureSkieur`) VALUES ('".$id."','".$niveau."','".$taille."','".$poids."','".$pointure."')";
            $dbh->exec($sql2);
          }
          elseif ($pass==1) {
            $sql2="UPDATE `Skieur` SET `NiveauSkieur`='".$niveau."',`TailleSkieur`='".$taille."',`PoidsSkieur`='".$poids."',`PointureSkieur`='".$pointure."' WHERE `idClient`='".$id."'";
            $dbh->exec($sql2);
          }


          $_SESSION['login']=$mail;
          $sqlVerifieMail = $dbh->query("SELECT COUNT(*) from Client where  mail='".$_SESSION['login']."' and password='".sha1($password)."'");
          $result = $sqlVerifieMail->fetch();
          if ($result["COUNT(*)"]==1)header('location:formulairelogin.php');
          else{header('location:modifUser.php?errormsg=Une erreur est survenue lors de la création vérifié l\'entierté des paramètres');}

      }
  }
}

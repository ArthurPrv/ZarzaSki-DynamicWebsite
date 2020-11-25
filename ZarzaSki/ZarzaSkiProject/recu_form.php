<?php
session_start();
$nomp=$_GET['nomp'];



if(isset($_SESSION['login'])) {
  include('connexion.php');
  $nom=$_POST['nom'];
  $date=$_POST['date'];
  $pass=0;

  $sqlDate=$dbh->query("SELECT * FROM Date");
  while ($ligne = $sqlDate->fetch()) {
      if($date==$ligne['Date_Deb']){
        $pass=1;
      }
  }
  $sqlDate->closeCursor();

  if($pass==0){
    $sql="INSERT INTO `Date` (`Date_Deb`) VALUES ('".$date."')";
    $dbh->exec($sql);
  }

  $pass=0;

  $sqlId = $dbh->query("SELECT idClient FROM Client WHERE mail='".$_SESSION['login']."'");
  while ($ligne = $sqlId->fetch()) {
      $id=$ligne['idClient'];
  }
  $sqlId->closeCursor();

  $sqlChois=$dbh->query("SELECT * FROM Choisir");
  while ($ligne = $sqlChois->fetch()) {
      if($date==$ligne['Date_Deb']&&$id==$ligne['idClient']){
        $pass=1;
      }
  }
  $sqlChois->closeCursor();

  if($pass==0){
    $sql="INSERT INTO `Choisir` (`idClient`,`NomFormule`,`Date_Deb`) VALUES ($id,'".$nom."','".$date."')";
    $dbh->exec($sql);
  }
  else{
    $sql="UPDATE `Choisir` SET `idClient`=$id,`NomFormule`='".$nom."',`Date_Deb`='".$date."'";
    $dbh->exec($sql);
  }
  header('location:form.php?errormsg=');

}
else{header('location:formulairelogin.php');}

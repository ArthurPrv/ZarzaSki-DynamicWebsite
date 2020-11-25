<?php
session_start();
if(isset($_SESSION['login'])) {
  include('connexion.php');
  $nom=$_POST['nom'];
  $prix=$_POST['prix'];

  if($_SESSION['admin']==1){
    if($prix<0){
      header('location:tarif.php?errormsg=Le prix ne peux pas être négatif');
    }
    else{
      $sql="UPDATE `Formule` SET `PrixFormule`=$prix WHERE NomFormule='".$nom."'";
      $dbh->exec($sql);
      header('location:tarif.php?errormsg=');
    }
  }
  else{header('location:formulairelogin.php');}
}
else{header('location:formulairelogin.php');}

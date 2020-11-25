<?php //permet d'ajouter un membre a un groupe en vérifiant que ce soit bien le chef du groupe ou un admin qui éxécute la commande
session_start();
if(isset($_SESSION['login'])) {//verifie qu'il est login et admin
    include('connexion.php');
    $nomG=$_POST['nomg'];
    $mail=$_POST['mail'];
    $pass=0;

    $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$mail."'");
    while($ligne=$sqlRecupId->fetch()){
      $id=$ligne['idClient'];
      $pass=1;
    }
    if($pass==1){

      $sqlVerifie = $dbh->query("SELECT COUNT(*) from Appartenir where  NomGroupe='".$nomG."' and idClient=$id");
      $result = $sqlVerifie->fetch();

      $sqlRecupIdCurrent = $dbh->query("SELECT idClient from Client where mail='".$_SESSION['login']."'");
      $recupidCurrent = $sqlRecupIdCurrent->fetch();
      $idCurrent=$recupidCurrent['idClient'];


      if( $result["COUNT(*)"]!=0)header('location:formulairelogin.php');//déjà dans le groupe
      else {
          echo "2";
          $sqlVerifPerm = $dbh->query("SELECT COUNT(*) from Groupe where idChef='" . $idCurrent . "' and NomGroupe='".$nomG."'");
          $verifPerm= $sqlVerifPerm->fetch();
          $perm= $verifPerm['COUNT(*)'];

          if($_SESSION['admin']==0&&$perm==1) { // pas admin
              $sql = "INSERT INTO Appartenir(NomGroupe, idClient) VALUES ('" . $nomG . "',$id)";
              $dbh->exec($sql);
          }
          else if($_SESSION['admin']==1){ //admin
              $sql = "INSERT INTO Appartenir(NomGroupe, idClient) VALUES ('" . $nomG . "',$id)";
              $dbh->exec($sql);
          }

          header('location:formulairelogin.php');
      }
  }
  else{
    header('location:add.php?errormsg=Cette personne n\'existe pas&nomg='.$nomG);
  }
}
else{header('location:formulairelogin.php');}

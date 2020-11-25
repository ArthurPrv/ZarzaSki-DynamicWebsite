<?php
session_start();
if(isset($_SESSION['login'])) {
  include('connexion.php');
  $nomg=$_POST['nomg'];
  $mail1=$_POST['mail1'];
  $mail2=$_POST['mail2'];
  $pref=$_POST['pref'];
  $count=0;
  $pass=0;
  $chef=0;

  $sqlChef = 'SELECT idChef FROM Group WHERE NomGroupe="'.$mnomg.'"';
  $resultat=$dbh->query($sqlChef);
  while($ligne=$resultat->fetch()){
      $chef=1;
  }

  if($chef==0){
    header('location:pre.php?errormsg=Vous n\êtes pas le chef du groupe&nomg='.$nomg);
  }
  else{
    if ($mail1==$mail2) {
      header('location:pre.php?errormsg=Vous ne pouvez pas mettre la même adresse&nomg='.$nomg);
    }
    else{
      $req = 'SELECT * FROM Client WHERE mail="'.$mail1.'"';
      $resultat=$dbh->query($req);
      while($ligne=$resultat->fetch()){
          $count+=1;
      }

      $req = 'SELECT * FROM Client WHERE mail="'.$mail2.'"';
      $resultat=$dbh->query($req);
      while($ligne=$resultat->fetch()){
          $count+=1;
      }

      $resultat->closeCursor();

      if ($count>1){
        $sqlMail = $dbh->query("SELECT * from Client");
        while($ligne=$sqlMail->fetch()){
          if($mail1==$ligne['mail']){
            $id1=$ligne['idClient'];
          }
          if($mail2==$ligne['mail']){
            $id2=$ligne['idClient'];
          }
        }
        $sqlMail->closeCursor();

        $sqlPref = $dbh->query("SELECT idClient,idClient_Pref FROM Prefere WHERE idClient=$id1 AND idClient_Pref=$id2");
        while($ligne=$sqlPref->fetch()){
          $pass=1;
        }
        $sqlPref->closeCursor();

        $sqlPref = $dbh->query("SELECT idClient,idClient_Pref FROM Prefere WHERE idClient=$id2 AND idClient_Pref=$id1");
        while($ligne=$sqlPref->fetch()){
          $pass=2;
        }
        $sqlPref->closeCursor();

        if ($pass==1){
          $sql="UPDATE `Prefere` SET `idClient`=$id1,`idClient_Pref`=$id2,`nivPref`=$pref";
          $dbh->exec($sql);
        }
        else if($pass=2){
          $sql="UPDATE `Prefere` SET `idClient`=$id2,`idClient_Pref`=$id1,`nivPref`=$pref";
          $dbh->exec($sql);
        }
        else{
          $sql="INSERT INTO `Prefere` (`idClient`,`idClient_Pref`,`nivPref`) VALUES ($id1,$id2,$pref)";
          $dbh->exec($sql);
        }
        header('location:pre.php?errormsg=Preference bien changée&nomg='.$nomg);

      }
      else{
        header('location:pre.php?errormsg=Une ou plusieurs adresses ne sont pas valides&nomg='.$nomg);
      }
    }
  }
}
else{header('location:formulairelogin.php');}

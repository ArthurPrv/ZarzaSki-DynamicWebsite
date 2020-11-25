<?php //insérer un groupe dans la base de données
include('connexion.php');
$nameGrp=$_POST['nameGrp'];
$date=$_POST['date'];
session_start();
if(isset($_SESSION['login'])){
    if(!(isset($nameGrp)&&isset($date)))
        header('location:CreateGroup.php');
    else{
        //Si le groupe existe déja et que le chef == au chef actuelle changer la date





        $sqlVerifieNom = $dbh->query("SELECT COUNT(*) from Groupe where  NomGroupe='".$nameGrp."'");
        $result = $sqlVerifieNom->fetch();
        $verif=$result["COUNT(*)"];



        /* Si on veut deux groupes avec le mm nom a des dates différentes
        $sqlVerifieNom = $dbh->query("SELECT COUNT(*) from Groupe,Appartenir where Groupe.NomGroupe=Appartenir.NomGroupe and Groupe.NomGroupe='".$nameGrp."' and date_deb='".$date."'");
        $result = $sqlVerifieNom->fetch();
        $verif=$result["COUNT(*)"];
        */

        $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$_SESSION['login']."'");
        $recupid = $sqlRecupId->fetch();
        $idC=$recupid['idClient'];

        $sqlVerifieGrp = $dbh->query("SELECT COUNT(*) from Groupe where  NomGroupe='".$nameGrp."' and idChef=".$idC);
        $result2 = $sqlVerifieGrp->fetch();
        $verif2=$result2["COUNT(*)"];

        if( $verif2==0 && !isset($_SESSION['login']))header('location:CreateGroup.php?errormsg=Ce nom est déjà utilisé');
        elseif( $verif==1 && ($verif2==1 || isset($_SESSION['login']))  ){
            $sqlUpdate = "UPDATE Groupe SET `Date_Deb`='".$date."' where NomGroupe='".$nameGrp."'";
            $dbh->exec($sqlUpdate);
            header('location:formulairelogin.php');
        }
        else {




            $sql = "INSERT INTO Groupe(`NomGroupe`, `idChef`,`Date_Deb`) VALUES ('" . $nameGrp . "','" . $idC . "','".$date. "')";
            $dbh->exec($sql);


            $sqlVerifieNom = $dbh->query("SELECT COUNT(*) from Groupe where  NomGroupe='".$nameGrp."'");
            $result = $sqlVerifieNom->fetch();
            $verif=$result["COUNT(*)"];

            if($_SESSION['admin']==0){
                $sqlAppartenance =  $dbh->query("INSERT INTO `Appartenir`(`NomGroupe`, `idClient`) VALUES ('".$nameGrp."','".$idC."')");
                $dbh->exec($sqlAppartenance);

            }


            if ($verif==1)header('location:formulairelogin.php');
            else{header('location:CreateGroup.php?errormsg=Une erreur est survenue lors de la création vérifié l\'entierté des paramètres');}

        }
    }
}
else{header('location:formulairelogin.php');}
<?php include('connexion.php');
if(isset($_SESSION['login'])&&$_SESSION['admin']==0){
    $mail=$_SESSION['login'];
?>

    <H1>Que voulez vous faire à un groupe?</H1>

    <form action="actiontemp.php" method="post">
        Nom du groupe
        <select name="nomg">
            <?php
            $sqlRecupId = $dbh->query("SELECT idClient from Client where mail='".$mail."'");
            $recupid = $sqlRecupId->fetch();
            $idC=$recupid['idClient'];

            $results = $dbh->query("SELECT * from Groupe,Client where idChef='".$idC."' and mail='".$mail."'");

            while ($ligne = $results->fetch()) {
                echo('<option value=' . $ligne['NomGroupe'] . '>' . $ligne['NomGroupe'] . '</option>');
            }
            $results->closeCursor();
            ?>
        </select>

        Action
        <select name=action>
            <option value="add.php"> Ajouter un membre </option>
            <option value="del.php"> Supprimer un membre </option>
            <option value="get.php"> Changer le gerant </option>
            <option value="fac.php"> Afficher la facture </option>
            <option value="pre.php"> Changer les préférences </option>
            <option value="dis.php"> Supprimer un groupe </option>
            <option value="mbr2.php"> Savoir ses membres</option>
        </select>


        <tr>
            <td><input type="reset" value="Annuler"></td>
            <td><input type="submit" value="Envoyer" name="submit"></td>

        </tr>
    </form>

    <H1>Créer un groupe?</H1>
    <a href="CreateGroup.php?errormsg="><input type="button" name="register"value="Créer un groupe!"/></a>
    <H1>Vos infos:</H1>
    <?php
    include('knw2.php');
    include('infouser.php');
?>
    <H1>Modifier le compte?</H1>
<a href="modifUser.php?errormsg="><input type="button" name="register"value="Modifier le compte"/></a>

    <H1> Modifier votre formule?</H1>
    <a href="form.php?errormsg="><input type="button" name="register"value="Modifier la formule"/></a>
<?php } ?>

<?php include('connexion.php');
//ce fichier correspond a al page du pannel admin
if(isset($_SESSION['login'])&&$_SESSION['admin']==1){
    //vérifier que c'est bien un compte admin avec une requete sql :D?>

<H1>Que voulez vous faire à un groupe?</H1>

<form action="actiontemp.php" method="post">
    Identifiant de l'utilisateur
    <select name="nomUtilisateur">
        <?php
        //$results = $dbh->query("SELECT * from Groupe,Client where idChef=idClient and mail=$login "); pour le panel User

        $results = $dbh->query("SELECT Identifiant from UTILISATEUR ");

        while ($ligne = $results->fetch()) {
        echo('<option value=' . $ligne['Identifiant'] . '>' . $ligne['Identifiant'] . '</option>');
        }
        $results->closeCursor();
        //Menu déroulant avec les noms de groupes // recherche par nom
        //Autre menu déroulant pour choisir l'action
        //Ajouter/Supprimer des membres dans ce groupe
        //Changer le gerant du groupe
        //Afficher leur facture
        //Disband le groupe
        //changer les préférences d'afféctation du groupe
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
        <option value="form.php"> Changer les préférences </option>

    </select>
    <input value=" " type="hidden" name="errormsg">

    <tr>
        <td><input type="reset" value="Annuler"></td>
        <td><input type="submit" value="Envoyer" name="submit"></td>

    </tr>
</form>
    <H1>Créer un groupe?</H1>
    <a href="CreateGroup.php?errormsg="><input type="button" name="register"value="Créer un groupe!"/></a>
    <H1>Que voulez vous faire à une personne?</H1>
    <form  action="actiontemp.php" method="post">
        Mail de la personne
        <select name="nomp">
            <?php
            $results = $dbh->query("SELECT * from Client ");
            while ($ligne = $results->fetch()) {
                echo('<option value=' . $ligne['mail'] . '>' . $ligne['Nom']." ".$ligne['Prenom']. $ligne['mail'] . '</option>');
            }
            $results->closeCursor();
            ?>
        </select>
        Action
        <select name="action">
            <option value="knw.php"> Savoir ses infos </option>
            <option value="de2.php"> Supprimer le compte </option>
        </select>
        <tr>
            <td><input type="reset" value="Annuler"></td>
            <td><input type="submit" value="Envoyer"></td>
        </tr>
    </form>

    <H1>Modifier le compte?</H1>
<a href="modifUser.php?errormsg="><input type="button" name="register"value="Modifier le compte"/></a>


    <?php
}

else header('location:formulairelogin.php');
?>

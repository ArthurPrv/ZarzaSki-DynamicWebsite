<?php //modifie les paramètre d'un utilisateur si il rerentre bien son mdp
include('affichagebefore.php');
include ('connexion.php');
if(isset($_SESSION['login'])) {
    $sqlRecupIdCurrent = $dbh->query("SELECT * from Client where mail='" . $_SESSION['login'] . "'");
    $recupInfoCurrent = $sqlRecupIdCurrent->fetch();
    $id=$recupInfoCurrent['idClient'];
    $nom = $recupInfoCurrent['NomClient'];
    $prenom = $recupInfoCurrent['PrenomClient'];
    $naissance = $recupInfoCurrent['DateNaissanceClient'];
    $adresse = $recupInfoCurrent['AdresseClient'];
    $tel = $recupInfoCurrent['TelClient'];
    $mail = $recupInfoCurrent['mail'];
    $errormsg= $_GET['errormsg'];

    $sqlRecupSkieur = $dbh->query("SELECT * from Skieur where idClient=$id");
    $recupInfoSkieur = $sqlRecupSkieur->fetch();
    $niv=$recupInfoSkieur['NiveauSkieur'];
    $taille=$recupInfoSkieur['TailleSkieur'];
    $poids=$recupInfoSkieur['PoidsSkieur'];
    $pointure=$recupInfoSkieur['PointureSkieur'];
    ?>


    <h1>Formulaire de modification de vôtre compte</h1>
    <?php echo  $errormsg;?>
    <form action="insertion_modif.php" method="post">
        Nom:<input type="text" name="nom" value="<?php echo $nom;?>" required><br>
        Prenom:<input type="text" name="prenom" value="<?php echo $prenom ;?>" required><br>
        Naissance:<input type="date" name="nee" value="<?php echo $naissance;?>" required><br>
        Adresse:<input type="text" name="adresse" value="<?php echo $adresse;?>" required><br>
        Tel:<input type="text" name="tel" value="<?php echo $tel;?>" required><br>
        email:<input type="text" name="mail" value="<?php echo $mail;?>" required><br>
        Mot de passe:<input type="password" name="ancienpassword" required><br>
        Nvx Mot de passe:<input type="password"  name="password" required><br>
        <hr>
        Données pour le ski<br>
        Niveau:<select name="niveau"><option value="Debutant">Débutant</option><option value="Moyen">Moyen</option><option value="Confirme">Confirmé</option></select><br>
        Taille(en cm):<input type="number" name="taille" value="<?php echo $taille;?>" required><br>
        Poids(en kg):<input type="number" name="poids" value="<?php echo $poids;?>" required><br>
        Pointure:<input type="number" name="pointure" value="<?php echo $pointure;?>" required><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>"></input>

        <input type="reset" value="Effacer">
        <input type="submit" name="submit" value="Insérer">
    </form>
    <?php
}
include ('affichageafter.php');

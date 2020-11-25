<!DOCTYPE html>
<html lang="fr">
<head class="header">
    <title>ZarzaSki | Register</title>
    <meta charset="UTF-8">
    <link href="Style.css" rel="stylesheet">
    <?PHP include('topbar.php');
    if(isset($_SESSION['login']))header('location:formulairelogin.php');?>

</head>
<body>
<div class="AproposMiddle">
    <?php // ce formulaire permet de crée un compte en évitant la multiplicité des utilsiateurs par leurs mails
    $errormsg=$_GET['errormsg'];
    echo $errormsg;
    ?>
    <h1>Formulaire d'Inscription a ZARZASKI</h1>

    <form action="insertion_account.php" method="post">
        Nom:<input type="text" name="nom" required><br>
        Prenom:<input type="text" name="prenom" required><br>
        Naissance:<input type="date" name="nee" value="AAAA-MM-jj" required><br>
        Adresse:<input type="text" name="adresse" required><br>
        Tel:<input type="text" name="tel" required><br>
        E-mail:<input type="text" name="mail" required><br>
        Mot de passe:<input type="password" name="password" required><br>
        <hr>
        Données pour le ski<br>
        Niveau:<select name="niveau"><option value="Debutant">Débutant</option><option value="Moyen">Moyen</option><option value="Confirme">Confirmé</option></select><br>
        Taille(en cm):<input type="number" name="taille" required><br>
        Poids(en kg):<input type="number" name="poids" required><br>
        Pointure:<input type="number" name="pointure" required><br>
        <input type="reset" value="Effacer">
        <input type="submit" name="submit" value="Insérer">
    </form>


</div>
</body>
<?PHP include('footer.html') ?>
</html>

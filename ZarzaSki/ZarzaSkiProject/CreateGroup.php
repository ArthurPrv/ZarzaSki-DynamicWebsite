<?php // page permetant de créer un groupe
include ('affichagebefore.php');
if(isset($_SESSION['login'])){ //vérification du login et action qui en découlent
    include ('connexion.php');
    $sqlRecupId = $dbh->query("SELECT NomClient from Client where mail='".$_SESSION['login']."'");
    $recupid = $sqlRecupId->fetch();
    $nomC=$recupid['NomClient'];
    $errormsg=$_GET['errormsg'];

?>
    <form action="insertionGroup.php" method="post">

        <?php
        echo $errormsg;
        echo "</br>";
        echo"NomDuGroup:<input type='text' name='nameGrp' value='".$nomC."' required><br>"?>
            DateDebutDuSejour:<input type='date' name='date' value='AAAA-MM-JJ' required><br>
        <input type="reset" value="Effacer">
        <input type="submit" name="submit" value="Insérer">
    </form>
<?php }
 include ('affichageafter.php');
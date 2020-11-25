<?php
include('affichagebefore.php');
$nomg=$_GET['nomg'];
if(isset($_SESSION['login'])){
    include('connexion.php');
    include('mbr.php');
    $errormsg=$_GET['errormsg'];?>
    <h1>Entrez les emails et la préférences de vos membres</h1>
    <?php echo  $errormsg;?>
    <form action="recu_pref.php" method="POST">
        <table>
            <tr>
                <td>e-mail du Client 1</td>
                <td><input type="text" name="mail1" required></td>
                <?php echo "<td><input value='".$nomg."' type='hidden' name='nomg' required></td>"; ?>
            </tr>
            <tr>
                <td>e-mail du Client 2</td>
                <td><input type="text" name="mail2" required></td>
            </tr>
            <tr>
                <td>Préférence</td>
                <td><select name="pref"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
            </tr>
            <tr>
                <td><input type="reset" value="Annuler"></td>
                <td><input type="submit" value="Envoyer"></td>

            </tr>
        </table>
    </form>
    <?php

}
else{header('location:formulairelogin.php');}
include('affichageafter.php');

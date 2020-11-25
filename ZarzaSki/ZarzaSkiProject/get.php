<?php //permet de changer le gérant du groupe en vérifiant les permissions
include('affichagebefore.php');
$nomg=$_GET['nomg'];
if(isset($_SESSION['login'])){//verifie qu'il est login
    include('connexion.php');
    include ('mbr.php');?>
    <h1>Qui voulez vous mettre chef du groupe?</h1>
    <form action="recu_get.php" method="POST">
        <table>
            <tr>
                <td>e-mail</td>
                <td><input type="text" name="mail" required></td>
                <?php echo "<td><input value='".$nomg."' type='hidden' name='nomg' required></td>"; ?>
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

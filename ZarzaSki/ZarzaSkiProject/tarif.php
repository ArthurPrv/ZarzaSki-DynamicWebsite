<?php
include('affichagebefore.php');
if(isset($_SESSION['login'])){
    include('connexion.php');

    $results = $dbh->query("SELECT * FROM Formule");
    echo("<table class='Horaires' >");
    echo("<tr>");
    echo('<td>NomFormule</td>');
    echo('<td>PrixFormule</td>');
    echo("</tr>");
    while ($ligne = $results->fetch()) {
        echo("<tr>");
        echo('<td>'.$ligne['NomFormule'].'</td>');
        echo('<td>'.$ligne['PrixFormule'].'</td>');
        echo("</tr>");
    }
    $results->closeCursor();

    echo("</table>");

    $errormsg=$_GET['errormsg'];?>
    <h1>Vous pouvez modifier les prix</h1>
    <?php echo  $errormsg;?>
    <form action="recu_tarif.php" method="POST">
      <select name="nom">
          <?php

          $results = $dbh->query("SELECT * from Formule ");
          while ($ligne = $results->fetch()) {
          echo('<option value='.$ligne['NomFormule']. '>' .$ligne['NomFormule'].'</option>');
          }
          $results->closeCursor();

          ?>
      </select>
      <input type="number" name="prix" required>
      <br><td><input type="reset" value="Annuler"></td>
      <td><input type="submit" value="Envoyer"></td>
    </form>
    <?php

}
else{header('location:formulairelogin.php');}
include('affichageafter.php');

<?php
include('affichagebefore.php');

if(isset($_SESSION['login'])){
    include('connexion.php');

    $results = $dbh->query("SELECT NomFormule,Date_Deb FROM Choisir NATURAL JOIN Client WHERE mail='".$_SESSION['login']."'");
    echo("<table class='Horaires' >");
    echo("<tr>");
    echo('<td>NomFormule</td>');
    echo('<td>Date_Deb</td>');
    echo("</tr>");
    while ($ligne = $results->fetch()) {
        echo("<tr>");
        echo('<td>'.$ligne['NomFormule'].'</td>');
        echo('<td>'.$ligne['Date_Deb'].'</td>');
        echo("</tr>");
    }
    $results->closeCursor();

    echo("</table>");

    $errormsg=$_GET['errormsg'];?>
    <h1>Entrez votre formule et la date de début</h1>
    <?php echo  $errormsg;?>
    <form action="recu_form.php" method="POST">
      <select name="nom">
          <?php

          $results = $dbh->query("SELECT * from Formule ");
          while ($ligne = $results->fetch()) {
          echo('<option value='.$ligne['NomFormule']. '>' .$ligne['NomFormule'].'</option>');
          }
          $results->closeCursor();

          ?>
      </select>
      <input type="date" name="date" value='AAAA-MM-JJ' required>
      <br><td><input type="reset" value="Annuler"></td>
      <td><input type="submit" value="Envoyer"></td>
    </form>
    <?php

}
else{header('location:formulairelogin.php');}
include('affichageafter.php');

<?php
include('connexion.php');
 $results = $dbh->query("SELECT * from t_service");
    
 while($ligne = $results ->fetch()){
    echo('<option value='.$ligne['code_service'].'>'.$ligne['lib_service'].'</option>');
}
 $results->closeCursor();

 
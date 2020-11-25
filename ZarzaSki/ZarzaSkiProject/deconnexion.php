<?php //permet de se déconnécter
session_start();
session_destroy();
header("location:formulairelogin.php");
?> 
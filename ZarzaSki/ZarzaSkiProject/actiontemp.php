<?php
//Ce fichier permet a la redirection sur les autre options des utilisateur en prenant des paramètres
session_start();
if(isset($_SESSION['login']) &&( isset($_POST['nomp'])|| isset($_POST['nomg']) )) {
        $nomp=$_POST['nomp'];
        $nomg=$_POST['nomg'];
        $action = $_POST['action'];
        if(isset($nomg))header('location:' . $action.'?errormsg=&nomg='.$nomg);
        elseif(isset($nomp))header('location:' . $action.'?errormsg=&nomp='.$nomp);
}
else{header('location:formulairelogin.php');}

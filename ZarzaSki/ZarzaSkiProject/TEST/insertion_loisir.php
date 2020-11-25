<?php
include('connexion.php');
$code_loisir=$_GET['code_loisir'];
$lib_loisir=$_GET['lib_loisir'];
$sbefore = $dbh->query("SELECT COUNT(*) FROM t_loisir");
$before = $sbefore->fetch();


$sql = "INSERT INTO t_loisir (code_loisir, lib_loisir) VALUES ('$code_loisir','$lib_loisir')";
$dbh->exec($sql);

$sa = $dbh->query("SELECT COUNT(*) FROM t_loisir");
$after = $sa->fetch();

if($after>$before)echo("Commande effectué");
else{echo(" La requete n'as pas été accépté");}

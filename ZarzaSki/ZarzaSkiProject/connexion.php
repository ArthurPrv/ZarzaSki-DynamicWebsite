<?PHP //ici les informations servent à se connecter à la bdd

include('parametre.php');
try{
    $con='mysql:host='.$host.';dbname='.$db;
    $dbh = new PDO($con,$user,$pwd,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e){
    die('Connexion impossible à la base de données !'.$e->getMessage());

}
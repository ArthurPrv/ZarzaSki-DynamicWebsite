<?PHP // permet d'éffectuer le login d'un utilisateur en vérifiant ses paramètres
    if (isset($_POST['login']) && isset($_POST['mdp'])){
        // Recherche dans la base de données
            include('connexion.php'); 
            $req = 'SELECT * FROM Client WHERE mail="'.$_POST['login'].'" AND password=SHA1("'.$_POST['mdp'].'");';
            $resultat=$dbh->query($req);
            $count=0;
            while($ligne=$resultat->fetch()){
                $count+=1;
                $admin=$ligne['EstAdmin'];
            }
            if ($count>0){

                session_start();
                $_SESSION['login']=$_POST['login'];
                $_SESSION['admin']=$admin;
                if(isset($_SESSION['count'])){
                    $_SESSION['count']+=1;
                }
                else $_SESSION['count']=1;
    
                header('location:formulairelogin.php');}

            else{header('location:formulairelogin.php');}
        
    }

else{ header('location:formulairelogin.php');}
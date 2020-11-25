<?php // formulaire pour se login en tant que membre admin ou utilisateur
include ('affichagebefore.php');
        if(!isset($_SESSION['login'])){ ?>
       <h1>Formulaire de saisie de login et de mot de passe</h1>

       <form action="recu_login.php" method="POST">
           <table>
               <tr>
                   <td>e-mail</td>
                   <td><input type="text" name="login" required></td>
               </tr>
               <tr>
                   <td>Mot de passe</td>
                   <td><input type="password" name="mdp" required></td>
               </tr>
               <tr>
                   <td><input type="reset" value="Annuler"></td>
                   <td><input type="submit" value="Envoyer"></td>

               </tr>
           </table>
       </form>
            <a href="RegisterAccount.php?errormsg= "><input type="button" name="register"value="Créer un compte!"/></a>
       <?php }
       else{//Si t'es co
        if(isset($_SESSION['login'])&&$_SESSION['admin']==1) {//Co admin
            include('AdministratorPanel.php');
        }
        elseif(isset($_SESSION['login'])&&$_SESSION['admin']==0){//Co pas admin
            include('UserPanel.php');
        }

       }
       include ('affichageafter.php');?>
 
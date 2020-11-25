<div class="topbar">
    <nav class="navi" >
        <ul>
            <img src='Images/LOGO2.png' class="logo" alt="Logo du site ">
            <li><a href="Index.php" class="acc" >ACCUEIL</a></li>
            <li><a href="formulairelogin.php" class="apr">MON COMPTE</a></li>
            <li><a href="Tarifs.php" class="trf">NOS TARIFS</a></li>
            <li><a href="Itineraire.php">ITINERAIRE</a></li>
            <a href="https://www.facebook.com/search/top/?q=Zarza%20ski" target="_blank" ><img src='Images/fb.png' alt="Logo Facebook " ></a>
            <?php //permet d'afficher une bar de navigation dynamique avec l'affichage d'un bouton logout
            session_start();
            if(isset($_SESSION['login']))echo "<a href=\"deconnexion.php\" ><img src='Images/logout.png'  alt=\"Logo Google Map \" > </a>"; ?>
        </ul>
    </nav>
</div>
<?php 
    //in assenza di una sessione vado alla pagina di login
    require_once 'auth.php';
    if (!$id_us = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>



<html>
    <?php
        //altrimenti carico info utente loggato
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $id_us = mysqli_real_escape_string($conn, $id_us);
        //preparo query
        $query = "SELECT * FROM users WHERE id = $id_us";
        //eseguo query 
        $res = mysqli_query($conn, $query);
        //salvo la riga del risultato
        $logged_in = mysqli_fetch_assoc(($res)); 
    ?>

    <head>
        <title>Trainwithme</title>
        <link rel="stylesheet" href="home.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="chisiamo.js" defer></script>
    </head>

    <body>

    <nav id="nav">
        <div id="trainwithme"><img src="b2e69c45e7084c56a2ed811f64f9b422.png"></div>

        <div id="links">
            <a href="home.php">Home</a>
            <a href="contact.php">Contact</a>
            <a href='profile.php'>PROFILO</a>
            <a href='logout.php' id='logout'>LOG OUT</a>
        </div>

        <div class="navbar">
        <div class="iconbar"></div>
        <div class="iconbar"></div>
        <div class="iconbar"></div>
        <div class="iconbar"></div>
        </div>

    </nav>


        <nav id="menu" class="wide">
        <ul>
            <li><a href="home.php">Home</a><li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href='profile.php'>Profilo</a></li>
            <li><a href='logout.php' id='logout'>Log out</a></li>
        </ul>
        </nav>

    <header>
        <div class="overlay"></div>
        <p>Chi siamo?</p>
        <p>Aiutarti a raggiungere uno stile di vita attivo è il nostro obiettivo.<br>
           TrainWithMe nasce dalla nostra grande passione e dalla irrefrenabile voglia di condividerla con te.<br>
           La gioia che proviamo ogni volta che ci mostrate i vostri successi è il motore che ci permette ogni giorno di dare il massimo!</p>
    </header>

    <footer>
    <nav id="footer">
    <div class="column">
            <img src="b2e69c45e7084c56a2ed811f64f9b422.png">
        </div>

        <div class="column">
            <p class="title">Per te<p>
            <p><a href="logout.php">Accedi</a></p>
            <p><a href="newaccount.php">Iscriviti</a></p>
        </div>
            
        <div class="column">
            <p class="title">Noi<p>
            <p><a href="chisiamo.php">About</a></p>
            <p><a href="consigli.php">Consigli</a></p>
        </div>
            
        <div class="column">
            <p class="title">Contattaci<p>
            <p>trainwithme@live.it</p>
            <p>3271276182</p>
        </div>
    </nav>
    </footer>
    
    
    
    </body>


</html>
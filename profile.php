<?php 
    require_once 'auth.php';
    if (!$id_us = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>

    <?php
        //carico info utente loggato
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
        <title>Trainwithme - <?php echo $logged_in['username'] ?></title>
        <link rel="stylesheet" href="profile.css"/>
        <script src="profile.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
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

    <div id="icon">
        <img src="athletic-man-torso-icon-digital-blue-vector-25339057.png">
    </div>

        <div id="info">
            <h1>username: <?php echo $logged_in['username']?></h1>
            <h2>e-mail: <?php echo $logged_in['email']?></h2>
        </div>

    </header>


    <section id="container">
    
    <?php
        $query2 = "SELECT * FROM workouts WHERE user_id = $id_us";
        $res2 = mysqli_query($conn, $query2);
        while($row=mysqli_fetch_assoc($res2)){
            $ID = $row["id"];
            echo "<div id='$ID' class='result'>"
            .$row["exercises"]."<button class='workout'>Done</button></div>"; 
        }
        
    ?>
                
    </section>


    </body>


</html>


<?php mysqli_close($conn); ?>

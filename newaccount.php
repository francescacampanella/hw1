<?php
    include 'dbconfig.php';

    //Distruggo la sessione esistente
    session_start();
    session_destroy();

    header('Location: reg.php');
?>
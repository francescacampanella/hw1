<?php

    require_once 'auth.php';
    if (!$id_us = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $exercises = $_GET["q"];

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $query = "INSERT INTO workouts(user_id, exercises) VALUES('$id_us', '$exercises')";

    if(mysqli_query($conn, $query)) 
    {
        mysqli_close($conn);
        exit;
    } 
?>
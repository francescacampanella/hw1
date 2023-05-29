<?php

    require_once 'auth.php';
    if (!checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $workout_id = $_GET["q"];

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $query = "DELETE FROM workouts WHERE id=$workout_id";

    if(mysqli_query($conn, $query)) 
    {
        mysqli_close($conn);
        exit;
    } 
?>
<?php

// Includes and runs the database connection code
include("db.php");


// Store session information.
// Reference "Easy Tutorials (YouTube)" : https://www.youtube.com/watch?v=NXAHkqiIepc&ab_channel=EasyTutorials
session_start();


// If no username set, redirect to login page OR SET TO CONTINUE AS GUEST
//I.E. Set Username to Guest, remove logout button
if (!isset($_SESSION['username'])) {

    $_SESSION['username'] = "Guest";
    $session_user_name = "Guest";
    // $log_in_out_btn_text = "Log in";

} else {
    //Retrieve Stored User Session Variables
    $session_user_name = $_SESSION['username'];
    // $log_in_out_btn_text = "Log out";
}


// $getsearch = $_POST["search"];

//Get movie ID from URI
$id = $_GET["movieid"];

$ratingselection = $_POST["ratingselection"];


//Build SQL query to enter all exploded actors from a movie individually into the actors table
$ratingtableinsertsql = "INSERT INTO movie_rating (movie_rating_id, movie_id, rating, username) VALUES (null, '$id', '$ratingselection', '$session_user_name'); ";

// echo $ratingtableinsertsql;


// Run SQL Query on connected database
$statement = $conn->query($ratingtableinsertsql);


header("Location:movieinfo.php?movieid=$id");

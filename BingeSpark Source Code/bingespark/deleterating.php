<?php

// Includes and runs the database connection code
include("db.php");


//Do header to return to movieinfo page



// Store session information.
// Reference "Easy Tutorials (YouTube)" : https://www.youtube.com/watch?v=NXAHkqiIepc&ab_channel=EasyTutorials
session_start();




$session_user_name = $_SESSION['username'];


$id = $_GET["movieid"];
// echo $session_user_name;

//Build SQL query to enter all exploded actors from a movie individually into the actors table
$ratingtabledeletesql = "DELETE FROM movie_rating WHERE movie_id = $id AND username = '$session_user_name'; ";


// Run SQL Query on connected database
$statement = $conn->query($ratingtabledeletesql);

header("Location:movieinfo.php?movieid=$id");

// Output SQL error to webpage if errors occur
// if (!$statement) {
//     echo "<div> SQL error -" . $conn->error, "</div>";
// }

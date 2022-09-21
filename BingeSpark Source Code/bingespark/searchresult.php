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

if ($session_user_name == "Guest") {
    $log_in_out_btn_text = "Log in";
} else {
    $log_in_out_btn_text = "Log out";
}


$getsearch = $_POST["search"];

$searchselection = $_POST["searchselection"];



if ($searchselection == "Actor") {

    $sqlread = "SELECT *
FROM movie_actor
INNER JOIN
movie
INNER JOIN
actor
WHERE
movie_actor.actor_id = actor.actor_id
AND movie_actor.movie_id = movie.movie_id
AND actor_name LIKE '%$getsearch%';";
} else if ($searchselection == "Genre") {

    $sqlread =

        "SELECT *
FROM movie_genre
INNER JOIN
movie
INNER JOIN
genre
WHERE
movie_genre.genre_id = genre.genre_id
AND movie_genre.movie_id = movie.movie_id
AND genre_name LIKE '%$getsearch%';";
} else if ($searchselection == "Director") {

    $sqlread =

        "SELECT *
FROM movie_director
INNER JOIN
movie
INNER JOIN
director
WHERE
movie_director.director_id = director.director_id
AND movie_director.movie_id = movie.movie_id
AND director_name LIKE '%$getsearch%';";
} else if ($searchselection == "Title") {

    $sqlread =

        "SELECT *
FROM movie
WHERE movie.title LIKE '%$getsearch%';";
}



// Result variable = query of the (mysqli) connected database using SQL query stored
$result = $conn->query($sqlread);



?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Linking Bootstrap CSS stylesheet for HTML Page Style-->
    <link rel="stylesheet" href=https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css>

    <!-- Title of document/webpage, for history/browser etc. Not heading -->
    <title>BingeSpark</title>
</head>





<!-- Main body with Background Colour -->

<body style="background-color:#292826;">

    <!-- Navigation and Navbar (particular for Bootstrap CSS) -->
    <nav class="navbar navbar-light bg-warning">

        <!-- <a> tag is a hyperlink, href is hyperlink URL or fragment of which it points to -->
        <!-- href="#" links to top of page -->
        <a class="navbar-brand" href="#">


            <!-- Image source and style -->
            <img src="/bingespark/images/BingeSparkLogo.png" width="160" height="80" class="d-inline-block align-top">

            <!-- This is the main heading at the top on the navbar beside the (logo) image -->
            <!-- BingeSpark -->


        </a>

        <!-- Displaying logged in account with Log out button -->
        <p>
            Welcome <?php echo $session_user_name ?>
            <a href='logout.php' class='btn btn-info'><?php echo $log_in_out_btn_text ?></a> <span> </span>
        </p>

        <p>
            <a href='homepage.php' class='btn btn-light'>Back to Home</a> <span> </span>
        </p>

    </nav>




    <div class="container">

        <!-- <p>
        <h1 style="color:red; font-size:300%;"> Welcome to BingeSpark </h1>
        </p> -->

        <p>
        <h2 style="color:red; font-size:200%;"> Search Results for <?php echo $searchselection ?> : <?php echo $getsearch ?> </h1>
            </p>

    </div>



    <!-- Bootstrap Containers are used to pad the content inside of them, and there are two container classes available: -->
    <div class="container">



        <div class='row row-cols-1 row-cols-md-4'>
            <!-- <div class='col mb-4'> -->


            <?php
            // PHP to run while loop and echo, HTML/CSS to create cards

            // Array to store movie data row fetch_assoc, which wll be pushed below
            $moviearray = array();

            // While loop to cycle through rows of SQL data results

            while ($row = $result->fetch_assoc()) {

                // Push each movie data row fetch_assoc into array for $_GET and page changes
                //From editlist.php, wk08b 
                array_push($moviearray, $row);

                $id = $row['movie_id'];

                $actorsremovequotes = str_replace("'", '', $row['movie_actors']);
                $genresremovequotes = str_replace("'", '', $row['genre']);


                // Read movie_rating table for ratings
                $sqlreadratings =  "SELECT *
                FROM movie_rating
                WHERE movie_id=$id ;";

                $ratingres = $conn->query($sqlreadratings);


                // $ratinglist = array();
                $ratingvalues = array();
                // $ratinguserlist = array();

                while ($ratingrow = $ratingres->fetch_assoc()) {

                    $rating = $ratingrow['rating'];

                    array_push($ratingvalues, $rating);
                }

                //Average source: https://stackoverflow.com/questions/33461430/how-to-find-average-from-array-in-php
                //Rounding to 1 decimal place
                $ratingvalues = array_filter($ratingvalues);
                $average = round(array_sum($ratingvalues) / count($ratingvalues), 1);




                echo "
            <div class='col mb-4'>
            <div class='card float-left text-warning bg-dark mb-3 mr-2 mb-2' style='width: 16rem;'>
            <img src='{$row['poster_uri']}' class='card-img-top' alt='...'>
               <div class='card-body'>
                 <h6>{$row['release_year']}</h6>

                 <h5 class='card-title text-danger' style='min-height:30px;'>{$row['title']}</h5>
                 <p class='card-title' style='min-height:20px;'> {$genresremovequotes} </p>
                 <p class='card-title' style='min-height:20px;'> Average rating: {$average} star</p>

                 <p>
                 <a href='movieinfo.php?movieid=$id' class='btn btn-info'>Rate</a> <span> </span>
                 </p>

                 <p class= 'card-subtitle text-muted text-truncate' style='width: 10rem;'>{$actorsremovequotes}</p>
        
                 
                 </div>
                 </div>
           </div>";
            }
            ?>

        </div>
    </div>
    </div>

</body>

</html>
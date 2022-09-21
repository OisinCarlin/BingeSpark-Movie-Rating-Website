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

//Read movies from database
$sort = $_GET["sort"];

if($sort == 'desc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `movie`.`average_rating` DESC";
} else if($sort == 'asc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `movie`.`average_rating` ASC";
} else if($sort == 'alphadesc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `movie`.`title` DESC";
} else if($sort == 'alphaasc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `movie`.`title` ASC";
} else if($sort == 'runtimedesc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `movie`.`runtime_minutes` DESC";
} else if($sort == 'runtimeasc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `movie`.`runtime_minutes` ASC";
} else if($sort == 'yeardesc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `release_year` DESC";
} else if($sort == 'yearasc'){
    $sqlread = "SELECT * FROM `movie` ORDER BY `release_year` ASC";
} 

// Members top/least rated
 else if($sort == 'myfavdesc'){
    $sqlread = "SELECT * FROM movie
    INNER JOIN movie_rating
    WHERE movie_rating.movie_id = movie.movie_id
    AND movie_rating.username = '$session_user_name'
    ORDER BY movie_rating.rating DESC;";
} 
 else if($sort == 'myfavasc'){
    $sqlread = "SELECT * FROM movie
    INNER JOIN movie_rating
    WHERE movie_rating.movie_id = movie.movie_id
    AND movie_rating.username = '$session_user_name'
    ORDER BY movie_rating.rating ASC;";
} 






else{
    $sqlread = "SELECT * FROM `movie` ORDER BY `movie`.`title` ASC";
}



// Result variable = query of the (mysqli) connected database using SQL query stored
$result = $conn->query($sqlread);

// If no result, echo (mysqli) error
if (!$result) {
    echo $conn->error;
}




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



        <form method="POST" action="searchresult.php">
            <!-- <p> -->
            Search for Movies by Title, Genre, Actor or Director:

            <div class="form-group">
                <select id="search-select" name='searchselection'>
                    <option name='Title' value='Title'>Title</option>
                    <option name='Genre' value='Genre'>Genre</option>
                    <option name='Actor' value='Actor'>Actor</option>
                    <option name='Director' value='Director'>Director</option>

                </select>
            </div>

            <!-- </p> -->
            <div class="form-group">
                <input name='search' value=''>
            </div>

            <!-- <p> -->
            <input type="submit" value='Search'>
            <!-- </p> -->
        </form>
    </nav>



    <div class="container">

        <!-- <p>
        <h1 style="color:red; font-size:300%;"> Welcome to BingeSpark </h1>
        </p> -->

        <p>
        <h2 style="color:red; font-size:200%;"> Browse and rate your favourite movies here </h1>
        <p style="color:gold">
            Sort movies
            <a href='homepage.php?sort=desc' class='btn btn-secondary btn-sm btn-outline-light'>Rating descending</a> <span> </span>
            <a href='homepage.php?sort=asc' class='btn btn-secondary btn-sm btn-outline-light'>Rating ascending</a> <span> </span>
            <a href='homepage.php?sort=alphadesc' class='btn btn-secondary btn-sm btn-outline-light'>Alphabetical descending</a> <span> </span>
            <a href='homepage.php?sort=alphaasc' class='btn btn-secondary btn-sm btn-outline-light'>Alphabetical ascending</a> <span> </span>
            <a href='homepage.php?sort=runtimedesc' class='btn btn-secondary btn-sm btn-outline-light'>Runtime descending</a> <span> </span>
            <a href='homepage.php?sort=runtimeasc' class='btn btn-secondary btn-sm btn-outline-light'>Runtime ascending</a> <span> </span>
            <a href='homepage.php?sort=yeardesc' class='btn btn-secondary btn-sm btn-outline-light'>Release year descending</a> <span> </span>
            <a href='homepage.php?sort=yearasc' class='btn btn-secondary btn-sm btn-outline-light'>Release year ascending</a> <span> </span>
            
            <!-- <a href='homepage.php?sort=myfavdesc' class='btn btn-success btn-sm btn-outline-light'>My top rated</a> <span> </span>
                <a href='homepage.php?sort=myfavasc' class='btn btn-danger btn-sm btn-outline-light'>My least rated</a> <span> </span> -->



            <?php
            if($session_user_name != "Guest"){
                echo "<a href='homepage.php?sort=myfavdesc' class='btn btn-success btn-sm btn-outline-light'>My top rated</a> <span> </span>
                <a href='homepage.php?sort=myfavasc' class='btn btn-danger btn-sm btn-outline-light'>My least rated</a> <span> </span>";
            }

            ?>
        </p>
            </p>

    </div>



    <!-- Bootstrap Containers are used to pad the content inside of them, and there are two container classes available: -->
    <div class="container">

        <!-- <h2> is a secondary heading, <h1> primary heading, <h3> tertiary and so on -->
        <!-- <h2 class="pt-2">BingeSpark</h2> -->

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
                $runtime = $row['runtime_minutes'];

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
                    // $ratinguser = $row['username'];


                    //Array of rating values to calculate ratings
                    array_push($ratingvalues, $rating);
                }

                //Average source: https://stackoverflow.com/questions/33461430/how-to-find-average-from-array-in-php
                //Rounding to 1 decimal place
                $ratingvalues = array_filter($ratingvalues);
                $average = round(array_sum($ratingvalues) / count($ratingvalues), 1);

                $update_average_rating_sql = "UPDATE `movie` SET `average_rating` = '$average' WHERE `movie`.`movie_id` = '$id'";
                $update_average_rating_statement = $conn->query($update_average_rating_sql);



                echo "
            <div class='col mb-4'>
            <div class='card float-left text-warning bg-dark mb-3 mr-2 mb-2' style='width: 16rem;'>
            <img src='{$row['poster_uri']}' class='card-img-top' alt='...'>
               <div class='card-body'>
                 <h6>{$row['release_year']}</h6>

                 <h5 class='card-title text-danger' style='min-height:30px;'>{$row['title']}</h5>
                 <p class='card-title' style='min-height:20px;'> {$genresremovequotes} </p>
                 <p class='card-title' style='min-height:20px;'> Average rating: {$average} star</p>
                 <p class='card-title text-secondary' style='min-height:20px;'> Runtime: {$runtime} minutes</p>

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

    <!-- The <script> tag is used to embed a client-side script (JavaScript).
The <script> element either contains scripting statements, or it points to an external script file through the src attribute.
Common uses for JavaScript are image manipulation, form validation, and dynamic changes of content. -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>
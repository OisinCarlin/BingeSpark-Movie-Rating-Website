<?php

include('db.php');


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


//Get movie ID from URI
$id = $_GET["movieid"];

// Read using SQL a particular movie with particular ID.
$readmovie = "SELECT * FROM movie WHERE movie_id=$id ";

$res = $conn->query($readmovie);

$moviedata = $res->fetch_assoc();

$revenue = $moviedata["revenue_millions"];
//***Broken, find alternative. Possibly explode actors from movie table */

// Read movie_actor table for actors
$sqlreadactors = "SELECT *
FROM movie_actor
INNER JOIN
movie
INNER JOIN
actor
WHERE
movie_actor.actor_id = actor.actor_id
AND movie_actor.movie_id = movie.movie_id
AND movie.movie_id=$id ;";

// echo $sqlreadactors;

$actorres = $conn->query($sqlreadactors);


$actorslist = array();

while ($row = $actorres->fetch_assoc()) {

    $actor_name = $row['actor_name'];

    array_push($actorslist, $actor_name);
}


// Read movie_genre table for genres
$sqlreadgenres = "SELECT *
FROM movie_genre
INNER JOIN
movie
INNER JOIN
genre
WHERE
movie_genre.genre_id = genre.genre_id
AND movie_genre.movie_id = movie.movie_id
AND movie.movie_id=$id ;";


$genreres = $conn->query($sqlreadgenres);


$genrelist = array();

while ($row = $genreres->fetch_assoc()) {

    $genre_name = $row['genre_name'];

    array_push($genrelist, $genre_name);
}

// foreach($genrelist as $genre){
//     echo $genre;
// }


// Read movie_director table for directors
$sqlreaddirectors =  "SELECT *
FROM movie_director
INNER JOIN
movie
INNER JOIN
director
WHERE
movie_director.director_id = director.director_id
AND movie_director.movie_id = movie.movie_id
AND movie.movie_id=$id ;";

$directorres = $conn->query($sqlreaddirectors);


$directorlist = array();

while ($row = $directorres->fetch_assoc()) {

    $director_name = $row['director_name'];

    array_push($directorlist, $director_name);
}

// =================================================
// Read movie_rating table for ratings
$sqlreadratings =  "SELECT *
FROM movie_rating
WHERE movie_id=$id ;";

$ratingres = $conn->query($sqlreadratings);


$ratinglist = array();
$ratingvalues = array();
$ratinguserlist = array();

while ($row = $ratingres->fetch_assoc()) {

    $rating = $row['rating'];
    $ratinguser = $row['username'];
    

    //Array of rating values to calculate ratings
    array_push($ratingvalues, $rating);

    $rating_user_combined = $ratinguser . ":    " . $rating . " star";
    array_push($ratinglist, $rating_user_combined);

    array_push($ratinguserlist, $ratinguser);
}

//Average source: https://stackoverflow.com/questions/33461430/how-to-find-average-from-array-in-php
//Rounding to 1 decimal place
$ratingvalues = array_filter($ratingvalues);

if(isset($ratingvalues)){
    $average = round(array_sum($ratingvalues)/count($ratingvalues), 1);
}

// echo $average;


$user_movie_rating_sql = "SELECT rating
from movie_rating
WHERE movie_id = $id
AND username = '$session_user_name';";

// $user_movie_rating_res =  $conn->query($user_movie_rating_sql);



$user_movie_rating_statement = mysqli_query($conn, $user_movie_rating_sql);
$user_movie_rating_row = mysqli_fetch_array($user_movie_rating_statement);
$user_movie_rating = $user_movie_rating_row[0];
// echo $user_movie_rating;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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





        <!-- navbar-brand float-right - Bootstrap CSS particular styling of Navbar -->

        <!-- Bootstrap briefcase icon with <a> tag, removed 21/4/22 -->
        <!-- <a class="navbar-brand float-right " href="#">
            <img src="https://icons.veryicon.com/png/System/Colorful%20Long%20Shadow/Basket.png" width="30" height="30" class="d-inline-block align-top">
        </a> -->


    </nav>



    <div class="container">

        <!-- <p>
<h1 style="color:red; font-size:300%;"> Welcome to BingeSpark </h1>
</p> -->

        <p>
        <h2 style="color:red; font-size:300%;"> <?php echo $moviedata["title"] ?> </h1>
            </p>

    </div>




    <!-- Test card -->
    <?php

    $actorsremovequotes = str_replace("'", '', $moviedata['movie_actors']);
    $genresremovequotes = str_replace("'", '', $moviedata['genre']);

    echo "
            <div class='col mb-4'>
            <div class='card float-right text-warning bg-dark mb-3 mr-2 mb-2' style='width: 16rem;'>
            <img src='{$moviedata["poster_uri"]}' class='card-img-top' alt='...'>

                 </div>
           </div>"
    ?>


    <!-- Image -->
    <!-- <div id="header" style="height:15%;width:100%;">
    <div style='float:left'>
        <img src='{<?php echo $moviedata["poster_uri"] ?>}' style="margin-left:15%;margin-top:5%"/>
    </div> -->

    <div class="container">
    </div>



    <!-- Table -->
    <div style='float:left'>
        <table class="table table-striped table-dark" width="44" style="margin-left:30%;">
            <thead>
                <tr>
                    <th scope="col">Title:</th>
                    <th scope="col"><?php echo $moviedata["title"] ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Year released:</th>
                    <td><?php echo $moviedata["release_year"] ?></td>
                </tr>
                <tr>
                    <th scope="row">Runtime:</th>
                    <td><?php echo $moviedata["runtime_minutes"] ?> minutes</td>
                </tr>
                <tr>
                    <th scope="row">Actors:</th>
                    <td>
                        <?php
                        foreach ($actorslist as $actor) {
                            echo $actor;
                        ?> <br />
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Genres:</th>
                    <td>
                        <?php
                        foreach ($genrelist as $genre) {
                            echo $genre;
                        ?> <br />
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Directors:</th>
                    <td>
                        <?php
                        foreach ($directorlist as $director) {
                            echo $director;
                        ?> <br />
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if(!$revenue == 0.00){
                    echo                 "<tr>
                    <th scope='row'>Revenue:</th>
                    <td>$$revenue million</td>
                </tr>'";
                }
                ?>
                <?php
                if(isset($ratingvalues)){
                    echo"
                    <tr>
                    <th scope='row' style='color:gold;'>Average rating:</th>
                    <td style='color:gold;'>$average star</td>
                </tr>
                    ";
                }

                ?>
                <?php
                if(isset($user_movie_rating)){
                    echo "<tr>
                    <th scope='row' style='color:gold;'>You rated:</th>
                    <td style='color:gold;'>$user_movie_rating star</td>
                </tr>";
                }
                ?>
                

            </tbody>
        </table>
    </div>



    <!-- ================================================================================================================= -->
    <div class="container">

        <!-- Rating form -->
        <!-- <div class="container"> -->
        <!-- <div class="fixed-bottom"> -->
        <form method="POST" action="ratingprocess.php?movieid=<?php echo $id ?>" style="color:gold; background-color:#4d4d4d; margin-left:75%; margin-top:55%; width: 250px;">
            <!-- <p> -->
            <?php

            if ($session_user_name == "Guest") {
                echo "Please log in to rate this movie
                <p>
            
            <a href='logout.php' class='btn btn-info'>Log in</a> <span> </span>
        </p>";
            } else if (in_array($session_user_name,$ratinguserlist)) {
                echo "You have already rated this movie
                <p>
            
            <a href='deleterating.php?movieid=$id' class='btn btn-danger'>Delete rating</a> <span> </span>
        </p>";
                    
                } else{
                echo "
                
                Rate this movie here:

                <div class='form-group'>
                    <select class='selectpicker' title='Select star rating...' id='rating-select' name='ratingselection' required>
                        <option value='' selected disabled>Select star rating</option>
                        <option name='5-star' value='5'>5-star</option>
                        <option name='4-star' value='4'>4-star</option>
                        <option name='3-star' value='3'>3-star</option>
                        <option name='2-star' value='2'>2-star</option>
                        <option name='1-star' value='1'>1-star</option>
                        <!-- <option name='Genre' value='Genre'>Genre</option>
                            <option name='Actor' value='Actor'>Actor</option>
                            <option name='Director' value='Director'>Director</option> -->
    
                    </select>
                </div>
    
                <!-- </p> -->
                <!-- <div class='form-group'>
                        <input name='search' value=''>
                    </div> -->
    
                <!-- <p> -->
                <input type='submit' value='Submit rating'>
                <!-- </p> -->";
            }
            ?>


        </form>
        <!-- ================================================================================================================= -->
        <!-- Ratings table -->

        <table class="table table-striped table-dark" style="color:gold; margin-left:4%; margin-top:25%; width: 350px;">
            <thead>
                <tr>
                    <th scope="col"  style="color:red;">Previous ratings</th>
                    <!-- <th scope="col">Rating</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratinglist as $rating) {

                        echo "                
                    <tr>
                     <th scope='row'>$rating</th>
                </tr>";
                    
                } ?>
                <!-- <tr>
                    <th scope="row">Year released:</th>
                    <td><?php echo $moviedata["release_year"] ?></td>
                </tr> -->

            </tbody>
        </table>

        <!-- </div> -->
    </div>









</body>

</html>



<!--


// echo 'This is a movie info page, one will be genrerate for each movie with PHP variable URI';

// Example of hyperlinking to database entry URI with PHP variable: wk08b
// href='editpop.php?rowid=$id'  -->
<?php

include("db.php");

 rand(1, 5);

//Select all movies
$sqlread = " SELECT * FROM movie;";


// $sqlread = " SELECT movie.movie_id, movie.title, movie.movie_actors, movie.release_year, movie.genre
// FROM movie;";

// Result variable = query of the (mysqli) connected database using SQL query stored
$result = $conn->query($sqlread);

// If no result, echo (mysqli) error
if (!$result) {
    echo $conn->error;
}


// ==============INSERTING ACTORS TO ACTORS TABLE===============================================================

// While loop to cycle through rows of SQL data results

while ($row = $result->fetch_assoc()) {

   $users_to_rate = array('dmcentagart0', 'mwill1', 'aroomes2', 'fanespie3', 'doaks4', 'lwagge5', 'tmaccahey6', 'aradley7', 'jhildrew8', 'omcdade9', 'sworsnapa', 'sspragueb');

    $movieid = $row['movie_id'];

   

    foreach($users_to_rate as $user_to_rate){

        $random_rating =  rand(1, 5);
        
    //Build SQL query to enter actor IDs and movie IDs to movie_actor table
    $movie_rating_insert_sql = "INSERT INTO movie_rating (movie_rating_id, movie_id, rating, username) VALUES (null, '$movieid', '$random_rating', '$user_to_rate'); ";

    echo $movie_rating_insert_sql ;

    // Run SQL Query on connected database
    $movie_rating_insert_statement = $conn->query($movie_rating_insert_sql);

    // Output SQL error to webpage if errors occur

    if (!$movie_rating_insert_statement) {
        echo "<div> SQL error -" . $conn->error, "</div>";
    }

    }

}

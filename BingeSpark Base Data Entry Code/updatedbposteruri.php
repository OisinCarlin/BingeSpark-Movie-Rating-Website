<?php

// MOVE SOME OF THESE INPUT PROGRAMS TO ADMIN FOLDER FOR SECURITY

// Includes and runs the database connection code
include("db.php");


// READ DATABASE USING SQL
$sqlread = "SELECT movie.title, movie.movie_actors, movie.release_year, movie.genre
         FROM movie";

// // SELECTING MOVIES WITH ID GREATER THAN 413
// $sqlread = "SELECT movie_id, movie.title, movie.movie_actors, movie.release_year, movie.genre FROM movie WHERE movie_id > 413";


// Result variable = query of the (mysqli) connected database using SQL query stored
$result = $conn->query($sqlread);

// If no result, echo (mysqli) error
if (!$result) {
    echo $conn->error;
}




// While loop to cycle through rows of SQL data results
while ($row = $result->fetch_assoc()) {

    // START OF MOVIE API CODE

    $val = $row['title'];

    //OMDB Endpoint

    //OMDB API KEY NON PATREON
    // $omdb_api_key = "d14806";

    //OMDB API KEY with PATREON
    $omdb_api_key = "5a72d0d7";


    $omdb_ep = "http://www.omdbapi.com/?apikey=$omdb_api_key&s=$val";

    $tmdb_api_key = "70c842a18c6af45cd87436a3eb76e5db";


    // File Get Contents of OMDB API
    $omdb_respond = file_get_contents($omdb_ep);

    // $book = json_decode($respond, true);
    $omdb_movie = json_decode($omdb_respond, true);

    // echo "<pre>";print_r($book);exit();



    //OMDB
    $omdb_api_res = $omdb_movie["Search"];

    $omdb_imdb_id = $omdb_api_res[0]["imdbID"];


    $tmdb_endp = "https://api.themoviedb.org/3/find/$omdb_imdb_id?api_key=$tmdb_api_key&language=en-US&external_source=imdb_id";

    //File Get Contents of TMDB API
    $tmdb_respond = file_get_contents($tmdb_endp);

    $tmdb_movie = json_decode($tmdb_respond, true);

    $tmdb_api_res = $tmdb_movie["movie_results"];





    // $pub = $item[0]["volumeInfo"]["publishedDate"];

    $posterpath = $tmdb_api_res[0]["poster_path"];

    // Move to main movie listings page (index.php) into while loop
    $posteruri = "https://image.tmdb.org/t/p/w500$posterpath";


    // UPDATE POSTER URI SQL
    $sqlposterupdate = "UPDATE movie SET poster_uri = '$posteruri' WHERE title='$val'";


    echo $sqlposterupdate;

    // echo $omdb_imdb_id;


    // RUNNING SQL QUERY:

    // // Run SQL Query on connected database
    // $posterstatement = $conn->query($sqlposterupdate);

    // // Output SQL error to webpage if errors occur
    // if (!$posterstatement) {
    //     echo "<div> SQL error -" . $conn->error, "</div>";
    // }
}

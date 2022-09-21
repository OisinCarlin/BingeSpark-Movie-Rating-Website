<?php


// Includes and runs the database connection code
// include("db.php");


//Select all movies
$sqlread = " SELECT * FROM movie;";



// Result variable = query of the (mysqli) connected database using SQL query stored
$result = $conn->query($sqlread);

// If no result, echo (mysqli) error
if (!$result) {
    echo $conn->error;
}


// ==============INSERTING ACTORS TO ACTORS TABLE===============================================================

// While loop to cycle through rows of SQL data results

while ($row = $result->fetch_assoc()) {


    $movieid = $row['movie_id'];

    $actors = $row['movie_actors'];

    $genres = $row['genre'];

    $directors = $row['director'];

    // String Replace to remove single quotes
    $actorsremovequotes = str_replace("'", '', $actors);


    //Explode: Split longer String into Strings by seperator (like an array)
    $explodedactors = explode(",", $actorsremovequotes);


    //INSERT ACTORS TO ACTORS TABLE: For-each loop to cycle through exploded actors for a film
    foreach ($explodedactors as $exp_actor) {
        //====================================================================================================================================

        // Catch Duplicate Actors in each loop using If/Else :
        $dup = mysqli_query($conn, "SELECT * FROM actor WHERE actor.actor_name = '$exp_actor';");

        if (mysqli_num_rows($dup) > 0) {
            echo "Skipping Duplicate Actor";
        } else {

            //Build SQL query to enter all exploded actors from a movie individually into the actors table
            $actortableinsertsql = "INSERT INTO actor (actor_id, actor_name) VALUES (null, '$exp_actor'); ";

            echo $actortableinsertsql;


            // Run SQL Query on connected database
            $statement = $conn->query($actortableinsertsql);

            // Output SQL error to webpage if errors occur
            if (!$statement) {
                echo "<div> SQL error -" . $conn->error, "</div>";
            }
        }
        //====================================================================================================================================
    }

    // ==============INSERTING MOVIES AND ACTORS TO MOVIE_ACTOR TABLE===============================================================

    foreach ($explodedactors as $exp_actor) {

        $grab_actor_id_sql = "SELECT * FROM actor where actor_name = '$exp_actor'; ";

        // echo $grab_actor_id_sql;

        $grab_actor_id_result = $conn->query($grab_actor_id_sql);

        if (!$grab_actor_id_result) {
            echo $conn->error;
        }

        $actor_table_entry = $grab_actor_id_result->fetch_assoc();



        $actor_table_actor_id = $actor_table_entry["actor_id"];
        $actor_table_actor_name = $actor_table_entry["actor_name"];


        //Build SQL query to enter actor IDs and movie IDs to movie_actor table
        $movie_actor_table_insert_sql = "INSERT INTO movie_actor (movie_id, actor_id) VALUES ('$movieid', '$actor_table_actor_id'); ";

        echo $movie_actor_table_insert_sql;

        // Run SQL Query on connected database
        $movie_actor_insert_statement = $conn->query($movie_actor_table_insert_sql);

        // Output SQL error to webpage if errors occur

        if (!$movie_actor_insert_statement) {
            echo "<div> SQL error -" . $conn->error, "</div>";
        }
    }





    // ============INSERT GENRES INTO GENRES TABLE=======================================

    // String Replace to remove single quotes
    $genresremovequotes = str_replace("'", '', $genres);


    //Explode: Split longer String into Strings by seperator (like an array)
    $explodedgenres = explode(",", $genresremovequotes);


    //For-each loop to cycle through exploded genres for a film
    foreach ($explodedgenres as $exp_genre) {
        //====================================================================================================================================

        // Catch Duplicate Genres in each loop using If/Else :
        $dupG = mysqli_query($conn, "SELECT * FROM genre WHERE genre.genre_name = '$exp_genre';");

        if (mysqli_num_rows($dupG) > 0) {
            echo "Skipping Duplicate Genre";
        } else {

            //Build SQL query to enter all exploded genres from a movie individually into the genre table
            $genre_table_insert_sql = "INSERT INTO genre (genre_id, genre_name) VALUES (null, '$exp_genre'); ";

            echo $genre_table_insert_sql;


            // Run SQL Query on connected database
            $genre_table_insert_statement = $conn->query($genre_table_insert_sql);

            // Output SQL error to webpage if errors occur
            if (!$genre_table_insert_statement) {
                echo "<div> SQL error -" . $conn->error, "</div>";
            }
        }
        //====================================================================================================================================
    }


    // ==============INSERTING MOVIES AND GENRES TO MOVIE_GENRE TABLE===============================================================

    foreach ($explodedgenres as $exp_genre) {

        $grab_genre_id_sql = "SELECT * FROM genre where genre_name = '$exp_genre'; ";

        // echo $grab_actor_id_sql;

        $grab_genre_id_result = $conn->query($grab_genre_id_sql);

        if (!$grab_genre_id_result) {
            echo $conn->error;
        }

        $genre_table_entry = $grab_genre_id_result->fetch_assoc();


        $genre_table_genre_id = $genre_table_entry["genre_id"];
        $genre_table_genre_name = $genre_table_entry["genre_name"];

        //Build SQL query to enter genre IDs and movie IDs to movie_genre table
        $movie_genre_table_insert_sql = "INSERT INTO movie_genre (movie_id, genre_id) VALUES ('$movieid', '$genre_table_genre_id'); ";

        echo $movie_genre_table_insert_sql;

        // Run SQL Query on connected database
        $movie_genre_insert_statement = $conn->query($movie_genre_table_insert_sql);

        // Output SQL error to webpage if errors occur

        if (!$movie_genre_insert_statement) {
            echo "<div> SQL error -" . $conn->error, "</div>";
        }
    }
    //====================================================================================================================================




    //============INSERT DIRECTORS INTO DIRECTORS TABLE==============================================================================

    // String Replace to remove single quotes
    $directorsremovequotes = str_replace("'", '', $directors);

    echo $directorsremovequotes;



    //Explode: Split longer String into Strings by seperator (like an array)
    $explodeddirectors = explode(",", $directorsremovequotes);


    //For-each loop to cycle through exploded genres for a film
    foreach ($explodeddirectors as $exp_director) {
        //====================================================================================================================================

        // Catch Duplicate Genres in each loop using If/Else :
        $dupD = mysqli_query($conn, "SELECT * FROM director WHERE director.director_name = '$exp_director';");

        if (mysqli_num_rows($dupD) > 0) {
            echo "Skipping Duplicate Director";
        } else {

            //Build SQL query to enter all exploded genres from a movie individually into the genre table
            $director_table_insert_sql = "INSERT INTO director (director_id, director_name) VALUES (null, '$exp_director'); ";

            echo $director_table_insert_sql;


            // Run SQL Query on connected database
            $director_table_insert_statement = $conn->query($director_table_insert_sql);

            // Output SQL error to webpage if errors occur
            if (!$director_table_insert_statement) {
                echo "<div> SQL error -" . $conn->error, "</div>";
            }
        }
        //====================================================================================================================================
    }


    // ==============INSERTING MOVIES AND DIRECTORS INTO MOVIE_DIRECTOR TABLE===============================================================

    foreach ($explodeddirectors as $exp_director) {

        $grab_director_id_sql = "SELECT * FROM director where director_name = '$exp_director'; ";

        // echo $grab_director_id_sql;

        $grab_director_id_result = $conn->query($grab_director_id_sql);

        if (!$grab_director_id_result) {
            echo $conn->error;
        }

        $director_table_entry = $grab_director_id_result->fetch_assoc();

        $director_table_director_id = $director_table_entry["director_id"];
        $director_table_director_name = $director_table_entry["director_name"];


        //Build SQL query to enter genre IDs and movie IDs to movie_genre table
        $movie_director_table_insert_sql = "INSERT INTO movie_director (movie_id, director_id) VALUES ('$movieid', '$director_table_director_id'); ";

        echo $movie_director_table_insert_sql;

        // Run SQL Query on connected database
        $movie_director_insert_statement = $conn->query($movie_director_table_insert_sql);

        // Output SQL error to webpage if errors occur

        if (!$movie_director_insert_statement) {
            echo "<div> SQL error -" . $conn->error, "</div>";
        }
    }

}
//=======================================================================================
























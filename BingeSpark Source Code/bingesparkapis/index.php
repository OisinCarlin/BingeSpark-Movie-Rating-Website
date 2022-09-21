<?php


header('Content-Type: application/json');

// Wrap database connection in a function
// Funtions must have a return (like a method). Return the $conn mysqli connection
// Copied from db.php file
function connection()
{
    // Local Connection:

    // $host = "localhost";
    // $user = "root";
    // $pw = "root"; //if XAMMP then delete root(string)
    // $db = "bingespark";

    //Web hosted connection:

    $host = "ocarlin04.webhosting5.eeecs.qub.ac.uk";

    $user = "ocarlin04";

    $pw = "5ypsqqGwZnJ0GbTB"; //if XAMMP then delete root(string)

    $db = "ocarlin04";

    // new connection between PHP and a MySQL database
    $conn = new mysqli($host, $user, $pw, $db);

    // If connection results in connection error
    // Echo the connection error
    if ($conn->connect_error) {
        echo $conn->connect_error;
    }

    return $conn;
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['movietitle'])) {

    $titlemessage = $_POST['movietitle'];

    //verifcation code using an API Key

    if (isset($_GET['api_k'])) { //True condition, if the API Key exists, build "$m", perfrom SQL query on database.

        // Store database connection function in variable "$db". Moved to top in Thu 31/3 lecture.
        $db = connection();

        $key = ($_GET['api_k']);

        // Query 11guitarapi table for matching API key.
        $sqlver = "SELECT * FROM admin WHERE admin_api_key='$key'";

        // Result: query the database using SQL stored in $sqlver variable.
        $verres = $db->query($sqlver);

        // If no result, provide user response message.
        if (!$verres) {
            $m = array("message" => "sorry there was an issue with the SQL" . $db->error);
        }

        // Get the number of rows of results
        $num = $verres->num_rows;

        //If number of rows greater than 0 for results of SQL query for particular API key.
        if ($num > 0) { //True statement


            $genres = $_POST['moviegenres'];
            $directors = $_POST['moviedirectors'];
            $actors = $_POST['movieactors'];

            //Prepared to insert to Movie table
            $title = $_POST['movietitle'];
            $year = $_POST['movieyear'];
            $runtime = $_POST['movieruntime'];
            $revenue = $_POST['movierevenue'];



            // ================ Start of Poster URI Code =============================================================================


            //OMDB API KEY with PATREON
            $omdb_api_key = "5a72d0d7";


            $omdb_ep = "http://www.omdbapi.com/?apikey=$omdb_api_key&s=$title";

            $tmdb_api_key = "70c842a18c6af45cd87436a3eb76e5db";



            // File Get Contents of OMDB API
            $omdb_respond = file_get_contents($omdb_ep);



            // $book = json_decode($respond, true);
            $omdb_movie = json_decode($omdb_respond, true);


            // $api_res = $movie["results"];

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



            // ==========================================================================================================================


            // SQL Movie Insert Statement: 
            // $sqlinsert = "INSERT INTO 11guitarstock (product, maker, price) VALUES ('$name', '$maker', '$price');";
            $movieinsertsql = "INSERT INTO movie (movie_id, title, genre, director, movie_actors, release_year, runtime_minutes, revenue_millions, poster_uri, average_rating) VALUES (null, '$title', '$genres', '$directors', '$actors', '$year', '$runtime', '$revenue', '$posteruri', null);";


            // "$res" variable: Query the database connected. Perform the SQL Insert Query outlined in "$sqlinsert" variable.
            $res = $db->query($movieinsertsql);

        



            // =================================================================================================================================


            //Get Movie ID after insert
            $movie_select_sql = "SELECT movie_id from movie WHERE title = '$title';";

            $movie_select_statement = $db->query($movie_select_sql);
            $movie_select_row = mysqli_fetch_array($movie_select_statement);
            $movieid = $movie_select_row[0];

            echo $movieid;


            
                //Explode: Split longer String into Strings by seperator (like an array)
                $explodedactors = explode(",", $actors);
            
            
                //INSERT ACTORS TO ACTORS TABLE: For-each loop to cycle through exploded actors for a film
                foreach ($explodedactors as $exp_actor) {
                    //====================================================================================================================================
            
                    // Catch Duplicate Actors in each loop using If/Else :
                    $dup = $db->query("SELECT * FROM actor WHERE actor.actor_name = '$exp_actor';");
            
                    if (mysqli_num_rows($dup) > 0) {
                        echo "Skipping Duplicate Actor";
                    } else {
            
                        //Build SQL query to enter all exploded actors from a movie individually into the actors table
                        $actortableinsertsql = "INSERT INTO actor (actor_id, actor_name) VALUES (null, '$exp_actor'); ";
            
                        echo $actortableinsertsql;
            
            
                        // Run SQL Query on connected database
                        $statement = $db->query($actortableinsertsql);
            
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
            
                    $grab_actor_id_result = $db->query($grab_actor_id_sql);
            
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
                    $movie_actor_insert_statement = $db->query($movie_actor_table_insert_sql);
            
                    // Output SQL error to webpage if errors occur
            
                    if (!$movie_actor_insert_statement) {
                        echo "<div> SQL error -" . $conn->error, "</div>";
                    }
                }
            
            
            
            
            
                //============INSERT GENRES INTO GENRES TABLE=======================================
            
            
                //Explode: Split longer String into Strings by seperator (like an array)
                $explodedgenres = explode(",", $genres);
            
            
                //For-each loop to cycle through exploded genres for a film
                foreach ($explodedgenres as $exp_genre) {
                    //====================================================================================================================================
            
                    // Catch Duplicate Genres in each loop using If/Else :
                    $dupG = $db->query("SELECT * FROM genre WHERE genre.genre_name = '$exp_genre';");
            
                    if (mysqli_num_rows($dupG) > 0) {
                        echo "Skipping Duplicate Genre";
                    } else {
            
                        //Build SQL query to enter all exploded genres from a movie individually into the genre table
                        $genre_table_insert_sql = "INSERT INTO genre (genre_id, genre_name) VALUES (null, '$exp_genre'); ";
            
                        echo $genre_table_insert_sql;
            
            
                        // Run SQL Query on connected database
                        $genre_table_insert_statement = $db->query($genre_table_insert_sql);
            
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
            
                    $grab_genre_id_result = $db->query($grab_genre_id_sql);
            
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
                    $movie_genre_insert_statement = $db->query($movie_genre_table_insert_sql);
            
                    // Output SQL error to webpage if errors occur
            
                    if (!$movie_genre_insert_statement) {
                        echo "<div> SQL error -" . $conn->error, "</div>";
                    }
                }
                //====================================================================================================================================
            
            
            
            
                //============INSERT DIRECTORS INTO DIRECTORS TABLE==============================================================================
            
            
            
                //Explode: Split longer String into Strings by seperator (like an array)
                $explodeddirectors = explode(",", $directors);
            
            
                //For-each loop to cycle through exploded genres for a film
                foreach ($explodeddirectors as $exp_director) {
                    //====================================================================================================================================
            
                    // Catch Duplicate Genres in each loop using If/Else :
                    $dupD = $db->query("SELECT * FROM director WHERE director.director_name = '$exp_director';");
            
                    if (mysqli_num_rows($dupD) > 0) {
                        echo "Skipping Duplicate Director";
                    } else {
            
                        //Build SQL query to enter all exploded genres from a movie individually into the genre table
                        $director_table_insert_sql = "INSERT INTO director (director_id, director_name) VALUES (null, '$exp_director'); ";
            
                        echo $director_table_insert_sql;
            
            
                        // Run SQL Query on connected database
                        $director_table_insert_statement = $db->query($director_table_insert_sql);
            
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
            
                    $grab_director_id_result = $db->query($grab_director_id_sql);
            
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
                    $movie_director_insert_statement = $db->query($movie_director_table_insert_sql);
            
                    // Output SQL error to webpage if errors occur
            
                    if (!$movie_director_insert_statement) {
                        echo "<div> SQL error -" . $conn->error, "</div>";
                    }
                }
            
            
            //=======================================================================================

                            // If there is an issue (no "$res" result [true/false]), tell the user (do this) Good idea to echo out the error.
            if (!$res) { //Failure (false)

                $m = array("message" => "sorry there was an issue with the SQL: $movieinsertsql" . $db->error);
            } else { //Success (true)

                // Build an assoc array (message) for results (changed from "$res" on Thu 31/3 to "$m" for 'message', moved into if/else)
                $m = array("message" => "success $title went into database table");
            }
        } else {
            // False condition: there are 0 for results of SQL query for particular API key.
            $m = array("message" => "incorrect API key : '$key'");
        }
    } else {
        // False condition: output (JSON) message to let user know the API key is missing.
        $m = array("message" => "API key missing.");
    }

    $m = array("message" => "Success $titlemessage went into BingeSpark database");

 

    //Ensure some type of JSON 
    echo json_encode($m);



}

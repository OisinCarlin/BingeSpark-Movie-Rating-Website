<?php

//Program to transfer movie data from CSV to database

// Includes and runs the database connection code
include("db.php");

// COPIED DB.php CONNECTION

    // // Local connection: 

    // $host = "localhost";
    // $user = "root";
    // $pw = "root"; //if XAMMP then delete root(string)
    // $db = "bingespark";

    // //Web hosted connection:

    // // $host = "ocarlin04.webhosting5.eeecs.qub.ac.uk";
    // // $user = "ocarlin04";
    // // $pw = "5ypsqqGwZnJ0GbTB"; //if XAMMP then delete root(string)
    // // $db = "ocarlin04";

    // // new connection between PHP and a MySQL database
    // $conn = new mysqli($host, $user, $pw, $db);

    // // If connection results in connection error
    // // Echo the connection error
    // if ($conn->connect_error) {
    //     echo "not connected" . $conn->connect_error;
    //     exit();
    // }

// END OF COPIED DB.php CONNECTION

//Assign CSV file stored in parent folder to variable
$file = fopen("Movie-DataSet2_final.csv", 'r');

// Error if cannot find file
if ($file === false) {
    echo "Cannot open the file ".$filename;
    exit();
}

// While loop to loop through lines of data in CSV file
while (($line = fgetcsv($file)) !== false){

    // Source for blanks corrections https://www.codepudding.com/net/161746.html 

    // Collect data from CSV and replace blanks
    $title_non_escape = $line[0] !== "" ? $line[0] : "n/a";
    $genre_non_escape = $line[1] !== "" ? $line[1] : "n/a";
    $director_non_escape = $line[2] !== "" ? $line[2] : "n/a";
    $movie_actors_non_escape = $line[3] !== "" ? $line[3] : "n/a";

    $release_year = $line[4] !== "" ? $line[4] : 0;
    $runtime_minutes = $line[5] !== "" ? $line[5] : 0;
    $revenue_millions = $line[6] !== "" ? $line[6] : 0.00;

    // Variables with Escapes
    $title = mysqli_escape_string($conn, $title_non_escape);
    $genre = mysqli_escape_string($conn, $genre_non_escape);
    $director = mysqli_escape_string($conn, $director_non_escape);
    $movie_actors = mysqli_escape_string($conn, $movie_actors_non_escape);

    // Fix bad data: Titles
    if($title=="X: First Class"){
        $title = "X-Men: First Class";
    }
    if($title=="Old Boy"){
        $title = "Oldboy";
    }
    if($title=="True Crimes"){
        $title = "Dark Crimes";
    }
    if($title=="Goksung"){
        $title = "The Wailing";
    }
    if($title=="Adoration"){
        $title = "Adore";
    }
    if($title=="The imposible"){
        $title = "The Impossible";
    }
    if($title=="The Boy in the Striped Pyjamas"){
        $title = "The Boy in the Striped Pajamas";
    }
    if($title=="London Heist"){
        $title = "Gunned Down";
    }
    if($title=="MR. RIGHT"){
        $title = "Mr. Right";
    }
    if($title=="Monty Python's Life of Brian"){
        $title = "Life of Brian";
    }
    if($title=="American Pie 9: Girls' Rules"){
        $title = "American Pie Presents: Girls' Rules";
    }
    if($title=="Wannabe Courageous"){
        $title = "Sab el-Burumbah";
    }
    if($title=="Into the Wind"){
        $title = "Do vetru";
    }
    if($title=="The Girl and the Gun"){
        $title = "The Woman and the Gun";
    }
    if($title=="Les Miserables"){
        $title = "Les Misérables";
    }

    // Fix bad data: Years

    if($title=="Eddie the Eagle"){
        $release_year = 2015;
    }
    if($title=="Black Sea"){
        $release_year = 2014;
    }
    if($title=="Super Me"){
        $release_year = 2019;
    }
    if($title=="Total Recall"){
        $release_year = 2012;
    }
    if($title=="Then Came You"){
        $release_year = 2018;
    }
    if($title=="A Man For The Week End"){
        $title = "A Man For The Weekend";
        $release_year = 2017;
    }
    if($title=="Hampstead"){
        $release_year = 2017;
    }
    if($title=="Wanted" && $release_year==2019){
        $title = "Wanted - Matloubin";
    }
    if($title=="Mary Magdalene"){
        $release_year = 2018;
    }
    if($title=="Deranged"){
        $release_year = 2017;
    }
    if($title=="Lady Driver"){
        $release_year = 2020;
    }
    if($title=="The Swarm"){
        $release_year = 2020;
    }
    if($title=="Until Midnight"){
        $release_year = 2018;
    }
    if($title=="Synchronic"){
        $release_year = 2019;
    }

    // Constuct SQL Query
    // All String values in variables must be wrapped in single quotes. Non-string values can also be wrapped in single quotes if you wish.
//    $insertline = "INSERT INTO movie (movie_id, title, genre, director, movie_actors, release_year, runtime_minutes, revenue_millions) VALUES (null, '$title', '$genre', '$director', '$movie_actors', '$release_year', '$runtime_minutes', '$revenue_millions') ";

//     // Run SQL Query on connected database
//     $statement = $conn->query($insertline);

//     // Output SQL error to webpage if errors occur
//     if(!$statement){
//         echo "<div> SQL error -".$conn->error, "</div>";
//     }
}

// Close resources
fclose($file);


<?php

// Should be able to copy the same db.php file from any other of your projects...
//.. if db.php file is missing
//It should be the same as it is simply a file with details to connect to your database.

// Local connection: 

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
    exit();
}
<?php

// Includes and runs the database connection code
include("db.php");

// Store session information.
// Reference "Easy Tutorials (YouTube)" : https://www.youtube.com/watch?v=NXAHkqiIepc&ab_channel=EasyTutorials
session_start();

$regisered_user_email = $_POST["registereduseremail"];
$registered_user_password = $_POST["registereduserpassword"];



// Fetch details of registered users :
$select_users = mysqli_query($conn, "SELECT * from user WHERE user.user_email= '$regisered_user_email';");

$user_entry = $select_users->fetch_assoc();


//Get salt in use
$salt_in_use_sql = "SELECT SUBSTRING(user_password, 1, 6) FROM user WHERE user_email = '$regisered_user_email'";

$salt_in_use_statement = mysqli_query($conn, $salt_in_use_sql);
$salt_in_use_row = mysqli_fetch_array($salt_in_use_statement);
$salt_in_use = $salt_in_use_row[0];
// echo $salt_in_use;


//Get stored salted hash in use
$salted_hash_in_use_sql = "SELECT SUBSTRING(user_password, 7, 40) FROM user WHERE user_email = '$regisered_user_email'";

$salted_hash_in_use_statement = mysqli_query($conn, $salted_hash_in_use_sql);
$salted_hash_in_use_row = mysqli_fetch_array($salted_hash_in_use_statement);
$salted_hash_in_use = $salted_hash_in_use_row[0];
// echo $salted_hash_in_use;


//Get stored salted hash in use
$salted_hash_login_sql = "SELECT SHA1(CONCAT('$salt_in_use', '$registered_user_password'));";

$salted_hash_login_statement = mysqli_query($conn, $salted_hash_login_sql);
$salted_hash_login_row = mysqli_fetch_array($salted_hash_login_statement);
$salted_hash_login = $salted_hash_login_row[0];
echo $salted_hash_login;




//Store username
$user_username = $user_entry['user_username'];

// echo $user_stored_password;

if (mysqli_num_rows($select_users) > 0) {

    // // Check password
    // $user_stored_password = $user_entry['user_password'];

    if ($salted_hash_login == $salted_hash_in_use) {

        //Stored session variables
        $_SESSION['username'] = $user_username;
        // $_SESSION['userid'] = $user_id;

        header("Location:homepage.php");

    } else {

        header("Location:incorrectpassword.php");
    }
} else {

    header("Location:noregistereduser.php");
}

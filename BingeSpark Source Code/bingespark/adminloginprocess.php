<?php

// Includes and runs the database connection code
include("db.php");

// Store session information.
// Reference "Easy Tutorials (YouTube)" : https://www.youtube.com/watch?v=NXAHkqiIepc&ab_channel=EasyTutorials
session_start();

$regisered_user_email = $_POST["adminemail"];
$registered_user_password = $_POST["adminpassword"];



// Fetch details of registered users :
$select_users = mysqli_query($conn, "SELECT * from admin WHERE admin.admin_email= '$regisered_user_email';");

$user_entry = $select_users->fetch_assoc();


//Get salt in use
$salt_in_use_sql = "SELECT SUBSTRING(admin_password, 1, 6) FROM admin WHERE admin_email = '$regisered_user_email'";

$salt_in_use_statement = mysqli_query($conn, $salt_in_use_sql);
$salt_in_use_row = mysqli_fetch_array($salt_in_use_statement);
$salt_in_use = $salt_in_use_row[0];
// echo $salt_in_use;


//Get stored salted hash in use
$salted_hash_in_use_sql = "SELECT SUBSTRING(admin_password, 7, 40) FROM admin WHERE admin_email = '$regisered_user_email'";

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




// //Store API key
// $user_username = $user_entry['user_username'];

// echo $user_stored_password;

if (mysqli_num_rows($select_users) > 0) {

    // // Check password
    // $user_stored_password = $user_entry['user_password'];

    if ($salted_hash_login == $salted_hash_in_use) {


        //Store API Key
        $_SESSION['apikey'] = $user_entry['admin_api_key'];

        header("Location:admin/dashboard.php");

    } else {

        // $_POST['message'] = "Incorrect admin password";
        header("Location:adminlogin.php?message=IncorrectAdminPassword");
    }
} else {
    // $_POST['message'] = "No registered admin";
    header("Location:adminlogin.php?message=NoRegisteredAdmin");
}

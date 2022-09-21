<?php


session_start();


// Includes and runs the database connection code
include("db.php");

$user_email = $_POST["createuseremail"];
$user_user_name = $_POST["createuserusername"];
$user_password = $_POST["createuserpassword"];


// Catch Duplicate users in each loop using If/Else :
$select_users = mysqli_query($conn, "SELECT * from user WHERE user.user_email= '$user_email';");

$select_users_dup_username = mysqli_query($conn, "SELECT * from user WHERE user.user_username= '$user_user_name';");


if (mysqli_num_rows($select_users_dup_username) > 0) {

    header("Location:signupduplicateusername.php");
} else {

    if (mysqli_num_rows($select_users) > 0) {

        header("Location:signupuserexists.php");
    } else {

        // //Build SQL query to enter all exploded actors from a movie individually into the actors table
        // $user_table_insert_sql = "INSERT INTO user (user_id, user_email, user_username, user_password) VALUES (null, '$user_email', '$user_user_name', '$user_password'); ";

        $user_table_insert_sql = " 
        SET @email = '$user_email';
        SET @username = '$user_user_name';
        SET @plainPassword = '$user_password';

        SELECT @salt := SUBSTRING(SHA1(RAND()), 1, 6);

        SELECT @saltedHash := SHA1(CONCAT(@salt, @plainPassword)) AS salted_hash_value;

        SELECT @storedSaltedHash := CONCAT(@salt,@saltedHash) AS password_to_be_stored;

        INSERT INTO user (user_id, user_email, user_username, user_password)
		  VALUES (NULL, @email, @username, @storedSaltedHash); 
        ";

        echo $user_table_insert_sql;

        // Run SQL Query on connected database
        $statement = $conn->multi_query($user_table_insert_sql);

        // Output SQL error to webpage if errors occur
        if (!$statement) {
            echo "<div> SQL error -" . $conn->error, "</div>";
        }

        // Source: https://stackoverflow.com/questions/12246102/php-passing-message-along-header-location
        $Message = urlencode("Account created, you can now log in");
        header("Location:index.php?Message=" . $Message);
        die;
    }
}

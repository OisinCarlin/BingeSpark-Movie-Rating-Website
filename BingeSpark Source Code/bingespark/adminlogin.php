<?php

// // Includes and runs the database connection code
// include("db.php");

// //Start session
// //Source "Easy Tutorials" (YouTube): https://www.youtube.com/watch?v=NXAHkqiIepc&ab_channel=EasyTutorials 
// session_start();

if(isset($_GET['message'])){
    if($_GET['message'] == "IncorrectAdminPassword"){
    $indexmessage = "Incorrect admin password";
    } else if($_GET['message'] == "NoRegisteredAdmin"){
        $indexmessage = "No registered admin";
    } 
}  else {
    $indexmessage = "Please enter your admin credentials";
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Linking Bootstrap CSS stylesheet for HTML Page Style-->
    <link rel="stylesheet" href=https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css>

    <!-- Title of document/webpage, for history/browser etc. Not heading -->
    <title>BingeSpark</title>
</head>





<!-- Main body with Background Colour -->

<body style="background-color:#292826;">

    <!-- Navigation and Navbar (particular for Bootstrap CSS) -->
    <nav class="navbar navbar-light bg-primary">

        <!-- <a> tag is a hyperlink, href is hyperlink URL or fragment of which it points to -->
        <!-- href="#" links to top of page -->
        <a class="navbar-brand" href="#">

            <!-- Image source and style -->
            <img src="/bingespark/images/BingeSparkLogo.png" width="160" height="80" class="d-inline-block align-top">

            <!-- This is the main heading at the top on the navbar beside the (logo) image -->
            <!-- BingeSpark -->
        </a>

    </nav>

    <div class="container">

        <p>
        <h1 style="color:red; font-size:300%;"> Welcome to BingeSpark </h1>
        </p>

        <p>
        <h2 style="color:blue; font-size:200%;"> <?php echo $indexmessage ?> </h1>
            </p>


            <p>
                <div class="col-md-6">
            <form method="POST" action="adminloginprocess.php">


                <div class="form-group">
                    <label style="color:blue;"> E-mail address </label>
                    <input type = "text" name='adminemail' class="form-control" value='' required>
                </div>

                <div class="form-group">
                    <label style="color:blue;"> Password </label>
                    <input type ="password" name='adminpassword' class="form-control" value=''>
                </div>

                <input type="submit" value='Log in'>

            </form>
                </div>

            </p>

    </div>

    <p>
    <div class="container">
        <!-- <p> -->
            <a href='index.php' class='btn btn-info'>Back to user login</a> <span> </span>
        <!-- </p> -->



    </div>
    </p>

</body>

</html>
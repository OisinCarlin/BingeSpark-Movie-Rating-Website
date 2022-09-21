<?php

session_start();


// If no admin API key set, deny access and return to index
if (!isset($_SESSION['apikey'])) {
    header("Location:logout.php");
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

        <p>
            Welcome Admin
            <a href='logout.php' class='btn btn-info'>Log out</a> <span> </span>
        </p>

    </nav>

    <div class="container">

        <p>
        <h1 style="color:red; font-size:300%;"> Welcome to BingeSpark </h1>
        </p>

        <!-- <p>
        <h2 style="color:blue; font-size:200%;"> <?php echo $indexmessage ?> </h1>
            </p> -->

    </div>

    <p>
    <div class="container">
        <!-- <p> -->
        <a href='addmovie.php' class='btn btn-info'>Add a movie to BingeSpark database</a> <span> </span>
        <!-- </p> -->



    </div>
    </p>



</body>

</html>
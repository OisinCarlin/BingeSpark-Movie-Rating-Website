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
        <h1 style="color:red; font-size:300%;">Add a movie to BingeSpark database </h1>
        </p>

        <!-- <p>
        <h2 style="color:blue; font-size:200%;"> <?php echo $indexmessage ?> </h1>
            </p> -->


            <p>
                <div class="col-md-6">
            <form method="POST" action="processmovie.php">


                <div class="form-group">
                    <label style="color:gold;"> Enter movie title </label>
                    <input type = "text" name='title' class="form-control" value='' required>
                </div>

                <div class="form-group">
                    <label style="color:gold;"> Enter genres seperated by single comma (E.g. Action,Adventure,etc.) </label>
                    <input type ="text" name='genres' class="form-control" value='' required>
                </div>

                <div class="form-group">
                    <label style="color:gold;"> Enter director or directors seperated by single comma (E.g. Quentin Tarantino,Stephen Spielberg,etc.) </label>
                    <input type ="text" name='directors' class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label style="color:gold;"> Enter actors seperated by single comma (E.g. Seth Rogen,James Franco,etc.) </label>
                    <input type ="text" name='actors' class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label style="color:gold;"> Enter release year (E.g. 2016) </label>
                    <input type ="text" name='year' class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label style="color:gold;"> Enter runtime in minutes (E.g. 117) </label>
                    <input type ="text" name='runtime' class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label style="color:gold;"> Enter revenue in millions of U.S. dollars (E.g. 45.43) </label>
                    <input type ="text" name='revenue' class="form-control" value='' required>
                </div>
                <input type="submit" value='Submit'>

            </form>
                </div>

            </p>

    </div>


    <p>
    <div class="container">
        <!-- <p> -->
            <a href='dashboard.php' class='btn btn-info'>Back to dashboard</a> <span> </span>
        <!-- </p> -->



    </div>
    </p>






</body>

</html>
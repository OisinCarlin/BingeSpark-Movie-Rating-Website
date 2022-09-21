<?php



session_start();

// If no admin API key set, deny access and return to index
if (!isset($_SESSION['apikey'])) {
    header("Location:logout.php");
}


$title = $_POST['title'];
$genres = $_POST['genres'];
$directors = $_POST['directors'];
$actors = $_POST['actors'];
$year = $_POST['year'];
$runtime = $_POST['runtime'];
$revenue = $_POST['revenue'];

$admin_api = $_SESSION['apikey'];



$posted = http_build_query(

    array('movietitle'=>$title, 'moviegenres'=>$genres, 'moviedirectors'=>$directors, 'movieactors'=>$actors, 'movieyear'=>$year, 'movieruntime'=>$runtime, 'movierevenue'=>$revenue)
);



$opts = array( //Options
     // The method we are doing: We're going to post this data. posting it through the header to create content of the type: application/x-www-form-urlencoded' (Similar to Postman)
    'http'=> array(
        'method' => 'POST',
        'header'=> 'Content-Type: application/x-www-form-urlencoded',
        'content'=> $posted //http_build_query, takes array of data from insert.php
    )
);


//Enpoint points to "wk11apis" folder, which stores the code for secure API which verifies key
//THIS IS VERY IMPORTANT: You will get very little back if your endpoint is wrong. Without the "s" in "wk11apis", the insert to database would not work!
// $ep = "http://localhost:8888/bingesparkapis/?api_k=$admin_api";

//Web hosting: 
$ep = "https://ocarlin04.webhosting5.eeecs.qub.ac.uk/bingesparkapis/?api_k=$admin_api";

// Create a stream context: Parameter (optional) must be an associative array of associative arrays in the format $arr['wrapper']['option'] = $value.
// Context is used to get files because we have to send it extra information, because we're posted we have to make sure all of this data is sent because that is what the headers need.
// Context holds all the data required to build the query, for pushing the data through a form.
$context = stream_context_create($opts);

$result = file_get_contents($ep, false, $context); //Result will be a JSON object.

$res = json_decode($result, true); //Decode from JSON to an aray.

$message = $res['message']; //Echo $res message from index:  $res = array("message" => "put $name into database table");


header("Location:movieadded.php?message=$message");

<?php

// Store session information.
// Reference "Easy Tutorials (YouTube)" : https://www.youtube.com/watch?v=NXAHkqiIepc&ab_channel=EasyTutorials
session_start();

// Destroy session variables
session_destroy();

header('location: index.php');

?>
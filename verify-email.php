<?php
session_start();
include('dbcon.php');

if (isset($_GET['token'])) {

    $token = $_GET['token'];
    $verify_query = "SELECT verified_token FROM user WHERE verified_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) {

        $row = mysqli_fetch_array($verify_query_run);
        echo $row['verified_token'];
        
    } else {

        $_SESSION['status'] = "This token does not exist!";
        header("Location: login.php");

    }
    
} else {

    $_SESSION['status'] = "Not Allowed!";
    header("Location: login.php");
}

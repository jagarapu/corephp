<?php

require_once 'constants.php';

function connect_database($db) {

    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, $db);
    if (!$conn) {
        $error = 'Error connecting to database. Please try after sometime';
        print $error;
        exit;
    }
    return $conn;
}

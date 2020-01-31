<?php 
     // connect to database
    $conn = mysqli_connect("localhost", "bashir", "test123", "wachtkamer");

    //check connection
    if (!$conn) {
        echo "connection: " . mysqli_connect_error();
    }
?>
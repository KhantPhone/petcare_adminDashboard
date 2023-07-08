<?php
    $conn = new mysqli('localhost','admin','admin12345','bookingsystem');
    if($conn->connect_error){
        die ("Connection failed: " .$conn->connect_error);
    }
?>
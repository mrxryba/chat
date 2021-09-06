<?php
session_start();
include_once "config.php";

try {
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = $_POST['searchTerm'];
    $query2 = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = "";
    $statement = $connect->prepare($query2);
    $statement->execute();
    $count2 = $statement->rowCount();
    if ($count2 > 0) {
        include_once "data.php";
    } else {
        $output .= 'No user found related to your search term';
    }
    echo $output;
} catch (PDOException $error) {
    $m = $error->getMessage();
}

?>






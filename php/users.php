<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");}
include_once "config.php";

try {
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $outgoing_id = $_SESSION['unique_id'];
    $query = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = "";

    $count = $statement->rowCount();
    if ($count == 0) {
        $output .= "No users are available to chat";
    } elseif ($count > 0) {
        include_once "data.php";
    }
    echo $output;

} catch (PDOException $error) {
    $m = $error->getMessage();
    echo $m;
}
?>




<?php
session_start();

if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $logout_id = $_SESSION['unique_id'];
    if (isset($logout_id)) {
        $status = "Offline now";
        try {
            $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET status = '{$status}' WHERE unique_id = {$_SESSION['unique_id']}";
            $statement = $connect->prepare($query);
            $statement->execute();
            if ($query) {
                session_unset();
                session_destroy();
                header("location: ../index.php");
            }
        } catch (PDOException $error) {
            $m = $error->getMessage();
        }
    }

} else {
    header("location: ../index.php");
}
?>
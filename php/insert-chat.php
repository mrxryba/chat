<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];
    if (!empty($message)) {
        try {
            $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')";
            $statement = $connect->prepare($query);
            $statement->execute() or die;


        } catch (PDOException $error) {
            $m = $error->getMessage();
            echo $m;
        }

    }

} else {
    header("location: ../index.php");
}

?>


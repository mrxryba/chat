<?php
session_start();
include_once "config.php";
$email = $_POST['email'];
$pass = $_POST['password'];
if (!empty($email) && !empty($pass)) {
    try {
        $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($pass, $row['password'])) {
                $status = "Active now";
                $sql2 = "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}";
                $stmt = $connect->prepare($sql2);
                $stmt->execute();
                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    header("location: ../users.php");
                } else {
                    $_SESSION['error'] = "Something went wrong. Please try again!";
                    header("location:../index.php");
                }
            } else {
                $_SESSION['error'] = "Email or Password is incorrect!";
                header("location:../index.php");
            }
        } else {
            $_SESSION['error'] = "This email not exist!";
            header("location:../index.php");
        }
    } catch (PDOException $error) {
        $m = $error->getMessage();
        echo $m;
    }
} else {
    $_SESSION['error'] = "All input fields are required!";
    header("location:../index.php");
}
?>
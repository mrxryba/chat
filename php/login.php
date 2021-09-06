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
            $user_pass = md5($pass);
            $enc_pass = $row['password'];
            if ($user_pass === $enc_pass) {
                $status = "Active now";
                $sql2 = "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}";
                $stmt = $connect->prepare($sql2);
                $stmt->execute();

                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
//                    echo "success";// TUtaj dać header do user php
                    header("location: ../users.php");
                } else {
                    $_SESSION['error'] = "Something went wrong. Please try again!";
                    header("location:../login.php");
                }
            } else {
                 $_SESSION['error'] = "Email or Password is Incorrect!";
                header("location:../login.php");
            }
        } else {
            $_SESSION['error'] = "This email not Exist!";
            header("location:../login.php");
        }
    } catch (PDOException $error) {
        $m = $error->getMessage();
        echo $m;
    }
} else {
    $_SESSION['error'] = "All input fields are required!";
    header("location:../login.php");
}
?>
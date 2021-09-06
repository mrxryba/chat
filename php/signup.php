<?php
session_start();
include_once "config.php";
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['password'];
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($pass)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM users WHERE email = '{$email}'";
            $statement = $connect->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            if ($count > 0) {
                echo "$email - This email already exist!";
            } else {
                if (isset($_FILES['image'])) {
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ["jpeg", "png", "jpg"];
                    if (in_array($img_ext, $extensions) === true) {
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if (in_array($img_type, $types) === true) {
                            $time = time();
                            $new_img_name = $time . $img_name;
                            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $encrypt_pass = password_hash($pass, PASSWORD_DEFAULT);
                                $insert_query = "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')";
                                $statement1 = $connect->prepare($insert_query);
                                $statement1->execute();
                                if ($statement1) {
                                    $select_query = "SELECT * FROM users WHERE email = '{$email}'";
                                    $statement2 = $connect->prepare($select_query);
                                    $statement2->execute();
                                    $count = $statement2->rowCount();
                                    if ($count > 0) {
                                        $result = $statement2->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";
                                    } else {
                                        echo "This email address does not exist";
                                    }
                                } else {
                                    echo "Something went wrong. Please try again!";
                                }

                            }
                        } else {
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    } else {
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }

            }


        } catch (PDOException $error) {
            $m = $error->getMessage();
            echo $m;
        }
    } else {
        echo "$email is not a valid email!";
    }


} else {
    echo "All fields are required!";

}
?>
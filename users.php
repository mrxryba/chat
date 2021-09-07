<?php
session_start();
include_once "php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include_once "header.php";
?>
<body>
<div class="wrapper">
    <section class="users">
        <header>
            <div class="content">
                <?php
                try {
                    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
                    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $query = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $count = $statement->rowCount();
                    if ($count > 0) {
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                    }
                } catch (PDOException $error) {
                    $m = $error->getMessage();
                    echo $m;
                }
                ?>
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </div>
            <a href="php/logout.php" class="logout">Logout</a>
        </header>
        <div class="search">
            <span class="text">Select an user to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">

        </div>
    </section>
</div>

<script src="javascript/users.js"></script>

</body>
</html>
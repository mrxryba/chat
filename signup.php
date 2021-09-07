<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header("location: users.php");
}
include_once "header.php"; ?>
<body>
<div class="wrapper">
    <section class="form signup">
        <img class="logo" src="logo-os-desktop.svg"/>
        <header class="chat-title"> OsWorkshop Chat </header>
        <form action="php/signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="error-text" style="display: block"> <?php
                echo $_SESSION['error'];

                ?></div><?php
                unset($_SESSION['error']);}
            ?>
            <div class="name-details">
                <div class="field input">
                    <label>First Name</label>
                    <input type="text" name="fname" placeholder="First name" required>
                </div>
                <div class="field input">
                    <label>Last Name</label>
                    <input type="text" name="lname" placeholder="Last name" required>
                </div>
            </div>
            <div class="field input">
                <label>Email Address</label>
                <input type="text" name="email" placeholder="Enter your email" required>
            </div>
            <div class="field input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter new password" required>
                <i class="fas fa-eye"></i>
            </div>
            <div class="field image">
                <label>Select your profile picture</label>
                <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Continue to Chat">
            </div>
        </form>
        <div class="link">Already signed up? <a href="index.php">Login now</a></div>
    </section>
</div>

<script src="javascript/pass-show-hide.js"></script>

</body>
</html>

<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header("location: users.php");
}
include_once "header.php"; ?>
<body>
<div class="wrapper">
    <section class="form login">
        <img class="logo" src="logo-os-desktop.svg"/>
        <header class="chat-title">OsWorkshop Chat</header>
        <form action="php/login.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="error-text" style="display: block"> <?php
                echo $_SESSION['error'];

                ?></div><?php
                unset($_SESSION['error']);
            }
            ?>
            <div class="field input form-email">
                <label>Email Address</label>
                <input type="text" name="email" placeholder="Enter your email" required>
            </div>
            <div class="field input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
                <i class="fas fa-eye"></i>
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Continue to Chat">
            </div>
        </form>
        <div class="link">Not yet signed up? <a href="signup.php">Signup now</a></div>
    </section>
</div>

<script src="javascript/pass-show-hide.js"></script>

</body>
</html>

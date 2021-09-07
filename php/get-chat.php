<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];
    $output = "";
    try {
        $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['outgoing_msg_id'] === $outgoing_id) {
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
                }
            }
        } else {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    } catch (PDOException $error) {
        $m = $error->getMessage();
        echo $m;
    }
} else {
    header("location: ../index.php");
}

?>
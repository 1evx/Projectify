<?php
    session_start(); 
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;
    
    $userID = $_SESSION['userid'];

    var_dump($_POST);

    if (isset($_POST['comment']) && isset($_POST['hostID']) && isset($_POST['forumID'])) {
        $comment = isset($_POST['comment']) ? mysqli_real_escape_string($connection, $_POST['comment']) : "";
        $hostID = isset($_POST['hostID']) ? mysqli_real_escape_string($connection, $_POST['hostID']) : "";
        $forumID = isset($_POST['forumID']) ? mysqli_real_escape_string($connection, $_POST['forumID']) : ""; 

        $insertQuery1 = "INSERT INTO `message`(`Content`, `Timestamp`, `SenderID`) VALUES ('$comment', NOW(), '$userID')";

        if(mysqli_query($connection, $insertQuery1)){
            $messageID = mysqli_insert_id($connection);

            $insertQuery2 = "INSERT INTO `forum_message`(`ForumID`, `MessageID`) VALUES ('$forumID','$messageID')";

            if(mysqli_query($connection, $insertQuery2)){
                echo '<script>';
                echo 'window.alert("Message Sent");';
                echo 'window.history.back();';
                echo '</script>';
            }
        }

    } else {
        echo '<script>';
        echo 'window.alert("Error: Required data not received.");';
        echo 'window.history.back();';
        echo '</script>';
    }
?>
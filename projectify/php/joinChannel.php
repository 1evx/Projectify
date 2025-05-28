<?php
    include "dbConn.php";
    global $connection;

    $channelCode = isset($_POST['txtcode']) ? mysqli_real_escape_string($connection, $_POST['txtcode']) : "";

    $userID = $_SESSION["userid"];
    $createChannel = "display: none";

    if (isset($_POST['btnJoinChannel'])) {
        $createChannel = "";
    } elseif (isset($_POST['btnJoinChannel2'])) {
        $fetchQuery1 = "SELECT * FROM `Channel` WHERE `ChannelCode` = '$channelCode'";
        $result1 = mysqli_query($connection, $fetchQuery1);
        if ($result1 && $row = mysqli_fetch_assoc($result1)) {
            $chanID = htmlspecialchars($row['ChanID'], ENT_QUOTES, 'UTF-8'); 
        }else{
            echo '<script>';
            echo 'window.alert("Invalid Channel Code");';
            echo 'window.location.href = "/projectify/studentchannel.php";';
            echo '</script>';
        }

        // Corrected the INSERT query by removing the extra comma
        $insertQuery1 = "INSERT INTO `user_channel` (`ChanID`, `MemberID`) VALUES ('$chanID', '$userID')";

        if (mysqli_query($connection, $insertQuery1)) {
            echo '<script>';
            echo 'window.alert("Join Successful!");';
            echo 'window.location.href = "/projectify/studentchannel.php";';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'window.alert("Invalid Channel Code");';
            echo 'window.location.href = "/projectify/studentchannel.php";';
            echo '</script>';
        }
        $createChannel = "display: none";
    }
?>

<?php
    include "dbConn.php";
    include "php/function.php";
    global $connection;

    $channelName = isset($_POST['txttitle']) ? mysqli_real_escape_string($connection, $_POST['txttitle']) : "";
    $channelDescription = isset($_POST['txtdescription']) ? mysqli_real_escape_string($connection, $_POST['txtdescription']) : "";
    $userID = $_SESSION["userid"];

    $createChannel = "display: none";

    if (isset($_POST['btnCreateChannel'])) {
        $createChannel = "";
    } elseif (isset($_POST['btnCreateChannel2'])) {

        // Insert new channel into the database
        $channelCode = getUniqueChannelCode($connection);

        $insertQuery1 = "INSERT INTO `channel`(`ChannelCode`, `Title`, `Description`,`OwnerID`) VALUES ('$channelCode', '$channelName', '$channelDescription','$userID')";

        if (mysqli_query($connection, $insertQuery1)) {
            $channelID = mysqli_insert_id($connection);
            $result = saveImage($_FILES["channelprofile"], 'ChanID', $channelID, $connection, 'Channel');
            if ($result === "Image updated successfully.") {
                echo '<script>';
                echo 'window.alert("Create Successful!");';
                echo 'window.location.href = "/projectify/lecturerchannel.php";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'window.alert("Error: ' . $result . '");';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error inserting channel: ' . mysqli_error($connection) . '");';
            echo '</script>';
        }
        $createChannel = "display: none";
    }
?>

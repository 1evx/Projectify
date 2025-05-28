<?php
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    if (isset($_POST['studID']) && isset($_POST['chanID'])) {
        $deleteID = mysqli_real_escape_string($connection, $_POST['studID']);
        $chanID = mysqli_real_escape_string($connection, $_POST['chanID']);

        if (!empty($deleteID) && !empty($chanID)) {
            $query = "DELETE FROM `User_Channel` WHERE `MemberID` = '$deleteID' AND `ChanID` = '$chanID'";

            if ($result = mysqli_query($connection, $query)) {
                echo '<script>';
                echo 'window.alert("Deletion Successful!");';
                echo 'window.location.href = "/projectify/lecturermember.php?channelID=' . $chanID . '";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'window.alert("Error deleting the record.");';
                echo 'window.location.href = "/projectify/lecturermember.php?channelID=' . $chanID . '";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error: User ID and Channel ID must not be empty.");';
            echo 'window.location.href = "/projectify/lecturermember.php?channelID=' . $chanID . '";';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'window.alert("Error: Required data not received.");';
        echo 'window.location.href = "/projectify/lecturermember.php?channelID=' . $chanID . '";';
        echo '</script>';
    }
?>

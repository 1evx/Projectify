<?php
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    if (isset($_POST['chanID'])) {
        $deleteID = mysqli_real_escape_string($connection, $_POST['chanID']);

        if (!empty($deleteID)) {
            $query = "DELETE FROM `Channel` WHERE `ChanID` = '$deleteID'";

            if ($result = mysqli_query($connection, $query)) {
                echo '<script>';
                echo 'window.alert("Deletion Successful!");';
                echo 'window.location.href = "/projectify/channel.php";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'window.alert("Error deleting the record.");';
                echo 'window.location.href = "/projectify/channel.php";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error: User ID must not be empty.");';
            echo 'window.location.href = "/projectify/channel.php";';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'window.alert("Error: Required data not received.");';
        echo 'window.location.href = "/projectify/channel.php";';
        echo '</script>';
    }
?>

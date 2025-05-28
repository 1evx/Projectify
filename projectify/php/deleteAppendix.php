<?php
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    if (isset($_POST['studID'])) {
        $deleteID = mysqli_real_escape_string($connection, $_POST['studID']);

        if (!empty($deleteID) && !empty($chanID)) {
            $query = "DELETE FROM `User` WHERE `MemberID` = '$deleteID'";

            if ($result = mysqli_query($connection, $query)) {
                echo '<script>';
                echo 'window.alert("Deletion Successful!");';
                echo 'window.location.href = "/projectify/admin.php";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'window.alert("Error deleting the record.");';
                echo 'window.location.href = "/projectify/admin.php";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error: User ID must not be empty.");';
            echo 'window.location.href = "/projectify/admin.php";';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'window.alert("Error: Required data not received.");';
        echo 'window.location.href = "/projectify/admin.php";';
        echo '</script>';
    }
?>

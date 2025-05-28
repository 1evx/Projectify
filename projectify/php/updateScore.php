<?php
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    if (isset($_POST['appendixID']) && isset($_POST['score'])) {
        $appendixID = mysqli_real_escape_string($connection, $_POST['appendixID']);
        $score = mysqli_real_escape_string($connection, $_POST['score']);

        if (!empty($appendixID) && !empty($score)) {
            $query = "UPDATE `User_Task` SET `Score` = '$score' WHERE `AppendixID` = '$appendixID'";

            if ($result = mysqli_query($connection, $query)) {
                echo '<script>';
                echo 'window.alert("Update Successful!");';
                echo 'window.location.href = "/projectify/report.php";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'window.alert("Error updating the score.");';
                echo 'window.location.href = "/projectify/report.php";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error: Appendix ID and score must not be empty.");';
            echo 'window.location.href = "/projectify/report.php";';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'window.alert("Error: Required data not received.");';
        echo 'window.location.href = "/projectify/report.php";';
        echo '</script>';
    }
?>

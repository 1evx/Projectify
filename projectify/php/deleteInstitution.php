<?php
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    if (isset($_POST['instID'])) {
        $deleteID = mysqli_real_escape_string($connection, $_POST['instID']);

        if (!empty($deleteID)) {
            $query = "DELETE FROM `Institution` WHERE `InstitutionID` = '$deleteID'";

            if ($result = mysqli_query($connection, $query)) {
                echo '<script>';
                echo 'window.alert("Deletion Successful!");';
                echo 'window.location.href = "/projectify/institution.php";'; // Add missing closing quote here
                echo '</script>';
            } else {
                echo '<script>';
                echo 'window.alert("Error deleting the record.");';
                echo 'window.location.href = "/projectify/institution.php";'; // Add missing closing quote here
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error: ID must not be empty.");';
            echo 'window.location.href = "/projectify/institution.php";'; // Add missing closing quote here
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'window.alert("Error: Required data not received.");';
        echo 'window.location.href = "/projectify/institution.php";'; // Add missing closing quote here
        echo '</script>';
    }
?>

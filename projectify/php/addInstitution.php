<?php
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['location'])) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $location = mysqli_real_escape_string($connection, $_POST['location']);

        if (!empty($name) && !empty($address) && !empty($location)) {
            $query = "INSERT INTO `institution`(`Name`, `Address`, `Location`) VALUES ('$name','$address','$location')";

            if ($result = mysqli_query($connection, $query)) {
                echo '<script>';
                echo 'window.alert("Upload Successful!");';
                echo 'window.location.href = "/projectify/institution.php";'; 
                echo '</script>';
            } else {
                echo '<script>';
                echo 'window.alert("Error uploading the record.");';
                echo 'window.location.href = "/projectify/institution.php";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error: ID must not be empty.");';
            echo 'window.location.href = "/projectify/institution.php";'; 
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'window.alert("Error: Required data not received.");';
        echo 'window.location.href = "/projectify/institution.php";';
        echo '</script>';
    }
?>

<?php
    include "dbConn.php";
    global $connection;

    $taskTitle = isset($_POST['txttitle']) ? mysqli_real_escape_string($connection, $_POST['txttitle']) : "";
    $taskDescription = isset($_POST['txtdescription']) ? mysqli_real_escape_string($connection, $_POST['txtdescription']) : "";
    $taskDeadline = isset($_POST['txtdeadline']) ? mysqli_real_escape_string($connection, $_POST['txtdeadline']) : ""; 

    $createTask = "display: none";

    if (isset($_POST['btnCreateAssignment'])) {
        $createTask = "";
    } elseif (isset($_POST['btnCreateAssignment2'])) {
        // Insert new task into the database
        $insertQuery1 = "INSERT INTO `task`(`Title`, `Description`, `Deadline`, `ChanID`) VALUES ('$taskTitle','$taskDescription', '$taskDeadline', '$channelID')";
        if (mysqli_query($connection, $insertQuery1)) {
            echo '<script>';
            echo 'window.alert("Create Successful!");';
            echo 'window.location.href = "/projectify/lecturerassignment.php?channelID=' . $channelID . '";';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'window.alert("Error inserting task: ' . mysqli_error($connection) . '");';
            echo '</script>';
        }
        $createTask = "display: none";
    }
?>
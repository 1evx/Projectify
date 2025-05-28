<?php
    include "dbConn.php";
    global $connection;

    $materialTitle = isset($_POST['txttitle']) ? mysqli_real_escape_string($connection, $_POST['txttitle']) : "";
    $materialDescription = isset($_POST['txtdescription']) ? mysqli_real_escape_string($connection, $_POST['txtdescription']) : "";

    $createMaterial = "display: none";

    if (isset($_POST['btnCreateMaterial'])) {
        $createMaterial = "";
    } elseif (isset($_POST['btnCreateMaterial2'])) {
        // Insert new material into the database
        $insertQuery1 = "INSERT INTO `material`(`Title`, `Description`, `ChanID`, `Timestamp`) VALUES ('$materialTitle','$materialDescription','$channelID', NOW())";
        if (mysqli_query($connection, $insertQuery1)) {
            $materialID = mysqli_insert_id($connection);

            $result = saveDocument($_FILES["material"], 'MaterialID', $materialID, $connection,'Material');

            if ($result === "File uploaded successfully.") {
                echo '<script>';
                echo 'window.alert("Create Successful!");';
                echo 'window.location.href = "/projectify/lecturermaterial.php?channelID=' . $channelID . '";';
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

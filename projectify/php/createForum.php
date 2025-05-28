<?php
    include "dbConn.php";
    include "php/function.php";
    global $connection;

    $createChannel = "display: none";
    $userID = $_SESSION["userid"];

    if (isset($_POST['createPost'])) {
        $createChannel = "";
    } elseif (isset($_POST['createPost2'])) {
        $postProfile = isset($_FILES['postprofile']) ? $_FILES['postprofile'] : null;
        $postTitle = isset($_POST['txttitle']) ? mysqli_real_escape_string($connection, $_POST['txttitle']) : "";
        $postDescription = isset($_POST['txtdescription']) ? mysqli_real_escape_string($connection, $_POST['txtdescription']) : "";

        // Insert into Forum table
        $insertQuery1 = "INSERT INTO `Forum`(`Topic`, `Content`, `Timestamp`, `HostID`) VALUES ('$postTitle', '$postDescription', NOW(), '$userID')";

        if (mysqli_query($connection, $insertQuery1)) {
            $forumID = mysqli_insert_id($connection);

            // Handle the image upload
            if ($postProfile) {
                $imageID = insertImage($postProfile, $connection);

                if (is_numeric($imageID)) {
                    // Update the Forum table with the ImageID
                    $updateQuery = "UPDATE `Forum` SET `ImageID` = '$imageID' WHERE `ForumID` = '$forumID'";
                    if (mysqli_query($connection, $updateQuery)) {
                        echo '<script>';
                        echo 'window.alert("Create Successful!");';
                        echo 'window.location.href = "/projectify/discussionforum.php";';
                        echo '</script>';
                    } else {
                        echo '<script>';
                        echo 'window.alert("Error updating forum with image: ' . mysqli_error($connection) . '");';
                        echo 'window.location.href = "/projectify/discussionforum.php";';
                        echo '</script>';
                    }
                } else {
                    echo '<script>';
                    echo 'window.alert("Error uploading image: ' . $imageID . '");';
                    echo 'window.location.href = "/projectify/discussionforum.php";';
                    echo '</script>';
                }
            } else {
                echo '<script>';
                echo 'window.alert("Create Successful!");';
                echo 'window.location.href = "/projectify/discussionforum.php";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error inserting forum: ' . mysqli_error($connection) . '");';
            echo 'window.location.href = "/projectify/discussionforum.php";';
            echo '</script>';
        }

        $createChannel = "display: none";
    }
?>

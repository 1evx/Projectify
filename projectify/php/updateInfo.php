<?php
session_start(); 
require_once(__DIR__ . '/../dbConn.php');
global $connection;

if (isset($_POST['btnUpdate'])) {
    $userID = $_SESSION['userid'];

    $updateFields = [];
    $params = [];
    $types = "";

    if (!empty($_POST['userName'])) {
        $updateFields[] = "Name = ?";
        $params[] = $_POST['userName'];
        $types .= "s";
    }
    if (!empty($_POST['userIC'])) {
        $updateFields[] = "IC = ?";
        $params[] = $_POST['userIC'];
        $types .= "s";
    }
    if (!empty($_POST['password'])) {
        $updateFields[] = "Password = ?";
        $params[] = $_POST['password'];
        $types .= "s";
    }
    if (!empty($_POST['studEmail'])) {
        $updateFields[] = "Email = ?";
        $params[] = $_POST['studEmail'];
        $types .= "s";
    }
    if (!empty($_POST['userAge'])) {
        $updateFields[] = "Age = ?";
        $params[] = $_POST['userAge'];
        $types .= "i";
    }
    if (!empty($_POST['gender'])) {
        $updateFields[] = "Gender = ?";
        $params[] = $_POST['gender'];
        $types .= "s";
    }

    // Handle image upload
    if (!empty($_FILES['imagePath']['name']) && !empty($_POST['imageID'])) {
        $imageID = $_POST['imageID'];
        $file = $_FILES['imagePath'];

        // Check if file is uploaded successfully
        if ($file["error"] == UPLOAD_ERR_OK) {
            $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxFileSize = 2 * 1024 * 1024; // 2 MB

            // Get file information
            $filename = basename($file["name"]);
            $tempname = $file["tmp_name"];
            $filetype = $file["type"];
            $filesize = $file["size"];
        
            // Check if the file type is allowed
            if (!in_array($filetype, $allowedFileTypes)) {
                echo '<script>';
                echo 'window.alert("Error: Only JPG, PNG, and GIF files are allowed.");';
                echo 'window.location.href = "/projectify/setting.php";';
                echo '</script>';
                exit;
            }
    
            // Check if the file size is within the limit
            if ($filesize > $maxFileSize) {
                echo '<script>';
                echo 'window.alert("Error: File size exceeds the 2 MB limit.");';
                echo 'window.location.href = "/projectify/setting.php";';
                echo '</script>';
                exit;
            }

            // Ensure the upload directory exists
            $upload_dir = __DIR__ . "/../userdata/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
        
            // Generate a unique name for the file to avoid overwriting
            $uniqueFilename = uniqid() . "_" . $filename;
            $folder = $upload_dir . $uniqueFilename;
            $formattedfilename = "userdata/" . $uniqueFilename;

            if (move_uploaded_file($tempname, $folder)) {
                // Update image table
                $updateImageQuery = "UPDATE `Image` SET `Filename` = ?, `Filepath` = ? WHERE `ImageID` = ?";
                $stmtImage = $connection->prepare($updateImageQuery);
                $stmtImage->bind_param("ssi", $filename, $formattedfilename, $imageID);
                $stmtImage->execute();

                if ($stmtImage->affected_rows > 0) {
                    $updateFields[] = "ImageID = ?";
                    $params[] = $imageID;
                    $types .= "i";
                } else {
                    echo '<script>';
                    echo 'window.alert("Error updating image data in the database.");';
                    echo 'window.location.href = "/projectify/setting.php";';
                    echo '</script>';
                    exit;
                }

                $stmtImage->close();
            } else {
                echo '<script>';
                echo 'window.alert("Error moving uploaded file.");';
                echo 'window.location.href = "/projectify/setting.php";';
                echo '</script>';
                exit;
            }
        } else {
            echo '<script>';
            echo 'window.alert("Error uploading file.");';
            echo 'window.location.href = "/projectify/setting.php";';
            echo '</script>';
            exit;
        }
    }

    // Only proceed if there are fields to update
    if (!empty($updateFields)) {
        $query = "UPDATE `USER` SET " . implode(", ", $updateFields) . " WHERE `UserID` = ?";
        $params[] = $userID;
        $types .= "s";

        $stmt = $connection->prepare($query);

        // Prepare the statement dynamically
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        echo '<script>';
        echo 'window.alert("Data updated successfully.");';
        echo 'window.location.href = "/projectify/setting.php";';
        echo '</script>';
        $stmt->close();
    } else {
        echo '<script>';
        echo 'window.alert("No fields to update.");';
        echo 'window.location.href = "/projectify/setting.php";';
        echo '</script>';
    }

    $connection->close();
}
?>

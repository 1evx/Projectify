<?php
    include 'dbConn.php';
    global $connection;

    //Update Image To Database
    function saveImage($file, $columnname, $userID, $connection, $tableName) {
        // Define allowed file types and maximum file size (in bytes)
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2 MB
    
        if (!empty($file["name"])) {
            $filename = $file["name"];
            $tempname = $file["tmp_name"];
            $filetype = $file["type"];
            $filesize = $file["size"];
    
            // Check if the file type is allowed
            if (!in_array($filetype, $allowedFileTypes)) {
                return "Error: Only JPG, PNG, and GIF files are allowed.";
            }
    
            // Check if the file size is within the limit
            if ($filesize > $maxFileSize) {
                return "Error: File size exceeds the 2 MB limit.";
            }
    
            // Generate a unique name for the file to avoid overwriting
            $uniqueFilename = uniqid() . "_" . basename($filename);
            $folder = "./userdata/" . $uniqueFilename;
            $formattedfilename = "userdata/" . $uniqueFilename;
    
            // Execute the query that needs to run before the file is moved
            $query = "INSERT INTO `Image` (`Filename`, `Filepath`, `Uploaddate`) VALUES ('Profile', '$formattedfilename', CURRENT_TIMESTAMP)";
    
            if (mysqli_query($connection, $query)) {
                // Move the uploaded file to the target folder
                if (move_uploaded_file($tempname, $folder)) {
                    // Fetch the last inserted ImageID using LAST_INSERT_ID()
                    $imageID = mysqli_insert_id($connection);
    
                    if ($imageID) {
                        $updateQuery = "UPDATE `$tableName` SET `ImageID` = '$imageID' WHERE `$columnname` = $userID";
                        if (mysqli_query($connection, $updateQuery)) {
                            return "Image updated successfully.";
                        } else {
                            return "Error updating table $tableName: " . mysqli_error($connection);
                        }
                    } else {
                        return "Error fetching image ID: " . mysqli_error($connection);
                    }
                } else {
                    return "Error: Failed to upload file.";
                }
            } else {
                return "Error executing initial query: " . mysqli_error($connection);
            }
        } else {
            return "No file uploaded.";
        }
    }
    
    //Insert Image To Database
    function insertImage($file, $connection) {
        // Define allowed file types and maximum file size (in bytes)
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2 MB
    
        if (!empty($file["name"])) {
            $filename = $file["name"];
            $tempname = $file["tmp_name"];
            $filetype = $file["type"];
            $filesize = $file["size"];
    
            // Check if the file type is allowed
            if (!in_array($filetype, $allowedFileTypes)) {
                return "Error: Only JPG, PNG, and GIF files are allowed.";
            }
    
            // Check if the file size is within the limit
            if ($filesize > $maxFileSize) {
                return "Error: File size exceeds the 2 MB limit.";
            }
    
            // Generate a unique name for the file to avoid overwriting
            $uniqueFilename = uniqid() . "_" . basename($filename);
            $folder = "./userdata/" . $uniqueFilename;
            $formattedfilename = "userdata/" . $uniqueFilename;
    
            // Execute the query to insert the image data
            $query = "INSERT INTO `Image` (`Filename`, `Filepath`, `Uploaddate`) VALUES ('Profile', '$formattedfilename', CURRENT_TIMESTAMP)";
    
            if (mysqli_query($connection, $query)) {
                // Move the uploaded file to the target folder
                if (move_uploaded_file($tempname, $folder)) {
                    // Fetch the last inserted ImageID using LAST_INSERT_ID()
                    $imageID = mysqli_insert_id($connection);
                    if ($imageID) {
                        return $imageID; // Return the ImageID
                    } else {
                        return "Error fetching image ID: " . mysqli_error($connection);
                    }
                } else {
                    return "Error: Failed to upload file.";
                }
            } else {
                return "Error executing initial query: " . mysqli_error($connection);
            }
        } else {
            return "No file uploaded.";
        }
    }
    
    //Update Document To Database
    function saveDocument($file, $columnname, $materialID ,$connection, $tableName) {
        // Check if file is uploaded successfully
        if ($file["error"] == UPLOAD_ERR_OK) {
            // Get file information
            $file_name = $file["name"];
            $file_type = $file["type"];
            $file_size = $file["size"];
            $file_tmp_name = $file["tmp_name"];
    
            // Move uploaded file to desired location
            $upload_dir = "userdata/";
            $destination = $upload_dir . $file_name;
            if (move_uploaded_file($file_tmp_name, $destination)) {
                // Insert file information into database
                $updateQuery = "UPDATE `$tableName` SET `Filename` = '$file_name', `Filetype` = '$file_type', `Filesize` = '$file_size', `Filecontent` = '$destination' WHERE `$columnname` = '$materialID'";

                if (mysqli_query($connection, $updateQuery)) {
                    return "File uploaded successfully.";
                } else {
                    return "Error: " . mysqli_error($conn);
                }
            } else {
                return "Error uploading file.";
            }
        } else {
            return "Please select a file to upload.";
        }
    }
    
    function generateRandomChannelCode($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function getUniqueChannelCode($connection) {
        $isUnique = false;
        while (!$isUnique) {
            $channelCode = generateRandomChannelCode();
            $checkQuery = "SELECT COUNT(*) as count FROM `channel` WHERE `ChannelCode` = '$channelCode'";
            $result = mysqli_query($connection, $checkQuery);
            $row = mysqli_fetch_assoc($result);
            if ($row['count'] == 0) {
                $isUnique = true;
            }
        }
        return $channelCode;
    }
?>
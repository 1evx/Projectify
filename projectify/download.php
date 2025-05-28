<?php
    // Ensure the filename is provided
    if (isset($_GET['filename'])) {
        // Fetch the filename from the URL parameter
        $filename = $_GET['filename'];

        // Define the file path
        $filepath = 'userdata/' . $filename;

        // Check if the file exists
        if (file_exists($filepath)) {
            // Set the appropriate headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            // Read the file and output its contents
            readfile($filepath);
            // Exit the script
            exit;
        } else {
            // If the file doesn't exist, output an error message
            echo 'File not found.';
        }
    } else {
        // If the filename parameter is not provided, output an error message
        echo 'Filename parameter is missing.';
    }
?>

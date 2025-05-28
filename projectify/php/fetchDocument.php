<?php 
    include "dbConn.php";

    // Fetch materials from the database
    $fetchQuery = "SELECT * FROM `Material` WHERE `ChanID` = '$channelID' ORDER BY `Timestamp` ASC";
    $result = mysqli_query($connection, $fetchQuery);

    // Process each material
    while ($row = mysqli_fetch_assoc($result)) {
        $title = htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8');
        $filename = htmlspecialchars($row['Filename'], ENT_QUOTES, 'UTF-8');
        $filetype = htmlspecialchars($row['Filetype'], ENT_QUOTES, 'UTF-8');
        $filesize = $row['Filesize'];

        // Determine the appropriate icon based on file type
        $icon = '';
        switch ($filetype) {
            case 'application/pdf':
                $icon = 'pdf.png';
                break;
            case 'application/msword':
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            case 'application/vnd.openxmlformats-officedocument.word':
                $icon = 'word.png';
                break;
            default:
                $icon = 'file.png';
                break;
        }

        // Format file size for better readability
        $filesizeUnits = array('B', 'KB', 'MB', 'GB', 'TB');
        $size = $filesize; // Rename $filesize to $size
        $unitIndex = 0;
        while ($size >= 1024 && $unitIndex < count($filesizeUnits) - 1) {
            $size /= 1024;
            $unitIndex++;
        }
        $formattedFileSize = round($size, 2) . ' ' . $filesizeUnits[$unitIndex];

        // Output HTML for each material
        echo '
        <div class="material2">
            <h1>'.$title.'</h1>
            <p>'.$description.'</p>
            <div class="material-container">
                <div class="material-panel">
                    <a href="download.php?filename='.$filename.'">
                        <img src="image/'.$icon.'" alt="'.$filetype.'">
                    </a>
                    <span>'.$formattedFileSize.'</span>
                </div>
            </div>
        </div>
        ';
    }
?>
<?php 
    include "dbConn.php";

    // Fetch materials from the database
    $fetchQuery = "SELECT * FROM `Task` WHERE `ChanID` = '$channelID' ORDER BY `Deadline` ASC";
    $result = mysqli_query($connection, $fetchQuery);

    // Process each material
    while ($row = mysqli_fetch_assoc($result)) {
        $title = htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8');
        $deadline = htmlspecialchars($row['Deadline'], ENT_QUOTES, 'UTF-8');

        // Output HTML for each material
        echo '
        <div class="material2">
            <h1>'.$title.'</h1>
            <p>'.$description.'</p>
            <q>Deadline: '.$deadline.'</q>
            <div class="material-container">
                <div class="material-panel" onclick="displayMessage1()">
                    <img src="image/upload.png"><img>
                </div>
            </div>
        </div>
        ';
    }
?>
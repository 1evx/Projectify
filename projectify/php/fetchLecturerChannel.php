<?php
include "dbConn.php";
global $connection;

$userID = $_SESSION["userid"];

$fetchQuery1 = "SELECT * FROM `Channel` WHERE `OwnerID` = '$userID'";
$result1 = mysqli_query($connection, $fetchQuery1);

if ($result1) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $channelID = htmlspecialchars($row['ChanID'], ENT_QUOTES, 'UTF-8');
        $channelName = htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8');
        $imageID = htmlspecialchars($row['ImageID'], ENT_QUOTES, 'UTF-8');
        
        $fetchQuery2 = "SELECT * FROM `Image` WHERE `ImageID` = '$imageID'";
        $result2 = mysqli_query($connection, $fetchQuery2);

        if ($result2) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $imagePath = htmlspecialchars($row['Filepath'], ENT_QUOTES, 'UTF-8');
                echo '<a style="text-decoration: none;" href="lecturermaterial.php?channelID=' . $channelID . '">';
                echo '<div class="channel-container" data-chanid="' . $channelID . '">';
                echo '<img class="menu-image" src="image/Menu.png" alt="Default Menu">';
                echo '<img src="'.$imagePath.'" alt="Default Image">';
                echo '<h1>' . $channelName . '</h1>';
                echo '</div>';
                echo '</a>';
            }
        }
    }
}
?>

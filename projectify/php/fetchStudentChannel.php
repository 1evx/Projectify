<?php
include "dbConn.php";
global $connection;

$userID = $_SESSION["userid"];

$fetchQuery1 = "SELECT * FROM `User_Channel` WHERE `MemberID` = '$userID'";
$result1 = mysqli_query($connection, $fetchQuery1);

if ($result1) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $channelID = htmlspecialchars($row1['ChanID'], ENT_QUOTES, 'UTF-8');
        
        $fetchQuery2 = "SELECT * FROM `Channel` WHERE `ChanID` = '$channelID'";
        $result2 = mysqli_query($connection, $fetchQuery2);
        
        if ($result2) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $channelName = htmlspecialchars($row2['Title'], ENT_QUOTES, 'UTF-8');
                $imageID = htmlspecialchars($row2['ImageID'], ENT_QUOTES, 'UTF-8');

                $fetchQuery3 = "SELECT * FROM `Image` WHERE `ImageID` = '$imageID'";
                $result3 = mysqli_query($connection, $fetchQuery3);
                
                if ($result3) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $imagePath = htmlspecialchars($row3['Filepath'], ENT_QUOTES, 'UTF-8');
                        echo '<a style="text-decoration: none;" href="studentmaterial.php?channelID=' . $channelID . '">';
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
    }
}
?>

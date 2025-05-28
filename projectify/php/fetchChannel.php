<?php
    include "dbConn.php";
    global $connection, $channelID, $channelName, $imagePath;

    $fetchQuery1 = "SELECT * FROM `Channel` WHERE `ChanID` = '$channelID'";
    $result1 = mysqli_query($connection, $fetchQuery1);
    if ($result1 && $row = mysqli_fetch_assoc($result1)) {
        $channelID = htmlspecialchars($row['ChanID'], ENT_QUOTES, 'UTF-8');
        $channelCode = htmlspecialchars($row['ChannelCode'], ENT_QUOTES, 'UTF-8');
        $channelName = htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8');
        $imageID = htmlspecialchars($row['ImageID'], ENT_QUOTES, 'UTF-8');
        $ownerID = htmlspecialchars($row['OwnerID'], ENT_QUOTES, 'UTF-8');

        $fetchQuery2 = "SELECT * FROM `Image` WHERE `ImageID` = '$imageID'";
        $result2 = mysqli_query($connection, $fetchQuery2);
        if ($result2 && $row = mysqli_fetch_assoc($result2)) {
            $imagePath = htmlspecialchars($row['Filepath'], ENT_QUOTES, 'UTF-8');
        }

        $fetchQuery3 = "SELECT * FROM `User` WHERE `UserID` = '$ownerID'";
        $result3 = mysqli_query($connection, $fetchQuery3);
        if ($result3 && $row = mysqli_fetch_assoc($result3)) {
            $userName = htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8');
        }

        $query = "SELECT COUNT(*) as total FROM `User_Channel` WHERE `ChanID` = '$channelID'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalOfMember = $row['total'];
        }
    }
?>
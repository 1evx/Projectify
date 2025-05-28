<?php
    include "dbConn.php";
    global $connection;

    $userID = $_SESSION["userid"];

    $fetchQuery1 = "SELECT * FROM `User` WHERE `UserID` = '$userID'";
    $result1 = mysqli_query($connection, $fetchQuery1);
    if ($result1 && $row = mysqli_fetch_assoc($result1)) {
        $userImageID = htmlspecialchars($row['ImageID'], ENT_QUOTES, 'UTF-8');
    }

    $fetchQuery2 = "SELECT * FROM `Image` WHERE `ImageID` = '$userImageID'";
    $result2 = mysqli_query($connection, $fetchQuery2);
    if ($result2 && $row = mysqli_fetch_assoc($result2)) {
        $userImagePath = htmlspecialchars($row['Filepath'], ENT_QUOTES, 'UTF-8');
    }

    $fetchQuery3 = "
    SELECT COUNT(*) AS taskNumber
    FROM `User_Channel` uc
    INNER JOIN `Task` t ON uc.ChanID = t.ChanID
    INNER JOIN `User_Task` ut on ut.`TaskID` = t.`TaskID`
    INNER JOIN `Appendix` a on a.`AppendixID` = ut.`AppendixID`
    WHERE uc.`MemberID` = '$userID' AND a.`UserID` = '$userID' AND ut.`Status` IS NULL AND t.`TaskID` IS NOT NULL;
    ";
    $result3 = mysqli_query($connection, $fetchQuery3);
    if ($result3) {
        $row = mysqli_fetch_assoc($result3);
        $totalOfAssignment = $row['taskNumber'];
    }

    $fetchQuery4 = "
    SELECT COUNT(*) AS channelNumber
    FROM `User_Channel`
    WHERE `MemberID` = '$userID';
    ";
    $result4 = mysqli_query($connection, $fetchQuery4);
    if ($result4) {
        $row = mysqli_fetch_assoc($result4);
        $totalOfChannel = $row['channelNumber'];
    }

    $fetchQuery5 = "
    SELECT COUNT(*) AS numberSubmission
    FROM `User_Channel` uc
    INNER JOIN `Task` t ON uc.ChanID = t.ChanID
    INNER JOIN `User_Task` ut on ut.`TaskID` = t.`TaskID`
    INNER JOIN `Appendix` a on a.`AppendixID` = ut.`AppendixID`
    WHERE uc.`MemberID` = '$userID' AND a.`UserID` = '$userID' AND ut.`Status` IS NOT NULL AND t.`TaskID` IS NOT NULL;
    ";
    $result5 = mysqli_query($connection, $fetchQuery5);
    if ($result5) {
        $row = mysqli_fetch_assoc($result5);
        $totalOfSubmission = $row['numberSubmission'];
    }

?>
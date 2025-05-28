<?php
    $fetchQuery = "
    SELECT *
    FROM `User_Channel` uc
    INNER JOIN `Task` t ON uc.ChanID = t.ChanID
    INNER JOIN `User_Task` ut ON ut.`TaskID` = t.`TaskID`
    INNER JOIN `Appendix` a ON a.`AppendixID` = ut.`AppendixID`
    WHERE uc.`MemberID` = '$userID' 
    AND a.`UserID` = '$userID' 
    AND t.`TaskID` IS NOT NULL
    AND t.`Deadline` > NOW()
    ORDER BY t.`Deadline` ASC
    ";

    $result = mysqli_query($connection, $fetchQuery);

    $rows = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }

    echo '<div class="milestones2">';
    
    foreach ($rows as $row) {
        $deadline = htmlspecialchars($row['Deadline'], ENT_QUOTES, 'UTF-8');
        echo '
        <div class="milestones3">
            <div class="mile1">
                <div class="miledate">' . $deadline . '</div>
            </div>
            <p>' . $taskName . '</p>
        </div>
        ';
    }

    echo '</div>';
?>

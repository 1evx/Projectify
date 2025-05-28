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
    AND t.`Deadline` > NOW();
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
        <table class="duedatetable">
            <tr>
                <th>Assignment</th>
                <th>Deadline</th>
            </tr>
        ';

        // Iterate through the result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {
            $taskName = htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8');
            $deadline = htmlspecialchars($row['Deadline'], ENT_QUOTES, 'UTF-8');

            echo '
            <tr>
                <td>' . $taskName . '</td>
                <td>' . $deadline . '</td>
            </tr>
            ';
        }

        echo '</table>';
    }
?>
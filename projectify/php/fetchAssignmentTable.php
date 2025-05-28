<?php
    $fetchQuery = "
    SELECT 
    i.`Filepath` as ChannelImage,
    c.`Title` as ChannelName,
    c.`ChannelCode` as ChannelCode,
    t.`Title` as TaskTitle,
    t.`Deadline` as Deadline
    FROM `User_Channel` uc
    INNER JOIN `Task` t ON uc.ChanID = t.ChanID
    INNER JOIN `User_Task` ut ON ut.`TaskID` = t.`TaskID`
    INNER JOIN `Appendix` a ON a.`AppendixID` = ut.`AppendixID`
    INNER JOIN `Channel` c ON c.ChanID = uc.ChanID
    INNER JOIN `Image` i ON i.`ImageID` = c.`ImageID`
    WHERE uc.`MemberID` = '$userID' 
    AND a.`UserID` = '$userID' 
    AND t.`TaskID` IS NOT NULL
    AND t.`Deadline` > NOW();
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
          <table class="tasktable">
            <tr>
              <th>Channel</th>
              <th>Assignment</th>
              <th>Due Date</th>
            </tr>
        ';

        // Iterate through the result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {
            $channelImage = htmlspecialchars($row['ChannelImage'], ENT_QUOTES, 'UTF-8');
            $channelName = htmlspecialchars($row['ChannelName'], ENT_QUOTES, 'UTF-8');
            $channelCode = htmlspecialchars($row['ChannelCode'], ENT_QUOTES, 'UTF-8');
            $taskTitle = htmlspecialchars($row['TaskTitle'], ENT_QUOTES, 'UTF-8');
            $deadline = htmlspecialchars($row['Deadline'], ENT_QUOTES, 'UTF-8');

            echo '
            <tr>
              <td class="column1">
                <img class="channel" src='.$channelImage.'></img>
                <div class="detail">
                  <h1>'.$channelName.'<h1>
                  <p>'.$channelCode.'<p>
                </div>
              </td>
              <td>'.$taskTitle.'</td>
              <td>'.$deadline.'</td>
            </tr>
            ';
        }

        echo '</table>';
    }
?>
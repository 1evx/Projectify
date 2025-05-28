<?php
    $fetchQuery = "
    SELECT 
    i.`Filepath` as ChannelImage,
    c.`Title` as ChannelName,
    c.`ChannelCode` as ChannelCode,
    t.`Title` as TaskTitle,
    a.`AppendixID` as AppendixID,
    a.`Filename` as Submission,
    ut.`Status` as Status,
    ut.`Score` as Score
    FROM `User_Channel` uc
    INNER JOIN `Task` t ON uc.ChanID = t.ChanID
    INNER JOIN `User_Task` ut ON ut.`TaskID` = t.`TaskID`
    INNER JOIN `Appendix` a ON a.`AppendixID` = ut.`AppendixID`
    INNER JOIN `Channel` c ON c.ChanID = uc.ChanID
    INNER JOIN `Image` i ON i.`ImageID` = c.`ImageID`
    WHERE a.`UserID` = '$userID' 
    AND ut.`Score` IS NOT NULL;
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
          <table class="tasktable1">
            <tr>
              <th>Channel</th>
              <th>Task Title</th>
              <th>Appendix ID</th>
              <th>Appendix Name</th>
              <th>Status</th>
              <th>Score</th>
            </tr>
        ';

        // Iterate through the result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {
            $channelImage = htmlspecialchars($row['ChannelImage'], ENT_QUOTES, 'UTF-8');
            $channelName = htmlspecialchars($row['ChannelName'], ENT_QUOTES, 'UTF-8');
            $channelCode = htmlspecialchars($row['ChannelCode'], ENT_QUOTES, 'UTF-8');
            $taskTitle = htmlspecialchars($row['TaskTitle'], ENT_QUOTES, 'UTF-8');
            $appendID = htmlspecialchars($row['AppendixID'], ENT_QUOTES, 'UTF-8');
            $submission = htmlspecialchars($row['Submission'], ENT_QUOTES, 'UTF-8');
            $status = htmlspecialchars($row['Status'], ENT_QUOTES, 'UTF-8');
            $score = htmlspecialchars($row['Score'], ENT_QUOTES, 'UTF-8');

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
              <td>'.$appendID.'</td>
              <td>'.$submission.'</td>
              <td>'.$status.'</td>
              <td>'.$score.'</td>
            </tr>
            ';
        }

        echo '</table>';
    }
?>
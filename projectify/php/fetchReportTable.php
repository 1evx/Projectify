<?php
    $userID = $_SESSION['userid'];

    $fetchQuery = "
    SELECT 
    i.`Filepath` as ChannelImage,
    c.`Title` as ChannelName,
    c.`ChannelCode` as ChannelCode,
    u.`Name` as StudentName,
    u.`IC` as StudentIC,
    t.`Title` as TaskTitle,
    a.`Filename` as Submission,
    a.`Timestamp` as SubmissionDate,
    t.`Deadline` as Deadline,
    ut.`Score` as Score,
    ut.`AppendixID` as AppendixID
    FROM User_Task ut
    INNER JOIN Task t ON ut.`TaskID` = t.`TaskID`
    INNER JOIN Channel c ON c.`ChanID` = t.`ChanID`
    INNER JOIN `Image` i ON i.`ImageID` = c.`ImageID`
    INNER JOIN `Appendix` a ON a.`AppendixID` = ut.`AppendixID`
    INNER JOIN `User` u ON u.`UserID` = a.`UserID`
    WHERE c.`OwnerID` = '$userID'
    ORDER BY t.`Deadline` ASC 
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
          <table class="tasktable">
            <tr>
              <th>Channel</th>
              <th>Student Name</th>
              <th>Student IC</th>
              <th>Assignment</th>
              <th>Submission</th>
              <th>Submission Date</th>
              <th>Due Date</th>
              <th>Score</th>
            </tr>
        ';

        // Iterate through the result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {

            $channelImage = htmlspecialchars($row['ChannelImage'], ENT_QUOTES, 'UTF-8');
            $channelName = htmlspecialchars($row['ChannelName'], ENT_QUOTES, 'UTF-8');
            $channelCode = htmlspecialchars($row['ChannelCode'], ENT_QUOTES, 'UTF-8');
            $studName = htmlspecialchars($row['StudentName'], ENT_QUOTES, 'UTF-8');
            $studIC = htmlspecialchars($row['StudentIC'], ENT_QUOTES, 'UTF-8');
            $taskTitle = htmlspecialchars($row['TaskTitle'], ENT_QUOTES, 'UTF-8');
            $submission = htmlspecialchars($row['Submission'], ENT_QUOTES, 'UTF-8');
            $submissionDate = htmlspecialchars($row['SubmissionDate'], ENT_QUOTES, 'UTF-8');
            $deadline = htmlspecialchars($row['Deadline'], ENT_QUOTES, 'UTF-8');
            $score = htmlspecialchars($row['Score'], ENT_QUOTES, 'UTF-8');
            $appendixID = htmlspecialchars($row['AppendixID'], ENT_QUOTES, 'UTF-8');

            echo '
            <tr>
              <td class="column1">
                <img class="channel" src="'.$channelImage.'" />
                <div class="detail">
                  <h1>'.$channelName.'</h1>
                  <p>'.$channelCode.'</p>
                </div>
              </td>
              <td>'.$studName.'</td>
              <td>'.$studIC.'</td>
              <td>'.$taskTitle.'</td>
              <td><a href="download.php?filename='.$submission.'">'.$submission.'</a></td>
              <td>'.$submissionDate.'</td>
              <td>'.$deadline.'</td>
              <td>
                <form action="php/updateScore.php" method="POST">
                  <div class="columndisplay">
                    <input type="hidden" name="appendixID" value="'.$appendixID.'" />
                    <input type="text" name="score" value="'.$score.'" />
                    <input type="submit" name="btnSubmitScore" value="Update" />
                  </div>
                </form>
              </td>
            </tr>
            ';
        }

        echo '</table>';
    }
?>
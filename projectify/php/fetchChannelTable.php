<?php    
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    $userID = $_SESSION["userid"];

    $fetchQuery = "
    SELECT 
    c.`ChanID` as ChannelID,
    i.`Filepath` as ChannelImage,
    c.`ChannelCode` as ChannelCode,
    c.`Title` as ChannelTitle,
    c.`OwnerID` as OwnerID,
    u.`Name` as OwnerName
    FROM `Channel` c 
    INNER JOIN `Image` i ON i.`ImageID` = c.`ImageID`
    INNER JOIN `User` u ON u.`UserID` = c.`OwnerID`
    WHERE c.`OwnerID` = '$userID'
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
          <table class="tasktable">
            <tr>
              <th>Channel Image</th>
              <th>Channel Code</th>
              <th>Channel Title</th>
              <th>Owner ID</th>
              <th>Owner Name</th>
              <th>Status</th>
            </tr>
        ';

        // Iterate through the result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {

            $chanID = htmlspecialchars($row['ChannelID'], ENT_QUOTES, 'UTF-8');
            $chanImage = htmlspecialchars($row['ChannelImage'], ENT_QUOTES, 'UTF-8');
            $chanCode = htmlspecialchars($row['ChannelCode'], ENT_QUOTES, 'UTF-8');
            $chanTitle = htmlspecialchars($row['ChannelTitle'], ENT_QUOTES, 'UTF-8');
            $ownerID = htmlspecialchars($row['OwnerID'], ENT_QUOTES, 'UTF-8');
            $ownerName = htmlspecialchars($row['OwnerName'], ENT_QUOTES, 'UTF-8');

            echo '
            <tr>
              <td><img src="'.$chanImage.'"></img></td>
              <td>'.$chanCode.'</td>
              <td>'.$chanTitle.'</td>
              <td>'.$ownerID.'</td>
              <td>'.$ownerName.'</td>
              <td>
                <form action="php/deleteChannel.php" method="POST">
                  <div class="columndisplay">
                    <input type="hidden" name="chanID" value="'.$chanID.'" />
                    <input type="submit" name="btnDelete" value="Delete" />
                  </div>
                </form>
              </td>
            </tr>
            ';
        }

        echo '</table>';
    }
?>
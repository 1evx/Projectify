<?php    
    $channelID = $_GET['channelID'];
    $userID = $_SESSION["userid"];

    $fetchQuery = "
    SELECT 
    ui.`UserID` as StudentID,
    i.`Filepath` as StudentImage,
    u.`Name` as StudentName,
    u.`IC` as StudentIC,
    u.`Email` as StudentEmail,
    it.`Name` as StudentInstitution
    FROM `User_Channel` uc
    INNER JOIN `Channel` c ON c.`ChanID` = uc.`ChanID`
    INNER JOIN `User` u ON uc.`MemberID` = u.`UserID`
    INNER JOIN `User_Institution` ui ON ui.`UserID` = u.`UserID`
    INNER JOIN `Institution` it ON it.`InstitutionID` = ui.`InstitutionID`
    INNER JOIN `Image` i ON i.`ImageID` = u.`ImageID`
    WHERE c.`OwnerID` = '$userID' AND c.`ChanID` = '$channelID'
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
          <table class="tasktable">
            <tr>
              <th>Student Image</th>
              <th>Student Name</th>
              <th>Student IC</th>
              <th>Student Email</th>
              <th>Institution</th>
              <th>Status</th>
            </tr>
        ';

        // Iterate through the result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {

            $studID = htmlspecialchars($row['StudentID'], ENT_QUOTES, 'UTF-8');
            $studImage = htmlspecialchars($row['StudentImage'], ENT_QUOTES, 'UTF-8');
            $studName = htmlspecialchars($row['StudentName'], ENT_QUOTES, 'UTF-8');
            $studIC = htmlspecialchars($row['StudentIC'], ENT_QUOTES, 'UTF-8');
            $studEmail = htmlspecialchars($row['StudentEmail'], ENT_QUOTES, 'UTF-8');
            $studInstitution = htmlspecialchars($row['StudentInstitution'], ENT_QUOTES, 'UTF-8');

            echo '
            <tr>
              <td><img src="'.$studImage.'"></img></td>
              <td>'.$studName.'</td>
              <td>'.$studIC.'</td>
              <td>'.$studEmail.'</td>
              <td>'.$studInstitution.'</td>
              <td>
                <form action="php/deleteMember.php" method="POST">
                  <div class="columndisplay">
                    <input type="hidden" name="studID" value="'.$studID.'" />
                    <input type="hidden" name="chanID" value="'.$channelID.'" />
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
<?php    
    $userID = $_SESSION["userid"];

    $fetchQuery = "
    SELECT 
    u.`UserID` as StudentID,
    i.`Filepath` as StudentImage,
    u.`Name` as StudentName,
    u.`IC` as StudentIC,
    u.`Email` as StudentEmail,
    u.`Password` as Password,
    it.`Name` as StudentInstitution
    FROM `User` u 
    INNER JOIN `User_Institution` ui ON ui.`UserID` = u.`UserID`
    INNER JOIN `Institution` it ON it.`InstitutionID` = ui.`InstitutionID`
    INNER JOIN `Image` i ON i.`ImageID` = u.`ImageID`
    WHERE u.`RoleID` != \"1\";
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
          <table class="tasktable1">
            <tr>
              <th>User Image</th>
              <th>User Name</th>
              <th>User IC</th>
              <th>User Email</th>
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
            $status = htmlspecialchars($row['Password'], ENT_QUOTES, 'UTF-8');
            $studInstitution = htmlspecialchars($row['StudentInstitution'], ENT_QUOTES, 'UTF-8');

            if($status=="BANNED"){
              echo '
              <tr>
                <td><img src="'.$studImage.'"></img></td>
                <td>'.$studName.'</td>
                <td>'.$studIC.'</td>
                <td>'.$studEmail.'</td>
                <td>'.$studInstitution.'</td>
                <td>
                  <form action="php/unbanUser.php" method="POST">
                    <div class="columndisplay">
                      <input type="hidden" name="studID" value="'.$studID.'" />
                      <input type="hidden" name="chanID" value="'.$channelID.'" />
                      <input type="submit" name="btnDelete" value="Banned" />
                    </div>
                  </form>
                </td>
              </tr>
              ';
            }else{
              echo '
              <tr>
                <td><img src="'.$studImage.'"></img></td>
                <td>'.$studName.'</td>
                <td>'.$studIC.'</td>
                <td>'.$studEmail.'</td>
                <td>'.$studInstitution.'</td>
                <td>
                  <form action="php/banUser.php" method="POST">
                    <div class="columndisplay">
                      <input type="hidden" name="studID" value="'.$studID.'" />
                      <input type="hidden" name="chanID" value="'.$channelID.'" />
                      <input style="background-color:green;" type="submit" name="btnDelete" value="Unban" />
                    </div>
                  </form>
                </td>
              </tr>
              ';
            }
        }

        echo '</table>';
    }
?>
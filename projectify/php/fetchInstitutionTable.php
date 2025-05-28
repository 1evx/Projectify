<?php
    $fetchQuery = "
    SELECT *
    FROM Institution 
    ORDER BY InstitutionID ASC;
    ";
    
    $result = mysqli_query($connection, $fetchQuery);

    // Check if the query was successful
    if ($result) {
        echo '
          <table class="tasktable2">
            <tr>
              <th>Institution ID</th>
              <th>Institution Name</th>
              <th>Address</th>
              <th>Location</th>
              <th>Tool</th>
            </tr>
        ';

        // Iterate through the result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {

            $insID = htmlspecialchars($row['InstitutionID'], ENT_QUOTES, 'UTF-8');
            $insName = htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8');
            $insAddress = htmlspecialchars($row['Address'], ENT_QUOTES, 'UTF-8');
            $insLocation = htmlspecialchars($row['Location'], ENT_QUOTES, 'UTF-8');

            echo '
            <tr>

              <td>'.$insID.'</td>
              <td>'.$insName.'</td>
              <td>'.$insAddress.'</td>
              <td>'.$insLocation.'</td>
              <td>
                <form action="php/deleteInstitution.php" method="POST">
                  <div class="columndisplay">
                    <input type="hidden" name="instID" value="'.$insID.'" />
                    <input type="submit" name="btnDelete" value="Delete" />
                  </div>
                </form>
              </td>
            </tr>
            ';
        }

        echo '
        <tr>
          <form action="php/addInstitution.php" method="POST">
            <td></td>
            <td>
              <div class="columndisplay">
                <input type="text" name="name" placeholder="Institution Name" autocomplete="off"/>
              </div>
            </td>
            <td>
              <div class="columndisplay">
                <input type="text" name="location" placeholder="Institution Location" autocomplete="off"/>
              </div>
            </td>
            <td>
              <div class="columndisplay">
                <input type="text" name="address" placeholder="Institution Address" autocomplete="off"/>
              </div>
            </td>
            <td>
              <div class="columndisplay">
                <input type="submit" name="btnAdd" value="Add" />
              </div>
            </td>
          </form>
        </tr>
        ';

        echo '</table>';
    }
?>
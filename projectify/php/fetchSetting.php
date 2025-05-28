<?php
    include "dbConn.php";
    global $connection;

    $userID = $_SESSION['userid'];
    $userType = $_SESSION['usertype'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM `User`u INNER JOIN `Image`i ON u.`ImageID` = i.`ImageID` WHERE u.`UserID` = ?");
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            $userID = htmlspecialchars($row['UserID'], ENT_QUOTES, 'UTF-8');
            $userName = htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8');
            $userIC = htmlspecialchars($row['IC'], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($row['Password'], ENT_QUOTES, 'UTF-8');
            $studEmail = htmlspecialchars($row['Email'], ENT_QUOTES, 'UTF-8');
            $userAge = htmlspecialchars($row['Age'], ENT_QUOTES, 'UTF-8');
            $gender = htmlspecialchars($row['Gender'], ENT_QUOTES, 'UTF-8');
            $imagePath = htmlspecialchars($row['Filepath'], ENT_QUOTES, 'UTF-8');
            $imageID = htmlspecialchars($row['ImageID'], ENT_QUOTES, 'UTF-8');

            echo'
            <div class="setting1">
                <div class="setting2">
                    <p>Name</p>
                    <input type="text" name="userName" placeholder="' . $userName . '"></input>
                </div>
                <div class="setting2">
                    <p>IC Number</p>
                    <input type="text" name="userIC" placeholder="' . $userIC . '"></input>
                </div>
                <div class="setting2">
                    <p>Password</p>
                    <input type="text" name="password" placeholder="' . $password . '"></input>
                </div>
                <div class="setting2">
                    <p>Email</p>
                    <input type="text" name="studEmail" placeholder="' . $studEmail . '"></input>
                </div>
                <div class="setting2">
                    <p>Age</p>
                    <input type="text" name="userAge" placeholder="' . $userAge . '"></input>
                </div>
                <div class="setting2">
                    <p>Gender</p>
                    <select id="gender" name="gender">
                        <option value="" placeholder="' . $gender . '" disabled selected>Gender: ' . $gender . '</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="prefer-not-to-say">Prefer not to say</option>
                    </select>
                </div>
                <div class="setting3">
                    <p>Image</p>
                    <img src="'.$imagePath.'" style="width: 100px; height: auto; border-radius: 10px; margin-bottom: 3%"></img>
                    <input type="hidden" class="hidden_input" name="imageID" value="'.$imageID.'"></input>
                    <input type="file" class="submit_button" name="imagePath"></input>
                </div>
            </div>
                <input type="submit" name="btnUpdate" value="Update">
            ';
        } else {
            echo "No user found with the given ID.";
        }
    } else {
        echo "Error executing query: " . $connection->error;
    }

    $stmt->close();
    $connection->close();
?>

<?php 
    include "dbConn.php";
    global $connection, $icon;
    $channelID = $_GET['channelID'];
    $userID = $_SESSION["userid"];

    // Fetch tasks from the database
    $fetchQuery1 = "SELECT * FROM `Task` WHERE `ChanID` = '$channelID' ORDER BY `Deadline` ASC";
    $result1 = mysqli_query($connection, $fetchQuery1);

    // Process each task
    while ($row = mysqli_fetch_assoc($result1)) {
        $title = htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8');
        $deadline = htmlspecialchars($row['Deadline'], ENT_QUOTES, 'UTF-8');
        $taskID = $row['TaskID']; 

        // Check if the user has submitted the task
        $fetchQuery2 = "
        SELECT ut.*, a.*
        FROM `User_Task` ut
        JOIN `Appendix` a ON ut.AppendixID = a.AppendixID
        WHERE ut.TaskID = '$taskID' AND a.UserID = '$userID'
        ";
        $result2 = mysqli_query($connection, $fetchQuery2);
        $row2 = mysqli_fetch_assoc($result2);
        $status = ($row2) ? htmlspecialchars($row2['Status'], ENT_QUOTES, 'UTF-8') : ''; 
        $appendixID = ($row2) ? htmlspecialchars($row2['AppendixID'], ENT_QUOTES, 'UTF-8') : ''; 
        $filename = ($row2) ? htmlspecialchars($row2['Filename'], ENT_QUOTES, 'UTF-8') : ''; 
        $filetype = ($row2) ? htmlspecialchars($row2['Filetype'], ENT_QUOTES, 'UTF-8') : ''; 

        // Determine the appropriate icon based on file type
        $icon = '';
        switch ($filetype) {
            case 'application/pdf':
                $icon = 'pdf.png';
                break;
            case 'application/msword':
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            case 'application/vnd.openxmlformats-officedocument.word':
                $icon = 'word.png';
                break;
            default:
                $icon = 'empty.png';
                break;
        }

        // Determine the appropriate HTML based on the status
        if ($status == "Submitted") {
            echo '
            <div class="material2">
                <h1>'.$title.'</h1>
                <p>'.$description.'</p>
                <p>Deadline: '.$deadline.'</p>
                <div class="material-container">
                    <div class="material-panel" style="margin-right: 1%;" onclick="triggerFileInput(\''.$taskID.'\')">
                        <img src="image/'.$icon.'" alt="'.$filetype.'">
                        <span>'.$filename.'</span>
                    </div>
                    <form id="form'.$taskID.'" action="" method="POST" enctype="multipart/form-data" style="text-decoration: none; visibility: hidden;">
                        <input type="hidden" name="channelID" value="'.$channelID.'">
                        <input type="hidden" name="taskID" value="'.$taskID.'">
                        <input type="hidden" name="oldAppendixID" value="'.$appendixID.'">
                        <div style="display: flex; flex-direction: column;">
                            <input type="file" name="updateFile" id="fileInput'.$taskID.'" required style="display: none;" onchange="submitForm(\''.$taskID.'\')">
                            <input type="submit" name="btnUpdateFile" id="submitBtn'.$taskID.'" style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            ';
        } else {
            echo '
            <div class="material2">
                <h1>'.$title.'</h1>
                <p>'.$description.'</p>
                <p>Deadline: '.$deadline.'</p>
                <div class="material-container">
                    <div class="material-panel" style="margin-right: 1%;" onclick="triggerFileInput2()">
                        <img style="max-height: 55px; width: auto;" src="image/'.$icon.'" alt="'.$filetype.'">
                        <span style="font-size: 12px;">No Submission</span>
                    </div>
                    <div>
                        <form id="form2" action="" method="POST" enctype="multipart/form-data" style="text-decoration: none; visibility: hidden;">
                            <input type="hidden" name="channelID" value="'.$channelID.'">
                            <input type="hidden" name="userID" value="'.$userID.'">
                            <input type="hidden" name="taskID" value="'.$taskID.'">
                            <div style="display: flex; flex-direction: column;">
                                <input type="file" id="uploadFile2" name="uploadFile" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required style="display: none;" onchange="submitForm2()">
                                <input type="submit" name="btnUploadFile" id="submitBtn2" style="display: none;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            ';
        }
    }

    if (isset($_POST['btnUpdateFile'])) {
        $taskID = isset($_POST['taskID']) ? mysqli_real_escape_string($connection, $_POST['taskID']) : "";
        $oldAppendixID = isset($_POST['oldAppendixID']) ? mysqli_real_escape_string($connection, $_POST['oldAppendixID']) : "";

        $query1 = "INSERT INTO Appendix(`Timestamp`, `UserID`) VALUES (Now(),'$userID')";
            if (mysqli_query($connection, $query1)) {
                $appendixID = mysqli_insert_id($connection);
                saveDocument($_FILES["updateFile"], 'AppendixID', $appendixID, $connection,'Appendix');

                $query2 = "UPDATE user_task SET AppendixID = '$appendixID' WHERE TaskID = '$taskID' AND AppendixID = '$oldAppendixID'";
                if (mysqli_query($connection, $query2)) {
                    echo '<script>';
                    echo 'window.alert("Update Successful!");';
                    echo 'window.location.href = "/projectify/studentassignment.php?channelID=' . $channelID . '";';
                    echo '</script>';
                }
            } else {
            echo '<script>';
            echo 'window.alert("Error inserting into user_task: ' . mysqli_error($connection) . '");';
            echo 'window.location.href = "/projectify/studentassignment.php?channelID=' . $channelID . '";';
            echo '</script>';
        }
        exit();
    }

    if (isset($_POST['btnUploadFile'])) {
        $taskID = isset($_POST['taskID']) ? mysqli_real_escape_string($connection, $_POST['taskID']) : "";
        $userID = isset($_POST['userID']) ? mysqli_real_escape_string($connection, $_POST['userID']) : "";

        $query1 = "INSERT INTO Appendix(`Timestamp`, `UserID`) VALUES (Now(),'$userID')";
            if (mysqli_query($connection, $query1)) {
                $appendixID = mysqli_insert_id($connection);
                saveDocument($_FILES["uploadFile"], 'AppendixID', $appendixID, $connection,'Appendix');

                $query2 = "INSERT INTO user_task (TaskID, AppendixID, Status) VALUES ('$taskID', '$appendixID', 'Submitted')";
                if (mysqli_query($connection, $query2)) {
                    echo '<script>';
                    echo 'window.alert("Upload Successful!");';
                    echo 'window.location.href = "/projectify/studentassignment.php?channelID=' . $channelID . '";';
                    echo '</script>';
                }
            } else {
            echo '<script>';
            echo 'window.alert("Error inserting into user_task: ' . mysqli_error($connection) . '");';
            echo 'window.location.href = "/projectify/studentassignment.php?channelID=' . $channelID . '";';
            echo '</script>';
        }
        exit();
    }
?>
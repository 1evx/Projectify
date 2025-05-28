<?php 
    session_start();
    $channelID = $_GET['channelID'];
    include "php/function.php";
    include "php/fetchChannel.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Channel</title>
    <link rel="stylesheet" href="css/channel.css">
    <link rel="stylesheet" href="css/assignment.css">
    <script src="javascript/function.js" defer></script>
    <script>
        // Prevent Form Resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function triggerFileInput(taskID) {
            var fileInput = document.getElementById('fileInput' + taskID);
            console.log('Triggering file input for taskID:', taskID, 'Element:', fileInput);
            if (fileInput) {
                fileInput.click();
            } else {
                console.error('File input not found for taskID:', taskID);
            }
        }

        function submitForm(taskID) {
            var submitBtn = document.getElementById('submitBtn' + taskID);
            console.log('Submitting form for taskID:', taskID, 'Element:', submitBtn);
            if (submitBtn) {
                submitBtn.click();
            } else {
                console.error('Submit button not found for taskID:', taskID);
            }
        }

        function triggerFileInput2() {
            var fileInput = document.getElementById("uploadFile2");
            if (fileInput) {
                fileInput.click();
            } else {
                console.error("File input not found.");
            }
        }

        function submitForm2() {
            var submitBtn2 = document.getElementById("submitBtn2");
            if (submitBtn2) {
                submitBtn2.click();
            } else {
                console.error("Submit button not found.");
            }
        }    
    </script>
</head>
<body>
    <div class="main1">
        <div class="HeaderBox1">
            <img src="image/Setting2.png" alt="Settings2" class="Setting2">
            <img src="image/bell.png" alt="bell" class="bell">
            <input type="text" name="search_bar" placeholder="Search" class="search_bar1">
            <img src="image/search_tool.png" alt="search tool" class="search_tool1">
        </div>
        
        <div class="choice">
            <button style="cursor: pointer; border:none; background-color: transparent;" onclick="redirectTo('studentchannel.php')" id="backbutton">
                <img class="back" src="image/back.png" />
            </button>
            <div class="title">
                <img src="image/whitelogo.png" alt="">
                <h1>Projectify</h1>
            </div>
            <div class="blackbox1"></div>
            <div class="photo">
                <img class="profile-frame" src="<?php echo $imagePath; ?>" >
            </div>

            <p class="course"><?php echo $channelName; ?></p>
            <p class="info">Lecturer: <?php echo $userName; ?></p>
            <p class="info">Student: <?php echo $totalOfMember ?></p>

            <div class="line"></div>

            <a href="studentmaterial.php?channelID=<?php echo $channelID; ?>"><img src="image/controlpanel.png" alt="Icon"/>Material</a>
            <a href="studentassignment.php?channelID=<?php echo $channelID; ?>"><img src="image/classroom.png" alt="Icon"/>Assignment</a>
        </div>

        <div class="panel1">
            <div class="channels_head">
                <h1>Assignments</h1>
                <div class="thin_line1"></div>
            </div>
            <div class="material1">
                <?php include "php/fetchTask2.php"; ?>
            </div>
        </div>
    </div>    
</body>
</html>

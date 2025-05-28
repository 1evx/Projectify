<?php 
    session_start();
    $channelID = $_GET['channelID'];
    include "php/function.php";
    include "php/createTask.php";
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
    <title>Post Assignment</title>
    <link rel="stylesheet" href="css/channel.css">
    <link rel="stylesheet" href="css/LecturerAssignment.css">
    <script src="javascript/function.js" defer></script>
    <script>
        //Prevent Form Resubmission
        if ( window.history.replaceState ) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>
    <div class="main1">
    <div class="HeaderBox">
    <img src="image/Setting2.png" alt="Settings2" class="Setting2">
        <img src="image/bell.png" alt="bell" class="bell">
        <input type="text" name="search_bar" placeholder="Search" class="search_bar1">
        <img src="image/search_tool.png" alt="search tool" class="search_tool1">
        </input>
    </div>
        <div class="choice">
            <button style="cursor: pointer; border:none; background-color: transparent;" onclick="redirectTo('lecturerchannel.php')" id="backbutton">
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
            <p class="info">Channel Code: <?php echo $channelCode; ?></p>
            <p class="info">Student: <?php echo $totalOfMember ?></p>

            <div class="line"></div>

            <a href="lecturermaterial.php?channelID=<?php echo $channelID; ?>"><img src="image/controlpanel.png" alt="Icon"/>Material</a>
            <a href="lecturerassignment.php?channelID=<?php echo $channelID; ?>"><img src="image/classroom.png" alt="Icon"/>Assignment</a>
            <a href="lecturermember.php?channelID=<?php echo $channelID; ?>"><img src="image/member.png" alt="Icon"/>Member</a>
        </div>

        <div class="panel1"> 
        <div class="channels_head">
                <h1>Assignments</h1>
                <div class="thin_line1">
            </div>
            <div class="material1">
                <form action="" method="POST" >
                    <button name="btnCreateAssignment" class="hidden_button" style="cursor: pointer; border:none; background-color: white;">
                        <img class="export" src="image/export.png" />
                    </button>
                    <?php include "php/fetchTask.php"; ?>
                </form>
            </div>
        </div>

        <div style="<?php echo $createTask; ?>" class="createMaterialContainer">
            <a href="javascript:history.go(-1);" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <div class="back_box"></div>
            <form action="" method="POST" enctype="multipart/form-data">
                <h1>Create Assignment</h1>
                <span>Post Task For Evaluation</span>
                <input name="txttitle" placeholder="Task Title" required>
                <textarea name="txtdescription" placeholder="Task Description" required></textarea>
                <input type="date" name="txtdeadline" placeholder="Task Deadline" required>
                <button name="btnCreateAssignment2">Upload Assignment</button>
            </form>
        </div>

    </div>    
</body>
</html>


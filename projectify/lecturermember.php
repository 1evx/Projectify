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
    <link rel="stylesheet" href="css/member.css">
    <link rel="stylesheet" href="css/mainframe.css">
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
    <div class="HeaderBox1">
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
            <img src="image/whitelogo.png" alt="" class="displaced_logo">
                <h2>Projectify</h2>
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
                <h1>Member</h1>
                <div class="thin_line1"></div>
            </div>
            <div class="assignment1">
                <div class = "assignment2">
                    <?php include "php/fetchChannelMemberTable.php" ?>
                </div>
            </div>

        </div>

    </div>    
</body>
</html>
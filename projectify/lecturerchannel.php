<?php 
    session_start();
    include "php/createChannel.php"; 
    include "php/fetchLecInfo.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
    <script src="javascript/function.js" defer></script>
    <link rel="stylesheet" href="css/mainframe.css">
    <link rel="stylesheet" href="css/lecturerchannel.css">
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
        <input type="text" name="search_bar" placeholder="Search" class="search_bar">
            <img src="image/search_tool.png" alt="search tool" class="search_tool">
        </input>
    </div>
        <div class="choice">
            <div class="title">
                <img src="image/whitelogo.png" alt="">
                <h1>Projectify</h1>
            </div>
            <div class="blackbox1"></div>
            <div class="photo">
                <img class="profile-frame" src="image/photoframe.png" />
                <img class="user-frame" src="<?php echo $userImagePath; ?>" />
            </div>
            <p class="username"><?php echo $_SESSION['username']; ?></p>
            <p class="institution"><?php echo $_SESSION['institutionname']; ?></p>
            <div class="line"></div>

            <button onclick="redirectTo('lecturer.php')"><img src="image/controlpanel.png" alt="Icon"/>Dashboard</button>
            <button onclick="redirectTo('lecturerchannel.php')"><img src="image/classroom.png" alt="Icon"/>Channel</button>
            <button onclick="redirectTo('chat.php')"><img src="image/chat.png" alt="Icon"/>Chat</button>
            <button onclick="redirectTo('channel.php')"><img src="image/appendix.png" alt="Icon"/>Manage</button>
            <button onclick="redirectTo('report.php')"><img src="image/course.png" alt="Icon"/>Report</button>
            <button onclick="redirectTo('discussionforum.php')"><img src="image/forums.png" alt="Icon"/>Forum</button>
            <button onclick="redirectTo('setting.php')"><img src="image/setting.png" alt="Icon"/>Setting</button>
            <button onclick="logout()"><img src="image/exit.png" alt="Icon"/>Log Out</button>
        </div>

        <div class="panel">
        <div class="channels_head"></div>
        <div class="thin_line"></div>
            <div class="channel1">
                <form action="" method="POST" >
                    <div class="channel2">
                        <h1>Channels</h1>
                    </div>
                    <button name="btnCreateChannel">
                        <img src="image/add.png" alt="Add Channel" style="display: block;">
                    </button>
                    <img src="image/Menu2.png" alt="Menu display" class="Menu_display">
                    <div class="channel3">
                        <?php include "php/fetchLecturerChannel.php"; ?>
                    </div>
                </form>
            </div>
        </div>

        <div style="<?php echo $createChannel; ?>" class="createChannelContainer">
            <div class="back_box"></div>
            <a href="javascript:history.go(-1);" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <form id="signUpFormTwo" action="" method="POST" enctype="multipart/form-data">
                <h1>Create Your Channel</h1>
                <span>Customize Your Channel</span>
                <input class="input" id="input" type="file" accept="image/jpeg, image/png, image/jpg" name="channelprofile" required>
                <input name="txttitle" placeholder="Channel Name" required>
                <textarea name="txtdescription" placeholder="Channel Description" required></textarea>
                <button name="btnCreateChannel2">Create</button>
            </form>
        </div>
        
    </div>
</body>
</html>
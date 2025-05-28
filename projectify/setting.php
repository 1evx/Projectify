<?php 
  session_start();
  include "dbConn.php";
  include "php/fetchStudInfo.php";
  
  $currentUserID = $_SESSION['userid']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="javascript/function.js" defer></script>
  <link rel="stylesheet" href="css/mainframe.css">
  <link rel="stylesheet" href="css/setting.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Settings</title>
  <script>
      //Prevent Form Resubmission
      if ( window.history.replaceState ) {
          window.history.replaceState(null, null, window.location.href);
      }
    </script>
</head>
<body>
  <div class="main1">  <div class="HeaderBox">
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

    <?php 
      $usertype = $_SESSION['usertype'];

      if($usertype == "student"){
        echo '
        <button onclick="redirectTo(\'student.php\')"><img src="image/controlpanel.png" alt="Icon"/>Dashboard</button>
        <button onclick="redirectTo(\'studentchannel.php\')"><img src="image/classroom.png" alt="Icon"/>Channel</button>
        <button onclick="redirectTo(\'chat.php\')"><img src="image/chat.png" alt="Icon"/>Chat</button>
        <button onclick="redirectTo(\'discussionforum.php\')"><img src="image/forums.png" alt="Icon"/>Forum</button>
        <button onclick="redirectTo(\'setting.php\')"><img src="image/Setting2.png" alt="Icon"/>Setting</button>
        <button onclick="logout()"><img src="image/exit.png" alt="Icon"/>Log Out</button>
        ';
      } elseif($usertype == "lecturer"){
          echo '
        <button onclick="redirectTo(\'lecturer.php\')"><img src="image/controlpanel.png" alt="Icon"/>Dashboard</button>
        <button onclick="redirectTo(\'lecturerchannel.php\')"><img src="image/classroom.png" alt="Icon"/>Channel</button>
        <button onclick="redirectTo(\'chat.php\')"><img src="image/chat.png" alt="Icon"/>Chat</button>
        <button onclick="redirectTo(\'channel.php\')"><img src="image/appendix.png" alt="Icon"/>Manage</button>
        <button onclick="redirectTo(\'report.php\')"><img src="image/course.png" alt="Icon"/>Report</button>
        <button onclick="redirectTo(\'discussionforum.php\')"><img src="image/forums.png" alt="Icon"/>Forum</button>
        <button onclick="redirectTo(\'setting.php\')"><img src="image/setting.png" alt="Icon"/>Setting</button>
        <button onclick="logout()"><img src="image/exit.png" alt="Icon"/>Log Out</button>
          ';
      } elseif($usertype == "admin"){
          echo '
          <button onclick="redirectTo(\'admin.php\')"><img src="image/controlpanel.png" alt="Icon"/>User</button>
          <button onclick="redirectTo(\'adminappendix.php\')"><img src="image/appendix.png" alt="Icon"/>Appendix</button>
          <button onclick="redirectTo(\'institution.php\')"><img src="image/classroom.png" alt="Icon"/>Institution</button>
          <button onclick="redirectTo(\'chat.php\')"><img src="image/chat.png" alt="Icon"/>Chat</button>
          <button onclick="redirectTo(\'discussionforum.php\')"><img src="image/forums.png" alt="Icon"/>Forum</button>
          <button onclick="redirectTo(\'setting.php\')"><img src="image/setting.png" alt="Icon"/>Setting</button>
          <button onclick="logout()"><img src="image/exit.png" alt="Icon"/>Log Out</button>
          ';
      }
    ?>
    </div>

    <div class="panel">
      <div class="channels_head">
        <h1>Settings</h1>
      </div>
      <div class="thin_line"></div>

      <form action="php/updateInfo.php" method="POST" enctype="multipart/form-data">
        <?php include "php/fetchSetting.php"; ?>
      </form>
    </div>    

  </div>
</body>
</html>
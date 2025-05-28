<?php 
  session_start(); 
  include "php/fetchChannel.php";
  include "php/fetchAdminInfo.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="javascript/function.js" defer></script>
  <link rel="stylesheet" href="css/mainframe.css">
  <link rel="stylesheet" href="css/member.css">
  <title>Admin</title>
</head>
<body>
<div class="main1">
  <div class="HeaderBox1">
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

      <button onclick="redirectTo('admin.php')"><img src="image/controlpanel.png" alt="Icon"/>User</button>
      <button onclick="redirectTo('adminappendix.php')"><img src="image/appendix.png" alt="Icon"/>Appendix</button>
      <button onclick="redirectTo('institution.php')"><img src="image/classroom.png" alt="Icon"/>Institution</button>
      <button onclick="redirectTo('chat.php')"><img src="image/chat.png" alt="Icon"/>Chat</button>
      <button onclick="redirectTo('discussionforum.php')"><img src="image/forums.png" alt="Icon"/>Forum</button>
      <button onclick="redirectTo('setting.php')"><img src="image/setting.png" alt="Icon"/>Setting</button>
      <button onclick="logout()"><img src="image/exit.png" alt="Icon"/>Log Out</button>
    </div>

    <div class="panel1">
      <div class="channels_head">
        <h1>User</h1>
      </div>
      <div class="thin_line"></div>
        <div class="assignment1">
            <div class = "assignment2">
                <?php include "php/fetchUserTable.php" ?>
            </div>
        </div>
    </div>    
  </div>
</body>
</html>
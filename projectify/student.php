<?php 
  session_start(); 
  include "php/fetchChannel.php";
  include "php/fetchStudInfo.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="javascript/function.js" defer></script>
  <link rel="stylesheet" href="css/mainframe.css">
  <link rel="stylesheet" href="css/student.css">
  <title>Student Dashboard</title>
</head>
<body>
<div class="main">
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

      <button onclick="redirectTo('student.php')"><img src="image/controlpanel.png" alt="Icon"/>Dashboard</button>
      <button onclick="redirectTo('studentchannel.php')"><img src="image/classroom.png" alt="Icon"/>Channel</button>
      <button onclick="redirectTo('chat.php')"><img src="image/chat.png" alt="Icon"/>Chat</button>
      <button onclick="redirectTo('discussionforum.php')"><img src="image/forums.png" alt="Icon"/>Forum</button>
      <button onclick="redirectTo('setting.php')"><img src="image/Setting2.png" alt="Icon"/>Setting</button>
      <button onclick="logout()"><img src="image/exit.png" alt="Icon"/>Log Out</button>
    </div>

    <div class="panel">

      <div class="overview1">
        <h1>Overview</h1>

        <div class="overview2">
          <div class="over1">
            <div class="over1row1">
              <img src="image/schedule.png"></img>
              <div class="over1column2">
                <p>Assignment</p>
                <p>Due Date:</p>
              </div>
              <div class="blue_line1"></div>
            </div>
            <div class="over1row2">
              <?php include "php/fetchTaskTable.php"; ?>
            </div>
          </div>

          <div class="overview3">
            <div class="over2">
              <img src="image/choice.png"></img>
              <div class="over2column2">
                <p>Assignment: </p>
                <p class="assignmentnumber"><?php echo $totalOfAssignment; ?></p>
              </div>
              <div class="blue_line2"></div>
            </div>
            <div class="over3">
              <img src="image/classroom2.png"></img>
              <div class="over3column2">
                <p>Channel: </p>
                <p class="channelnumber"><?php echo $totalOfChannel; ?></p>
              </div>
              <div class="blue_line3"></div>
            </div>
          </div>

          <div class="over4">
            <div class="over4row1">
              <img src="image/submitted.png"></img>
              <div class="over4column2">
                <p>Assignment</p>
                <p>Submitted:</p>
              </div>
            </div>
            <p class="subWork"><?php echo $totalOfSubmission; ?></p>
            <div class="blue_line4"></div>
          </div>

        </div>
      </div>

      <div class="milestones1">
        <h1>Milestones</h1>
        <div class="milestones-container">
          <?php include "php/fetchMilestone.php"; ?>
        <div>
      </div>
      </div>

      <div class="assignment1">
        <h1>Assignment Lists</h1>
        <div class = "assignment2">
          <?php include "php/fetchAssignmentTable.php"; ?>
        </div>
      </div>

      <div class="assignment1">
        <h1>Submission Grades</h1>
        <div class = "assignment2">
          <?php include "php/fetchGradeTable.php"; ?>
        </div>
      </div>

    </div>    
  </div>
</body>
</html>
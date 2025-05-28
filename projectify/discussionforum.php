<?php
  session_start();
  include "php/createForum.php";
  include "php/fetchStudInfo.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/forum.css">
  <link rel="stylesheet" href="css/mainframe.css">
  <script src="javascript/function.js" defer></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <title>Discussion Forum</title>
  <script>
    //Prevent Form Resubmission
    if ( window.history.replaceState ) {
      window.history.replaceState(null, null, window.location.href);
    }

    // Select all textarea elements within the form and clear their content
    function handleCancel() {
      document.querySelectorAll('form textarea').forEach(function(textarea) {
        textarea.value = '';
      });
    }
  </script>
</head>
<body>
<div class="main1">
<div class="HeaderBox1">
    <img src="image/Setting2.png" alt="Settings2" class="Setting2">
    <img src="image/bell.png" alt="bell" class="bell">
    <input type="text" name="search_bar" placeholder="Search" class="search_bar1">
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
    <div class="channels_head1">
      <h1>Forums</h1>
    </div>
    <div class="thin_line"></div>
    <div class="container">
      <div class="response-group">

        <header>
          <h2>
            <strong>Discussion Forum</strong><i class="fa fa-angle-right"></i><span class="header-dropdown-trigger">Tools</span>
          </h2>
        </header>

        <div class="header-dropdown">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="panel2">
              <ul>
                <li>
                  <input type="submit" name="createPost" value="Create Post" class="btn btn-create"></input>
                  <input type="submit" name="viewOwn" value="View Your Post" class="btn btn-view-own"></input>
                  <input type="submit" name="viewAll" value="View All Post" class="btn btn-view-all"></input>
                </li>
              </ul>
            </div>
          </form>
        </div>

        <div class="responses">
          <?php include "php/fetchForum.php"; ?>
        </div>
      </div>
    </div>
  <div>
    
  <div style="<?php echo $createChannel; ?>" class="createChannelContainer">
  <div class="back_box"></div>
  <a href="javascript:history.go(-1);" class="back-icon"><i class="fas fa-arrow-left"></i></a>
  <form action="" method="POST" enctype="multipart/form-data">
    <h1>Create Your Post</h1>
    <span>Customize Your Post</span>
    <div class="file-input-container">
      <input class="input" id="input" name="postprofile" type="file" accept="image/jpeg, image/png, image/jpg" required style="display: none;">
      <button type="button" class="custom-file-button">Choose File</button>
      <span id="file-name">No file chosen</span>
    </div>
    <input name="txttitle" placeholder="Post Question Title" required>
    <textarea name="txtdescription" placeholder="Post Question Content" required></textarea>
    <button name="createPost2">Create Post</button>
  </form>
</div>


<script>
    $( ".header-dropdown-trigger" ).click(function() {
    $( this ).toggleClass( "active" );
    $( ".header-dropdown" ).toggleClass( "expand" );
    });

    $( ".header-dropdown li" ).click(function() {
    $( ".header-dropdown-trigger" ).removeClass( "active" );
    $( ".header-dropdown" ).removeClass( "expand" );
    });

    $( ".button--approve" ).click(function() {
    $( this ).toggleClass( "active" );
    $( this ).siblings( '.button--deny' ).removeClass( "active" );
    });

    $( ".button--deny" ).click(function() {
    $( this ).toggleClass( "active" );
    $( this ).siblings( '.button--approve' ).removeClass( "active" );
    });

    $( ".comment-trigger" ).click(function() {
    $( this ).parent().parent().toggleClass( "post--commenting" );
    });

    $( ".button--flag" ).click(function() {
    $( this ).parent().parent().toggleClass( "post--commenting" );
    });


    $( ".button--confirm" ).click(function() {
    $( this ).parent().parent().parent().parent().parent().toggleClass( "post--commenting" );
    });

    $( ".button.cancel" ).click(function() {
    $( this ).parent().parent().parent().parent().parent().toggleClass( "post--commenting" );
    });
</script>
</body>
</html>
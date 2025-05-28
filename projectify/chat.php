<?php 
    session_start();
    include "php/fetchStudInfo.php";

    $currentUserID = $_SESSION['userid']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainframe.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Chat</title>
    <script src="javascript/function.js" defer></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#userForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: 'php/sendMessage.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        // Clear the input field after successful submission
                        $('input[name="message"]').val('');

                        // Refresh the message container
                        var selectedUserID = $('#messageUser').val(); 
                        fetchMessages(selectedUserID);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Handle change event for messageUser select element
            $('#messageUser').change(function() {
                var selectedImage = $(this).find('option:selected').data('image');
                $('#userImage').attr('src', selectedImage);

                var selectedUserID = $(this).val(); 
                fetchMessages(selectedUserID);
            });

            // Fetch messages function
            function fetchMessages(selectedUserID) {
                $.ajax({
                    url: 'php/fetchMessage.php',
                    method: 'POST',
                    data: { selectedUserID: selectedUserID },
                    success: function(response) {
                        $('#messageContainer').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });


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
                <h1>Chat</h1>
            </div>
        <div class="thin_line"></div>
            <form action="" method="post" enctype="multipart/form-data" id="userForm">
                <!-- Main container  -->
                <img src="image/Menu.png" alt="" class="Menu_img">
                <div class="container">
                    <!-- Message header section starts -->
                    <div class="msg-header">
                        <div class="container1">
                            <div class="user-select">
                                <img id="userImage" src="image/default.png" class="msgimg">
                                <div class="active">
                                    <select name="messageUser" id="messageUser" required class="white-text">
                                        <?php 
                                            $query2 = "
                                            SELECT * 
                                            FROM `User` u
                                            INNER JOIN `Image` i ON u.`ImageID` = i.`ImageID`
                                            WHERE u.`UserID` != '$currentUserID'";
                                            $result2 = mysqli_query($connection, $query2);

                                            if ($result2) {
                                                echo '<option value="" data-image="image/default.png">Select User</option>';
                                                while ($row = mysqli_fetch_assoc($result2)) {
                                                    $targetID = htmlspecialchars($row['UserID'], ENT_QUOTES, 'UTF-8');
                                                    $userName = htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8');
                                                    echo '<option value="'.$targetID.'" data-image="'.$row['Filepath'].'">'.$userName.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div> 
                    <!-- Message header section ends -->

                    <!-- Chat inbox section starts -->
                    <div class="chat-page">
                        <div class="msg-inbox">
                            <div class="chats">
                                <div class="msg-page" id="messageContainer">
                                    <!-- Received message -->
                                    <!-- Contains the incoming and outgoing messages -->
                                    <!--fetchMessage.php-->
                                    <!--fetchMessages()-->
                                </div> 
                            </div>
                            
                            <!-- Message bottom section starts -->
                            <div class="msg-bottom">
                                <div class="input-group">
                                    <input type="hidden" name="receiverID" value="<?php echo $chatPartnerID; ?>">
                                    <input type="text" name="message" class="form-control highlight-on-focus input" placeholder="Write message..." required>
                                    <span class="underline"></span>
                                    <div class="input-group-append">
                                        <button name="btnSubmitMessage" type="submit" class="input-group-text send-icon">
                                            <img id="sendimage" src="image/send.png" class="sendimg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Message bottom section ends -->

                        </div>
                    </div>
                    <!-- Chat inbox section ends -->
                </div>
                <!-- Main container ends -->
            </form>
        <div>
    </div>
</body>
<script>
    let input = document.querySelector('.input');
    let underline = document.querySelector('.underline');

    input.onfocus = function(){
        underline.style.width = '100%';
    }

    input.onblur = function(){
        underline.style.width = '0%';
    }
</script>

</html>

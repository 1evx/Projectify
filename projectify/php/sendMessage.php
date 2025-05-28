<?php    
    session_start();
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    if(isset($_POST['messageUser'])) {
        $currentUserID = $_SESSION['userid'];
        $receiverID = isset($_POST['messageUser']) ? mysqli_real_escape_string($connection, $_POST['messageUser']) : "";
        $messageContent = isset($_POST['message']) ? mysqli_real_escape_string($connection, $_POST['message']) : "";

        // Check if receiver exists
        $checkReceiverQuery = "SELECT * FROM `User` WHERE `UserID` = '$receiverID'";
        $receiverResult = mysqli_query($connection, $checkReceiverQuery);

        if (mysqli_num_rows($receiverResult) > 0) {
            // Insert message
            $insertMessageQuery = "
                INSERT INTO Message (Content, Timestamp, SenderID, ReceiverID)
                VALUES ('$messageContent', NOW(), '$currentUserID', '$receiverID')
            ";

            if (!mysqli_query($connection, $insertMessageQuery)) {
                echo "Error: " . $insertMessageQuery . "<br>" . mysqli_error($connection);
            } else {
                echo "Message sent successfully.";
            }
        } else {
            echo "Error: Receiver does not exist.";
        }
    }
?>

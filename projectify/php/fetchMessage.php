<?php
    session_start();
    require_once(__DIR__ . '/../dbConn.php');
    global $connection;

    // Check if session variables are set
    if (isset($_SESSION['userid']) && isset($_POST['selectedUserID'])) {
        $currentUserID = $_SESSION['userid'];
        $chatPartnerID = $_POST['selectedUserID'];

        // Prepare the query with placeholders
        $fetchMessagesQuery = "
            SELECT *
            FROM Message
            WHERE (SenderID = ? AND ReceiverID = ?) 
            OR (SenderID = ? AND ReceiverID = ?)
            ORDER BY Timestamp ASC
        ";

        // Prepare and bind the statement
        $statement = mysqli_prepare($connection, $fetchMessagesQuery);
        mysqli_stmt_bind_param($statement, "iiii", $currentUserID, $chatPartnerID, $chatPartnerID, $currentUserID);

        // Execute the statement
        mysqli_stmt_execute($statement);

        // Get the result
        $result = mysqli_stmt_get_result($statement);

        // Initialize a variable to store the HTML
        $messagesHTML = "";

        while ($row = mysqli_fetch_assoc($result)) {
            $messageContent = htmlspecialchars($row['Content'], ENT_QUOTES, 'UTF-8');
            $timestamp = htmlspecialchars($row['Timestamp'], ENT_QUOTES, 'UTF-8');
            $senderID = $row['SenderID'];

            // Check if the message is outgoing or incoming
            if ($senderID == $currentUserID) {
                // Outgoing message
                $messageHTML = '
                <div class="outgoing-chats">
                    <div class="outgoing-msg">
                        <div class="outgoing-chats-msg">
                            <p class="multi-msg">' . $messageContent . '</p>
                            <span class="time">' . $timestamp . '</span>
                        </div>
                    </div>
                </div>';
            } elseif ($senderID == $chatPartnerID) {
                // Incoming message
                $messageHTML = '
                <div class="received-chats">
                    <div class="received-msg">
                        <div class="received-msg-inbox">
                            <p>' . $messageContent . '</p>
                            <span class="time">' . $timestamp . '</span>
                        </div>
                    </div>
                </div>';
            }

            // Append the constructed message HTML to the messagesHTML variable
            $messagesHTML .= $messageHTML;
        }

        // Echo the messages HTML
        echo $messagesHTML;
    } else {
        echo "Session variables not set.";
    }
?>

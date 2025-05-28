<?php
global $connection;
$userID = $_SESSION['userid'];

$fetchForumsQuery = "
SELECT 
    f.`ForumID` AS ForumID,
    f.`Topic` AS Topics,
    f.`Content` AS Content,
    i.`Filepath` AS Image,
    f.`Timestamp` AS Timestamp,
    u.`Name` AS HostName,
    u.`UserID` AS HostID
FROM `Forum` f
LEFT JOIN `Image` i ON i.`ImageID` = f.`ImageID`
LEFT JOIN `User` u ON u.`UserID` = f.`HostID`
";

if (isset($_POST["viewOwn"])) {
    $fetchForumsQuery .= " WHERE u.`UserID` = $userID ";
}

$forumsResult = mysqli_query($connection, $fetchForumsQuery);
$forums = [];

if ($forumsResult) {
    while ($forum = mysqli_fetch_assoc($forumsResult)) {
        $forumID = $forum['ForumID'];
        
        $fetchMessagesQuery = "
        SELECT 
            m.`Content` AS Message,
            m.`Timestamp` AS MessageTimestamp,
            u.`Name` AS Repliername
        FROM `Message` m
        INNER JOIN `Forum_Message` fm ON fm.`MessageID` = m.`MessageID`
        INNER JOIN `User` u ON u.`UserID` = m.`SenderID`
        WHERE fm.`ForumID` = '$forumID'
        ";
        
        $messagesResult = mysqli_query($connection, $fetchMessagesQuery);
        $messages = [];
        
        if ($messagesResult) {
            while ($message = mysqli_fetch_assoc($messagesResult)) {
                $messages[] = $message;
            }
        }

        $forum['Messages'] = $messages;
        $forums[] = $forum;
    }
}

foreach ($forums as $forum) {
    $forumID = htmlspecialchars($forum['ForumID'], ENT_QUOTES, 'UTF-8');
    $topics = htmlspecialchars($forum['Topics'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($forum['Content'], ENT_QUOTES, 'UTF-8');
    $image = htmlspecialchars($forum['Image'], ENT_QUOTES, 'UTF-8');
    $timestamp = htmlspecialchars($forum['Timestamp'], ENT_QUOTES, 'UTF-8');
    $hostName = htmlspecialchars($forum['HostName'], ENT_QUOTES, 'UTF-8');
    $hostID = htmlspecialchars($forum['HostID'], ENT_QUOTES, 'UTF-8');

    echo '
    <div class="response">
        <div class="response__number">' . $forumID . '</div>
        <h1 class="response__title">' . $topics . '</h1>
        <h1 class="response__time">' . $timestamp . '</h1>
        <p class="response__content">' . $content . '</p>';
    
    if ($image) {
        echo '
        <div class="image_container">
            <img class="response__image" src="' . $image . '"></img>
        </div>
        ';
    }

    echo '
        <div class="post-group">
            <div class="post__actions">
                <div class="button button--approve">
                    <i class="fa fa-thumbs-o-up"></i><i class="fa fa-thumbs-up solid"></i>
                </div>
                <div class="button button--deny">
                    <i class="fa fa-thumbs-o-down"></i><i class="fa fa-thumbs-down solid"></i>
                </div>
                <div class="button button--fill comment-trigger">
                    <span>Comment...</span>
                </div>
                <div class="button button--flag">
                    <i class="fa fa-comment-o"></i><i class="fa fa-comment solid"></i>
                </div>
            </div>
            <div class="post__comments">
    ';

    if (empty($forum['Messages'])) {
        echo '
            <div class="comment-group">
                <div class="post">
                    <h3 class="post__author">No Replies Yet</h3>
                    <p class="post__body">Be the first to reply to this forum!</p>
                </div>
            </div>
        ';
    } else {
        foreach ($forum['Messages'] as $message) {
            $messageContent = htmlspecialchars($message['Message'], ENT_QUOTES, 'UTF-8');
            $messageTimestamp = htmlspecialchars($message['MessageTimestamp'], ENT_QUOTES, 'UTF-8');
            $replier = htmlspecialchars($message['Repliername'], ENT_QUOTES, 'UTF-8');

            echo '
            <div class="comment-group">
                <div class="post">
                    <div class="post__avatar comment__avatar"></div>                        
                    <h3 class="post__author">' . $replier . '</h3>
                    <h4 class="post__timestamp">' . $messageTimestamp . '</h4>
                    <p class="post__body">' . $messageContent . '</p>
                </div>
            </div>
            ';
        }
    }

    echo '
            <form action="php/sendComment.php" method="POST" enctype="multipart/form-data">
                <div class="comment-form">
                    <div class="comment-form__avatar"></div>
                    <textarea name="comment" required></textarea>
                    <div class="comment-form__actions">
                        <input type="hidden" name="forumID" value="' . $forumID . '"></input>
                        <input type="hidden" name="hostID" value="' . $hostID . '"></input>
                        <input type="button" value="Cancel" class="button button--light cancel" onclick="handleCancel()"></input>
                        <input type="submit" value="Confirm" class="button button--confirm"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>';
}
?>

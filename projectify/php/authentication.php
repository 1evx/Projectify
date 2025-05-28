<?php
    session_start();
    include "dbConn.php";

    global $connection, $name, $email, $password, $age, $gender, $userID, $institutionID;
    $name = isset($_POST['txtname']) ? $_POST['txtname'] : "";
    $email = isset($_POST['txtemail']) ? $_POST['txtemail'] : "";
    $password = isset($_POST['txtpassword']) ? $_POST['txtpassword'] : "";

    $ic = isset($_POST['txtic']) ? $_POST['txtic'] : "";
    $age = isset($_POST['txtage']) ? $_POST['txtage'] : "";
    $gender = isset($_POST['txtgender']) ? $_POST['txtgender'] : "";
    $role = isset($_POST['txtrole']) ? $_POST['txtrole'] : "";
    $institutionID = isset($_POST['txtinstitution']) ? $_POST['txtinstitution'] : "";

    $loginEmail = isset($_POST['txtemail2']) ? $_POST['txtemail2'] : "";
    $loginPassword = isset($_POST['txtpassword2']) ? $_POST['txtpassword2'] : "";

    $signUp1ContainerStyle = "";
    $signInContainerStyle = "";
    $toggleContainerStyle = "";
    $signUp2ContainerStyle = "display: none";

    if (isset($_POST['btnSignUp1'])) {
        $query = "SELECT * FROM `User` WHERE Email = '$email'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            // Check if email already exists
            if (mysqli_num_rows($result) > 0) {
                $error_message = "Email Already Exists!";
            } else {
                if (!empty($name) && !empty($email) && !empty($password)) {
                    $_SESSION['temp1'] = $name;
                    $_SESSION['temp2'] = $email;
                    $_SESSION['temp3'] = $password;
        
                    // Set styles for display
                    $signUp1ContainerStyle = "display: none";
                    $signInContainerStyle = "display: none";
                    $toggleContainerStyle = "display: none";
                    $signUp2ContainerStyle = "";
                } else {
                    $error_message = "Please fill in all the fields.";
                }
            }
        } else {
            $error_message = "Database error occurred.";
        }
        
        if (isset($error_message)) {
            echo '<script>alert("' . $error_message . '");</script>';
        }

    }elseif(isset($_POST['btnSignUp2'])){
        
        $registerName = $_SESSION['temp1'];
        $registerEmail = $_SESSION['temp2'];
        $registerPassword = $_SESSION['temp3'];
        
        // Insert new user into the database
        $insertQuery1 = "INSERT INTO `User` (`Name`, `IC`, `Email`, `Password`, `Age`, `Gender`, `RoleID`) VALUES ('$registerName', '$ic', '$registerEmail', '$registerPassword','$age','$gender', '$role')";
        if(mysqli_query($connection, $insertQuery1)){
            $selectQuery = "SELECT UserID FROM `User` WHERE `Email` = '$registerEmail'";
            $result = mysqli_query($connection, $selectQuery);
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $userID = $row['UserID'];
                $_SESSION['temp4'] = $userID;
            }
        }

        $userID = $_SESSION['temp4'];
        $insertQuery2 = "INSERT INTO `User_Institution` (`InstitutionID`, `UserID`, `Status`, `DateAdded`) VALUES ('$institutionID', '$userID', 'Pending', CURRENT_TIMESTAMP)";
        if(mysqli_query($connection, $insertQuery2)){
            saveImage($_FILES["profile"],'UserID',$userID, $connection,'User');
            echo '<script>';
            echo 'window.alert("Register Success!");';
            echo 'window.location.href = "/projectify/signin.php";';
            echo '</script>';
        }

        unset($_SESSION['temp1']);
        unset($_SESSION['temp2']);
        unset($_SESSION['temp3']);
        unset($_SESSION['temp4']);

    }elseif(isset($_POST['btnSignIn'])){
        $query = "SELECT * FROM `User`";
        $result = mysqli_query($connection, $query);
        $matchFound = false;
        
        // Fetch the user based on the email
        $query = "SELECT u.UserID, u.Email, u.Name, u.Password, u.RoleID, ui.InstitutionID, i.Name as InstitutionName
        FROM `User` u
        LEFT JOIN `User_Institution` ui ON ui.UserID = u.UserID
        LEFT JOIN `Institution` i ON i.InstitutionID = ui.InstitutionID
        WHERE u.Email = '$loginEmail'";

        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $useridData = htmlspecialchars($row['UserID'], ENT_QUOTES, 'UTF-8');
            $emailData = htmlspecialchars($row['Email'], ENT_QUOTES, 'UTF-8');
            $usernameData = htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8');
            $passwordData = htmlspecialchars($row['Password'], ENT_QUOTES, 'UTF-8');
            $roleIndex = $row['RoleID'];
    
            if($passwordData == 'BANNED'){
                echo '<script>';
                echo 'window.alert("You are banned! Please contact the administrative for futher information.");';
                echo 'window.location.href = "/projectify/signin.php";';
                echo '</script>';
                unset($_SESSION['temp1']);
                unset($_SESSION['temp2']);
                unset($_SESSION['temp3']);
                unset($_SESSION['temp4']);
                exit();
            }else{
                if ($loginEmail === $emailData && $loginPassword === $passwordData) {
                    $matchFound = true;
                    if($roleIndex == 1){
                        $_SESSION['usertype'] = "admin";   
                    } elseif($roleIndex == 2){
                        $_SESSION['usertype'] = "student";   
                    } elseif($roleIndex == 3){
                        $_SESSION['usertype'] = "lecturer";   
                    }
            
                    $_SESSION['userid'] = $useridData;
                    $_SESSION['email'] = $emailData;
                    $_SESSION['username'] = $usernameData;
                    $_SESSION['password'] = $passwordData;
            
                    $selectQuery2 = "SELECT * FROM `User_Institution` WHERE UserID = '$useridData'";
                    $result2 = mysqli_query($connection, $selectQuery2);
                    if($result2){
                        if ($row = mysqli_fetch_assoc($result2)) { 
                            $institutionID = htmlspecialchars($row['InstitutionID'], ENT_QUOTES, 'UTF-8');
                        }
                    }
                    
                    $selectQuery3 = "SELECT * FROM `Institution` WHERE InstitutionID = '$institutionID'";
                    $result3 = mysqli_query($connection, $selectQuery3); 
                    if($result3){
                        if ($row = mysqli_fetch_assoc($result3)) {
                            $_SESSION['institutionname'] = htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8');
                        }
                    }
            
                    echo '<script>';
                    echo 'window.alert("Login Success!");';
                    echo '</script>';
            
                    if($_SESSION['usertype'] == "admin"){
                        echo '<script>';
                        echo 'window.location.href = "/projectify/admin.php";';
                        echo '</script>';
                    } elseif($_SESSION['usertype'] == "lecturer"){
                        echo '<script>';
                        echo 'window.location.href = "/projectify/lecturer.php";';
                        echo '</script>';
                    } elseif($_SESSION['usertype'] == "student"){
                        echo '<script>';
                        echo 'window.location.href = "/projectify/student.php";';
                        echo '</script>';
                    }
                }
            }
        }
        
        if (!$matchFound) {
            echo '<script>';
            echo 'window.alert("Invalid credentials!");';
            echo '</script>';
        }
        
    }
?>

<?php 
    include "php/function.php";
    include "php/authentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Projectify</title>
  <link rel="stylesheet" href="css/signin.css">
  <script src="javascript/function.js"></script>
  <script>
    // Show Password
    $(document).ready(function(){
        $(".toggle-password").click(function(){
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });

    //Prevent Form Resubmission
    if ( window.history.replaceState ) {
        window.history.replaceState(null, null, window.location.href);
    }

    function showRegister() {
        document.getElementById('container').classList.add("active");
    }

    function showLogin() {
        document.getElementById('container').classList.remove("active");
    }
    </script>
</head>
<body>
    <div class="showcase">
        <div class="videocontainer">
        </div>
    </div>
    <div class="container" id="container">

        <div style="<?php echo $signUp1ContainerStyle; ?>" class="form-container sign-up">
            <form id="signUpFormOne" action="" method="POST" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <span>Registration</span>
                <input name="txtname" placeholder="Name" required>
                <input type="email" name="txtemail" placeholder="Email" required>
                <input type="password" id="txtpassword" name="txtpassword" placeholder="Password" required>
                <div class="input-container">
                    <span toggle="#txtpassword" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                </div>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <button id="signUp" name="btnSignUp1" class="signupbtn">Sign Up</button>
            </form>
        </div>

        <div style="<?php echo $signInContainerStyle; ?>" class="form-container sign-in">
            <form id="signInForm" action="" method="POST">
                <h1>Sign In</h1>
                <span>Email and Password</span>
                <input type="email" name="txtemail2" placeholder="Email" required>
                <input type="password" id="txtpassword2" name="txtpassword2" placeholder="Password" required>
                <div class="input-container">
                    <span toggle="#txtpassword2" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                </div>
                <a href="#">Forget Your Password?</a>
                <div class="social-icons">
                    <a href="#" class="icon1"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon2"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon3"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon4"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <button name="btnSignIn" class="signupbtn">Sign In</button>
            </form>
        </div>

        <div style="<?php echo $toggleContainerStyle; ?>" class="toggle-container">
            <div class="toggle">
                <div class="videocontainer">
                    <video src="video\3209298-uhd_3840_2160_25fps.mp4" width="900" autoplay muted loop></video>
                </div>
                <div class="toggle-panel toggle-left" >
                    <div class="toggle-containerleft"></div>
                    <div class="lefttext">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details</p>
                        <button class="hidden" id="login" onclick="showLogin()">Sign In</button>
                    </div>
                </div>
                <div class="toggle-panel toggle-right">
                    <div class="toggle-containerright"></div>
                    <div class="righttext">
                        <h1>Hello!</h1>
                        <p>Sign with your personal details</p>
                        <button class="hidden" id="register" onclick="showRegister()">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

        <div style="<?php echo $signUp2ContainerStyle; ?>" class="form-container-2 sign-in-2">
            <a href="javascript:history.go(-1);" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <form id="signUpFormTwo" action="" method="POST" enctype="multipart/form-data">
                <h1>Your Personal Information</h1>
                <span>User Preferences and Settings</span>
                <div class="profilepic">
                    <p>Choose your profile picture</p>
                    <input class="input" id="input" type="file" accept="image/jpeg, image/png, image/jpg" name="profile" placeholder="Profile">
                </div>
                <input name="txtic" placeholder="Ic Number" required>
                <select id="institution" name="txtinstitution" required>
                    <option value="" disabled selected>Institution: </option>
                    <?php 
                        global $connection;
                        $query = "SELECT * FROM Institution";
                        $result = mysqli_query($connection, $query);
            
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $InstitutionID = htmlspecialchars($row['InstitutionID'], ENT_QUOTES, 'UTF-8');
                                $Name = htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8');
                                echo '<option value="'.$InstitutionID.'">'.$Name.'</option>';
                            }
                        }
                    ?>
                </select>
                <select id="role" name="txtrole" required>
                    <option value="" disabled selected>Role: </option>
                    <option value="2">Student</option>
                    <option value="3">Lecturer</option>
                </select>

                <div class="social-icons">
                    <select id="gender" name="txtgender" required>
                        <option value="" disabled selected>Gender: </option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="prefer-not-to-say">Prefer not to say</option>
                    </select>
                    <input type="number" id="age" name="txtage" min="0" max="100" placeholder="Age: " required>
                </div>
                <button name="btnSignUp2">Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Media/Icon/ToothTrackr/ToothTrackr-white.png" type="image/png">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/Toothtrackr.css">
    <link rel="stylesheet" href="../css/loading.css">

    <title>Password Reset Success - ToothTrackr (Dentist)</title>

    <style>
        .success-message p {
            font-size: 14px;
            margin: 8px 0;
            font-weight: 500;
        }

        .login-btn {
            width: 100px;
            height: 40px;
            border-radius: 50px;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><img src="../Media/Icon/Black/navbar.png" class="navbar-logo" alt="Navigation Bar"></a></li>
            <li><a href="../ToothTrackr.php"><img src="../Media/Icon/ToothTrackr/name-blue.png" class="logo-name" alt="ToothTrackr"></a></li>
            <li><a href="../ToothTrackr.php">Home</a></li>
            <li><a href="../ToothTrackr.php#services">Services</a></li>
            <li><a href="../ToothTrackr.php#contact">Contact</a></li>
            <li><a href="signup.php">Sign up</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
        <ul>
            <li><a href="../ToothTrackr.php"><img src="../Media/Icon/ToothTrackr/name-blue.png" class="logo-name" alt="ToothTrackr"></a></li>
            <li class="hideOnMobile"><a href="../ToothTrackr.php">Home</a></li>
            <li class="hideOnMobile"><a href="../ToothTrackr.php#services">Services</a></li>
            <li class="hideOnMobile"><a href="../ToothTrackr.php#contact">Contact</a></li>
            <li class="hideOnMobile"><a href="signup.php" class="reg-btn">Sign up</a></li>
            <li class="hideOnMobile"><a href="login.php" class="log-btn">Login</a></li>
            <li class="menu-button" onclick=showSidebar()><a href="#"><img src="../Media/Icon/Black/navbar.png" class="navbar-logo" alt="Navigation Bar"></a></li>
        </ul>
    </nav>
    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }
        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }
    </script>

    <div class="login-container">
        <div class="inside-container">
            <span class="login-logo"><img src="../Media/Icon/Blue/dentist.png"></span>
            <span class="login-header">Password Reset Successfully</span>
            <span class="login-header-admin">Songco Dental and Medical Clinic</span>
            
            <div class="success-message">
                <p>Your password has been successfully updated.</p>
                <p>You can now log in with your new password.</p>
            </div>
            
            <a href="login.php" class="login-btn" style="display: block; text-align: center; text-decoration: none;">Log In</a>
        </div>
    </div>
    
</body>

</html>
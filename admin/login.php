<?php
// Start the session securely
session_start();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Redirect already logged-in admin
if (isset($_SESSION["user"]) && $_SESSION['usertype'] === 'a') {
    header("Location: dashboard.php");
    exit();
}

// Clear session
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set timezone
date_default_timezone_set('Asia/Singapore');
$_SESSION["date"] = date('Y-m-d');

// DB connection
include("../connection.php");

$error = "";

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['useremail']);
    $password = $_POST['userpassword'];

    // Sanitize email input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check if email exists in webuser
        $stmt = $database->prepare("SELECT usertype FROM webuser WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $utype = $result->fetch_assoc()['usertype'];

            if ($utype === 'a') {
                // Check if admin exists
                $stmt = $database->prepare("SELECT * FROM admin WHERE aemail = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $admin = $result->fetch_assoc();

                    // Verify password
                    if (password_verify($password, $admin['apassword'])) {
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'a';
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        $error = "Wrong credentials: Invalid email or password.";
                    }
                } else {
                    $error = "No admin account found for this email.";
                }
            } else {
                $error = "Access denied: Admins only.";
            }
        } else {
            $error = "No account found for this email.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Prevent caching -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="icon" href="../Media/Icon/ToothTrackr/ToothTrackr-white.png" type="image/png">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/Toothtrackr.css">
    <link rel="stylesheet" href="../css/loading.css">
    <title>Log in - ToothTrackr (Admin)</title>
    <script>
        // Prevent browser back after logout
        function preventBackAfterLogout() {
            window.history.forward();
        }
        window.onload = preventBackAfterLogout;
        window.onpageshow = function(event) {
            if (event.persisted) window.location.reload();
        };
    </script>
</head>
<body>
    <nav>
        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><img src="../Media/Icon/Black/navbar.png" class="navbar-logo" alt="Navigation Bar"></a></li>
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
            <li class="menu-button" onclick="showSidebar()"><a href="#"><img src="../Media/Icon/Black/navbar.png" class="navbar-logo" alt="Navigation Bar"></a></li>
        </ul>
    </nav>
    <script>
        function showSidebar() {
            document.querySelector('.sidebar').style.display = 'flex';
        }
        function hideSidebar() {
            document.querySelector('.sidebar').style.display = 'none';
        }
    </script>
    <div class="login-container">
        <div class="inside-container">
            <span class="login-logo"><img src="../Media/Icon/SDMC Logo.png"></span>
            <span class="login-header">Log in</span>
            <span class="login-header-admin">Songco Dental and Medical Clinic</span>
            <form action="" method="POST" novalidate>
                <label for="useremail">Email</label>
                <input type="email" id="useremail" name="useremail" placeholder="Enter your email" required>
                <label for="userpassword">Password</label>
                <input type="password" id="userpassword" name="userpassword" placeholder="Enter your password" required>
                <div class="error-message" style="<?php echo empty($error) ? 'display:none;' : ''; ?>">
                    <?php 
                    if (!empty($error)) {
                        echo '<p>' . htmlspecialchars($error) . '</p>'; 
                    }
                    ?>
                </div>
                <input type="submit" value="Log in" class="login-btn">
                <label class="bottom-text">Forgot password? <a href="forgot-password.php" class="signup-link">Reset here</a></label>
                <label class="bottom-text">Log in as <a href="../dentist/login.php" class="signup-link">Dentist</a></label>
            </form>
        </div>
    </div>
</body>
</html>

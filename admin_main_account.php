<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    header("Location: index.php");
    exit();
}

$server = "localhost";
$username = "root";
$password = "";
$dbname = "lto_system";

$conn = mysqli_connect($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_SESSION["user_name"];
$sql = "SELECT * FROM users WHERE name = '$user_name'";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['add'])) {
    header("Location: admin_letas_impound_add.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LTO Records Management</title>
    <script src="js/icon.js" crossorigin="anonymous"></script>
    <script src="js/voice.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin_main_header.css">
    <link rel="stylesheet" href="css/admin_main_navigation.css">
    <link rel="stylesheet" href="css/admin_main_account.css">
    <link rel="stylesheet" href="css/main_footer.CSS">
    <style>
        main {
            background-image: url('img/lto_img.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-name">
            <a href="javascript:void(0);" class="menu-bar" onclick="myFunction()">
                <i class="fa-solid fa-bars"></i>
            </a>
            <img src="img/lto_logo.png" alt="">
            <h2>LTRMS</h2>
        </div>
        <div class="reg-log">
            <ul>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">
                        <span class="name"><i class="fa-solid fa-user"></i>
                            <?php echo $_SESSION["user_name"]; ?>
                        </span>
                    </a>
                    <div class="dropdown-content">
                        <a class="active" href="admin_main_account.php"><i class="fa-regular fa-user"></i> View Account</a>
                        <a href="admin_main_registration.php"><i class="fa-solid fa-plus"></i> New Account</a>
                        <a href="db_logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <script>
        function myFunction() {
            var x = document.getElementById("sidenav");
            if (x.className === "navbar") {
                x.className += " responsive";
            }
            else {
                x.className = "navbar";
            }
        }
    </script>
    <nav class="navbar" id="sidenav">
        <div class="sidebar">
            <div class="menu-btn">
                <a href="javascript:void(0);" class="menu-x" onclick="myFunction()">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
            <ul>
                <li>
                    <a href="admin_main_home.php" style="padding-right: 99px;">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>
                <li>
                    <a href="admin_main_dashboard.php" style="padding-right: 71px;">
                        <i class="fa-solid fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li>
                    <button class="dropdown-btn">
                        <i class="fa-solid fa-folder"></i> LETAS <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="admin_letas_impound.php"><i class="fa-solid fa-file"></i> Impound Records</a>
                        <a href="admin_letas_ticket.php"><i class="fa-solid fa-file"></i> Ticketing Records</a>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn">
                        <i class="fa-solid fa-folder"></i> Miscellaneous <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="admin_misc_monitoring.php"><i class="fa-solid fa-file"></i> Motinoring Records</a>
                        <a href="admin_misc_special.php"><i class="fa-solid fa-file"></i> Special Files</a>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn">
                        <i class="fa-solid fa-folder"></i> Chief Records <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="admin_chief_memorandum.php"><i class="fa-solid fa-file"></i> Memorandum</a>
                    </div>
                </li>
                <li>
                    <a href="admin_main_archive.php" style="padding-right: 84.5px;">
                        <i class="fa-solid fa-box-archive"></i> Archived
                    </a>
                </li>
                <li>
                    <a href="admin_main_archive.php" style="padding-right: 40.5px; padding-left: 8px;">
                        <i class="fa-solid fa-users"></i>Registered Staff
                    </a>
                </li>
                <li>
                    <a href="admin_main_archive.php" style="padding-right: 56px;">
                        <i class="fa-solid fa-file-signature"></i> Activity Logs
                    </a>
                </li>
                <li>
                    <a href="admin_main_archive.php" style="padding-right: 76px;">
                        <i class="fa-solid fa-clock-rotate-left"></i> User Logs
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
    <main>
        <div class="container">
            <h2>My Account</h2>
            <div class="box">
                <div class="contents">
                    <div class="wrapper-1">
                        <div class="qr-code">
                            <h4>MY QR CODE : </h4>
                            <img src="img/1716085468.png" alt="">
                        </div>
                        <div class="table">
                            <table>
                                <tr>
                                    <th>Name :</th>
                                    <td>Helbert Valenzuela Binbin Jr.</td>
                                </tr>
                                <tr>
                                    <th>Birthdate :</th>
                                    <td>September 03, 2002</td>
                                </tr>
                                <tr>
                                    <th>Age :</th>
                                    <td>21</td>
                                </tr>
                                <tr>
                                    <th>Gender :</th>
                                    <td>Male</td>
                                </tr>
                                <tr>
                                    <th>Address :</th>
                                    <td>Brgy. Barandal Calamba Hill BLK 36 LOT 20 Phase 2 Seatle Street Calamba City of Laguna</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number :</th>
                                    <td>09918275536</td>
                                </tr>
                                <tr>
                                    <th>Email :</th>
                                    <td>hvbinbin@ccc.edu.ph</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="wrapper-2">
                        <div class="edit-profile">
                            <h4>Change email</h4>
                            <label for="">Email :</label>
                            <input type="text" placeholder="Enter your new email">
                            <br>
                            <label for="">Verification Code :</label>
                            <div class="otp">
                                <input type="text" placeholder="Enter the OTP Code">
                                <button class="otp-btn">Send OTP</button>
                            </div>
                            <button class="submit">Update Email</button>
                        </div>
                        <div class="change-pass">
                            <h4>Change password</h4>
                            <label for="">Password :</label>
                            <input type="text" placeholder="Enter your current password">
                            <label for="">Confirm Password :</label>
                            <input type="text" placeholder="Confirm your password">
                            <label for="">New Password :</label>
                            <input type="text" placeholder="Enter your new password">
                            <button class="submit">Update Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>Copyright &#169 2024 LTO Calamba District Office.</p>
    </footer>
</body>

</html>
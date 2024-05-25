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

// if (isset($_POST['add'])) {
//     header("Location: admin_misc_monitoring_add.php");
//     exit;
// }

// if (isset($_POST['details'])) {
//     header("Location: admin_misc_monitoring_edit.php");
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LTO Records Management</title>
    <script src="js/icon.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin_main_header.css">
    <link rel="stylesheet" href="css/admin_main_navigation.css">
    <link rel="stylesheet" href="css/admin_misc_monitoring.CsS">
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
                        <span class="name"><i class="fa-solid fa-user"></i><?php echo $_SESSION["user_name"]; ?></span>
                    </a>
                    <div class="dropdown-content">
                        <a href="admin_main_account.php"><i class="fa-regular fa-user"></i> View Account</a>
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
                    <button id="active" class="dropdown-btn">
                        <i class="fa-solid fa-folder"></i> Miscellaneous <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="active" href="admin_misc_monitoring.php"><i class="fa-solid fa-file"></i> Motinoring
                            Records</a>
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
            <h2>Miscellaneous Records</h2>
            <div class="box">
                <h3>Monitoring Records</h3>
                <div class="wrapper">
                    <div class="content-1">
                        <div class="filter">
                            <form action="" method="">
                                <div class="filt">
                                    <div class="cont-1">
                                        <div class="all">
                                            <button>All</button>
                                        </div>
                                        <div class="drawer">
                                            <select name="" id="">
                                                <option value="" disabled selected hidden>Drawer</option>
                                                <option value="">Drawer A</option>
                                                <option value="">Drawer B</option>
                                                <option value="">Drawer C</option>
                                                <option value="">Drawer D</option>
                                            </select>
                                        </div>
                                        <div class="status">
                                            <select name="" id="">
                                                <option value="" disabled selected hidden>Status</option>
                                                <option value="">Complete</option>
                                                <option value="">Incomplete</option>
                                                <option value="">In progress</option>
                                            </select>
                                        </div>
                                        <div class="apprehension-date">
                                            <label for="">Returned Date</label><br>
                                            <input type="date">
                                        </div>
                                        <div class="filter-btn">
                                            <button>Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="search-box">
                            <form action="">
                                <div class="search">
                                    <input type="search" id="transcription-input"
                                        placeholder="Search TOP #, Engine #, and Chassis #">
                                    <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                                <div class="mic">
                                    <button class="mic-btn" id="start-record-btn">
                                        <i class="fa-solid fa-microphone"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <script>
                            const startRecordingButton = document.getElementById('start-record-btn');
                            const transcriptionInput = document.getElementById('transcription-input');

                            let recognition = new window.webkitSpeechRecognition();
                            recognition.continuous = true;
                            recognition.lang = 'en-US';
                            recognition.interimResults = true; // Enable interim results for live updates

                            startRecordingButton.addEventListener('click', () => {
                                recognition.start();
                                startRecordingButton.disabled = true;
                            });

                            recognition.onresult = function (event) {
                                const speechToText = event.results[event.results.length - 1][0].transcript;
                                transcriptionInput.value = speechToText;
                            };

                            recognition.onend = function () {
                                startRecordingButton.disabled = false;
                            };
                        </script>
                    </div>
                    <div class="content-2">
                        <form action="generate_pdf.php" method="post">
                            <div class="table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width:20px;"><input type="checkbox" name="" id=""></th>
                                            <th style="width:20px;">No.</th>
                                            <th style="width:20px;">Drawer</th>
                                            <th>MV File</th>
                                            <th>Plate #</th>
                                            <th>Borrower</th>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Returned Date</th>
                                            <th style="text-align: start; width:150px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connection = mysqli_connect("localhost", "root", "", "lto_system");

                                        if ($connection) {
                                            $sql = "SELECT * FROM misc_monitoring";
                                            if (isset($_GET['search'])) {
                                                $filtervalue = $_GET['search'];
                                                $sql .= " WHERE CONCAT(motor_vehicle_file, plate_number, returned_date) LIKE '%$filtervalue%'";
                                            }

                                            $result = mysqli_query($connection, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                $rowNumber = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                        <td><?php echo $rowNumber++; ?></td>
                                                        <td><?php echo $row['drawer_level'], $row['drawer_number']; ?></td>
                                                        <td><?php echo $row['motor_vehicle_file']; ?></td>
                                                        <td><?php echo $row['plate_number']; ?></td>
                                                        <td><?php echo $row['borrower']; ?></td>
                                                        <td><?php echo $row['purpose']; ?></td>
                                                        <td><?php echo $row['status']; ?></td>
                                                        <td><?php echo $row['returned_date']; ?></td>
                                                        <td style="text-align: start;">
                                                            <input type="hidden" name="motor_vehicle_file"
                                                                value="<?php echo $row['motor_vehicle_file']; ?>">
                                                            <input type="hidden" name="plate_number"
                                                                value="<?php echo $row['plate_number']; ?>">
                                                            <input type="hidden" name="borrower"
                                                                value="<?php echo $row['borrower']; ?>">
                                                            <input type="hidden" name="purpose"
                                                                value="<?php echo $row['purpose']; ?>">
                                                            <input type="hidden" name="status"
                                                                value="<?php echo $row['status']; ?>">
                                                            <input type="hidden" name="qrimage"
                                                                value="<?php echo $row['qrimage']; ?>">
                                                            <div class="dropdown">
                                                                <button type="button" onclick="toggleDropdown(this)"
                                                                    class="dropbtn">
                                                                    Actions<i class="fa fa-caret-down"></i>
                                                                </button>
                                                                <div class="dropdown-content">
                                                                    <button type="submit" name="details"><i class="fa-solid fa-eye"></i> View Details</button>
                                                                    <button type="submit" name="edit"><i class="fa-solid fa-pen-to-square"></i> Edit Details</button>
                                                                    <button type="submit" name=""><i class="fa-solid fa-envelope"></i> Send Email</button>
                                                                    <button type="submit"><i style="margin-right: 11px; margin-left: 6px;" class="fa-solid fa-file-arrow-down"></i> Download PDF</button>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function toggleDropdown(button) {
                                                                    var dropdown = button.nextElementSibling;
                                                                    dropdown.classList.toggle("show");

                                                                    // Close any other open dropdowns
                                                                    var dropdowns = document.getElementsByClassName("dropdown-content");
                                                                    for (var i = 0; i < dropdowns.length; i++) {
                                                                        if (dropdowns[i] !== dropdown && dropdowns[i].classList.contains('show')) {
                                                                            dropdowns[i].classList.remove('show');
                                                                        }
                                                                    }
                                                                }

                                                                // Close the dropdown if the user clicks outside of it
                                                                window.onclick = function (event) {
                                                                    if (!event.target.matches('.dropbtn')) {
                                                                        var dropdowns = document.getElementsByClassName("dropdown-content");
                                                                        for (var i = 0; i < dropdowns.length; i++) {
                                                                            var openDropdown = dropdowns[i];
                                                                            if (openDropdown.classList.contains('show')) {
                                                                                openDropdown.classList.remove('show');
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            </script>
                                                        </td>
                                                </tbody>
                                                </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                            <tr>
                                                <td colspan="10">
                                                    <p>No available data.</p>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            mysqli_close($connection);
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="buttons">
                                <button class="archive"><i class="fa-solid fa-box-archive"></i> Archive</button>
                                <button class="export"><i class="fa-solid fa-file-arrow-down"></i> Export</button>
                                <button class="add" type="submit" name="add"><i class="fa-solid fa-plus"></i>
                                    Add</button>
                            </div>
                        </form>
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
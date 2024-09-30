<?php
session_start();
include "common/conn.php";

// Check if user ID and designation are set in session or session storage
if (!isset($_SESSION['username']) && isset($_COOKIE['remember_username'])) {
    // Retrieve login information from cookies
    $_SESSION['username'] = $_COOKIE['remember_username'];
    $_SESSION['em_role'] = $_COOKIE['em_role'];
}

// Check if user ID and designation are set in session
if (!isset($_SESSION['username']) || !isset($_SESSION['em_role'])) {
    header("location: login.php"); // Redirect to login page if session variables are not set
    exit(); // Terminate script execution after redirection
}

$userid = $_SESSION['username'];
$em_role = $_SESSION['em_role'];
if ($userid === NULL) {
    header("location:login.php");
}
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-center" href="index.php">
        <img src="assets/img/logo.png" class="img-fluid">
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form> -->
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <?php
            include "common/conn.php";
            $sql = "SELECT * FROM employee WHERE id=$userid";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row["full_name"];
            }
            ?>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i><?php echo $row["full_name"]; ?></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <?php
                include "common/conn.php";
                $sql1 = "SELECT * FROM employee WHERE id=$userid";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    $row1 = $result1->fetch_assoc();
                    $em_code = $row1["em_code"];
                    $encoded_id = base64_encode($row['em_code']);
                }
                ?>
                <li><a class="dropdown-item" href="employeeDetail.php?em_id=<?php echo $encoded_id; ?>">Profile</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
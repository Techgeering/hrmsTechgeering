<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Attendance List - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <?php
    include "common/conn.php";
    $sql13 = "SELECT * FROM employee WHERE id=$userid";
    $result13 = $conn->query($sql13);
    if ($result13->num_rows > 0) {
        $row13 = $result13->fetch_assoc();
        $emp_id = $row13["em_code"];
        $dept = $row13["dep_id"];
    }
    ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="my-2">Attadence List</h2>
                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Attadence List
                            </button>
                        <?php } ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Employee id</th>
                                        <th>Employee Name</th>
                                        <th>Day</th>
                                        <th>Date</th>
                                        <th>Sign In</th>
                                        <th>Sign Out</th>
                                        <th>Working Hour</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    if ($em_role == '4' || $em_role == '2' || $em_role == '5') {
                                        $sql = "SELECT a.id, a.emp_id, e.full_name, a.atten_date, a.signin_time, a.signout_time, a.working_hour
                                                FROM attendance a
                                                JOIN employee e ON a.emp_id = e.em_code WHERE a.emp_id = '$emp_id' ORDER BY atten_date DESC";
                                    } else {
                                        $sql = "SELECT a.id, a.emp_id, e.full_name, a.atten_date, a.signin_time, a.signout_time, a.working_hour
                                                FROM attendance a
                                                JOIN employee e ON a.emp_id = e.em_code ORDER BY atten_date DESC";
                                    }
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $dayOfWeek = (new DateTime($row["atten_date"]))->format('l');
                                            ?>

                                            <td><?php echo $row["emp_id"]; ?></td>
                                            <td><?php echo $row["full_name"]; ?></td>
                                            <td><?php echo $dayOfWeek; ?></td>
                                            <td><?php echo $row["atten_date"]; ?></td>
                                            <td><?php echo $row["signin_time"]; ?></td>
                                            <td><?php echo $row["signout_time"]; ?></td>
                                            <td><?php echo $row["working_hour"]; ?></td>
                                            <td>
                                                <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"
                                                    onclick="myfcn9(<?php echo $row['id']; ?>,'<?php echo $row['signin_time']; ?>','<?php echo $row['signout_time']; ?>','<?php echo $row['atten_date']; ?>')"
                                                    data-bs-toggle="modal" data-bs-target="#updateDept">
                                                </i>
                                            </td>
                                            <td><a onclick="confirmDelete(<?php echo $row['id']; ?>, tb='attendance', tbc='id',returnpage='attendanceList.php');"
                                                    title="Delete">
                                                    <i class="fa-solid fa fa-trash text-danger" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Employee id</th>
                                        <th>Employee Name</th>
                                        <th>Day</th>
                                        <th>Date</th>
                                        <th>Sign In</th>
                                        <th>Sign Out</th>
                                        <th>Working Hour</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'common/copyrightfooter.php' ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- <form method="post" action="<?php //echo $_SERVER['PHP_SELF']; ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="DepartmentName">Department Name</label>
                                <input type="text" class="form-control" id="DepartmentName" name="DepartmentName">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </form> -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <label for="file">Choose CSV file:</label>
                    <input type="file" name="file" id="file" accept=".csv">
                    <input type="submit" value="Upload" name="submit">
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        include "common/conn.php";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if file was uploaded without errors
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $file_tmp_path = $_FILES['file']['tmp_name'];
                $file_name = $_FILES['file']['name'];
                $file_size = $_FILES['file']['size'];
                $file_type = $_FILES['file']['type'];

                // Check file extension
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $allowed_ext = array('csv');

                if (in_array($file_ext, $allowed_ext)) {
                    // Open the file for reading
                    if (($handle = fopen($file_tmp_path, 'r')) !== false) {
                        // Skip the first line if it contains column headers
                        fgetcsv($handle);

                        // Prepare the SQL statement for inserting new records
                        $insert_stmt = $conn->prepare("INSERT INTO attendance (emp_id, atten_date, signin_time, signout_time, working_hour) VALUES (?, ?, ?, ?, ?)");
                        $insert_stmt->bind_param("sssss", $emp_id, $atten_date, $signin_time, $signout_time, $working_hours);

                        // Prepare the SQL statement for checking existing records
                        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM attendance WHERE emp_id = ? AND atten_date = ?");
                        $check_stmt->bind_param("ss", $emp_id, $atten_date);

                        // Process CSV data
                        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                            // Map CSV data to database columns
                            $emp_id = $data[0];
                            $atten_date = $data[1];
                            $signin_time = $data[2];
                            $signout_time = $data[3];

                            // Convert signin and signout times to DateTime objects
                            $signinDateTime = new DateTime($signin_time);
                            $signoutDateTime = new DateTime($signout_time);

                            // Calculate the working hours
                            $interval = $signinDateTime->diff($signoutDateTime);
                            $hours = $interval->h;
                            $minutes = $interval->i;

                            // Format the output
                            $working_hours = $hours . '.' . $minutes;

                            // Check if the date is Saturday
                            $attenDateTime = new DateTime($atten_date);
                            $dayOfWeek = $attenDateTime->format('N'); // 1 (for Monday) through 7 (for Sunday)
    
                            // Check if working hours exceed the maximum allowed
                            if ($dayOfWeek == 6) { // Saturday
                                if ($working_hours > 5) {
                                    $working_hours = 5;
                                }
                            } else {
                                if ($working_hours > 9) {
                                    $working_hours = 9;
                                }
                            }

                            // Check if the record already exists
                            $check_stmt->execute();
                            $check_stmt->store_result();
                            $check_stmt->bind_result($count);
                            $check_stmt->fetch();

                            if ($count == 0) {
                                // Execute the prepared statement to insert the new record
                                $insert_stmt->execute();
                            }
                        }
                        // Close the file and the statements
                        fclose($handle);
                        $insert_stmt->close();
                        $check_stmt->close();

                        echo "Data successfully imported to the database.";
                    } else {
                        echo 'Error opening the file.';
                    }
                } else {
                    echo 'Error: Invalid file type. Only CSV files are allowed.';
                }
            } else {
                echo 'Error: ' . $_FILES['file']['error'];
            }
        } else {
            echo 'Invalid request method.';
        }
        $conn->close();
    }
    ?>
    <!-- update modal -->
    <div class="modal fade" id="updateDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Attendance</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id9" id="id9">
                        <input type="hidden" name="date1" id="date1">
                        <div class="form-group">
                            <label for="DepartmentName">Sign In</label>
                            <input type="text" class="form-control" id="signin1" name="signin">
                        </div>
                        <div class="form-group">
                            <label for="DepartmentName">Sign Out</label>
                            <input type="text" class="form-control" id="signout1" name="signout">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updateattenlist">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updateattenlist'])) {
        include "common/conn.php";

        $signin = htmlspecialchars($_POST["signin"]);
        $signout = htmlspecialchars($_POST["signout"]);
        $id = $_POST["id9"];
        $date1 = $_POST["date1"];

        // Convert signin and signout times to DateTime objects
        $signinDateTime = new DateTime($signin);
        $signoutDateTime = new DateTime($signout);

        // Calculate the working hours
        $interval = $signinDateTime->diff($signoutDateTime);
        $hours = $interval->h;
        $minutes = $interval->i;

        // Format the output for working hours
        $working_hour = number_format($hours + ($minutes / 60), 2, '.', ''); // Format to 2 decimal places
    
        // Check if the date is Saturday
        $attenDateTime = new DateTime($date1);
        $dayOfWeek = $attenDateTime->format('N'); // 1 (for Monday) through 7 (for Sunday)
    
        // Check if working hours exceed the maximum allowed
        if ($dayOfWeek == 6) { // Saturday
            if ($working_hour > 5) {
                $working_hour = 5;
            }
        } else { // For other days
            if ($working_hour > 9) {
                $working_hour = 9;
            }
        }

        // Prepare the update statement
        $sql1 = "UPDATE attendance SET signin_time='$signin', signout_time='$signout', working_hour='$working_hour' WHERE id='$id'";

        if ($conn->query($sql1) === true) {
            echo "<script>alert('Success')</script>";
        } else {
            echo $conn->error;
        }
        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=1.5"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>
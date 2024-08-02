<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Attadence List
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Employee id</th>
                                        <th>Employee Name</th>
                                        <th>Date</th>
                                        <th>Sign In</th>
                                        <th>Sign Out</th>
                                        <th>Working Hour</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM attendance";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th><?php echo $row["emp_id"]; ?></th>
                                                <th><?php echo $row["emp_id"]; ?></th>
                                                <th><?php echo $row["atten_date"]; ?></th>
                                                <th><?php echo $row["signin_time"]; ?></th>
                                                <th><?php echo $row["signout_time"]; ?></th>
                                                <th><?php echo $row["working_hour"]; ?></th>
                                                <th>
                                                    <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                    <i class="fa-solid fa-lock text-danger"></i>
                                                </th>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
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
                            $working_hours = $interval->h + ($interval->i / 60);

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

        // Close the database connection
        $conn->close();
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>
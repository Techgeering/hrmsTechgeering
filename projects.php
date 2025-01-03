<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Projects - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=1.2" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <?php
        include "common/conn.php";
        $sql10 = "SELECT * FROM employee WHERE id=$userid";
        $result10 = $conn->query($sql10);
        if ($result10->num_rows > 0) {
            $row10 = $result10->fetch_assoc();
            $name = $row10["full_name"];
            $dept = $row["dep_id"];
            $em_code = $row["em_code"];
        }
        ?>
        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="my-2">All Projects</h2>
                        <?php if ($em_role == '1') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Project
                            </button>
                        <?php } ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Project Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>End Date</th>
                                        <th>Project Duration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php"; // Make sure this file exists and contains database connection code
                                    if ($em_role == '1' || $em_role == '3') {
                                        $sql = "SELECT * FROM project 
                                                    ORDER BY 
                                                        CASE 
                                                            WHEN pro_status = 'running' THEN 1
                                                            WHEN pro_status = 'notstarted' THEN 2
                                                            WHEN pro_status = 'hold' THEN 3
                                                            WHEN pro_status = 'testing' THEN 4
                                                            WHEN pro_status = 'complete' THEN 5
                                                            ELSE 6 
                                                        END";
                                    } else {
                                        $sql = "SELECT p.*, 
                                                GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users
                                                FROM project p
                                                LEFT JOIN assign_task at ON p.id = at.project_id
                                                WHERE FIND_IN_SET('$em_code', at.assign_user) > 0
                                                GROUP BY p.id";
                                    }
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $slno = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            $encoded_id = base64_encode($row['id']);
                                            ?>
                                            <tr>
                                                <th><?php echo $slno; ?></th>
                                                <td><?php echo $row["pro_name"]; ?></td>
                                                <td><?php echo $row["pro_status"]; ?></td>
                                                <td><?php echo $row["pro_start_date"]; ?></td>
                                                <td><?php echo $row["pro_end_date"]; ?></td>
                                                <td>
                                                    <?php
                                                    include "common/conn.php";

                                                    // Query to fetch durations for the given project ID
                                                    $sql2 = "SELECT duration FROM daily_report WHERE pro_id = " . $row['id'];
                                                    $result2 = $conn->query($sql2);

                                                    if ($result2) {
                                                        $totalMinutes = 0;
                                                        // Loop through the results and calculate the total minutes
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            $duration = $row2['duration'];
                                                            if (!empty($duration)) {
                                                                list($hours, $minutes) = explode(':', $duration); // Split duration into hours and minutes
                                                                $totalMinutes += $hours * 60 + $minutes; // Convert to minutes and add to total
                                                            }
                                                        }
                                                        // Convert total minutes back to hours and minutes
                                                        $totalHours = floor($totalMinutes / 60);
                                                        $remainingMinutes = $totalMinutes % 60;

                                                        echo "{$totalHours} hours and {$remainingMinutes} minutes";
                                                    } else {
                                                        echo "Error calculating duration.";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="singleProject.php?id=<?php echo $encoded_id; ?>"><i
                                                            class="fa-solid fa-eye text-success"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>0 results</td></tr>";
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Project Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="ProjectTitle" class="form-label">Project Title</label>
                                    <input type="text" class="form-control" id="ProjectTitle" name="ProjectTitle"
                                        required>
                                </div>
                                <div class="mb-2">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                                </div>
                                <div class="mb-2">
                                    <label for="ProjectEndDate" class="form-label">Project End Date</label>
                                    <input type="date" class="form-control" name="ProjectEndDate" id="ProjectEndDate">
                                </div>
                                <div class="mb-2">
                                    <label for="stateDropdown">State</label>
                                    <select class="form-control" id="stateDropdown" name="state"
                                        onchange="calculateGST()">
                                        <option value="">Select State</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="Summary" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emaill" name="email">
                                </div>
                                <div class="mb-2">
                                    <label for="Summary" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobb" name="mob">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="Details" class="form-label">Details</label>
                                    <textarea class="form-control" id="Details" name="Details" rows="7"
                                        required></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-control" id="Status" name="Status">
                                        <option value="running">Running</option>
                                        <option value="notstarted">Not Started</option>
                                        <option value="hold">Hold</option>
                                        <option value="testing">Testing</option>
                                        <option value="complete">Complete</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="Details" class="form-label">Project Image</label>
                                    <input type="file" class="form-control" id="images" name="imagess">
                                </div>
                                <div class="mb-2">
                                    <label for="Details" class="form-label">GST Number</label>
                                    <input type="text" class="form-control" id="gstt" name="gst">
                                </div>
                            </div>
                            <div class="col-12">

                                <label for="Details" class="form-label">Project Address</label>
                                <input type="text" class="form-control" id="adds" name="adds1">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <?php
    include "common/conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        function handleFileUpload($fieldName, $uploadDir)
        {
            global $conn;
            $image_name = $_FILES[$fieldName]['name'];
            $image_size = $_FILES[$fieldName]['size'];
            $image_tmp = $_FILES[$fieldName]['tmp_name'];
            $file_type = pathinfo($image_name, PATHINFO_EXTENSION);
            $new_file_name = uniqid() . '.' . $file_type;

            // Ensure upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Ensure directory is writable
            }

            $target_file = $uploadDir . $new_file_name;

            if (move_uploaded_file($image_tmp, $target_file)) {
                return $new_file_name; // Return the generated file name if upload succeeds
            } else {
                return null; // Return null if upload fails
            }
        }
        // File upload directory for images
        $upload_dir = "assets/uploads/project/";

        // Handle image upload
        $new_file_name1 = handleFileUpload('imagess', $upload_dir);
        // Retrieve form data
        $ProjectTitle = $_POST['ProjectTitle'];
        $startDate = $_POST['startDate'];
        $ProjectEndDate = $_POST['ProjectEndDate'];
        $Details = $_POST['Details'];
        $Summary = $_POST['Summary'];
        $Status = $_POST['Status'];
        $email = $_POST['email'];
        $mob = $_POST['mob'];
        $add = $_POST['adds1'];
        $gst = $_POST['gst'];
        $state = $_POST['state'];
        // Insert data into database
        $sql = "INSERT INTO project (pro_name, pro_start_date, pro_end_date, pro_description, pro_summary, pro_status, pro_email, pro_mobile, pro_image, pro_address, pro_gstno, state) 
                VALUES ('$ProjectTitle', '$startDate', '$ProjectEndDate', '$Details', '$Summary', '$Status', '$email', '$mob', '$new_file_name1','$add','$gst','$state')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                        alert('Success');
                        window.location.href = 'projects.php';
                </script>";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>
    <!-- disable the previous date -->
    <script>
        document.getElementById('startDate').addEventListener('change', function () {
            var startDate = this.value;
            var endDateField = document.getElementById('ProjectEndDate');
            endDateField.value = ''; // Clear the end date field if it was previously filled
            endDateField.setAttribute('min', startDate); // Set the minimum allowed date for ProjectEndDate
        });
    </script>
</body>

</html>
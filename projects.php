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
                        <h1 class="my-2">All Projects</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Project
                        </button>
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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        include "common/conn.php"; // Make sure this file exists and contains database connection code
        
        $sql = "SELECT * FROM project";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["pro_name"]; ?></td>
            <td><?php echo $row["pro_status"]; ?></td>
            <td><?php echo $row["pro_start_date"]; ?></td>
            <td><?php echo $row["pro_end_date"]; ?></td>
            <td>
                <a href="projectDetails.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-eye text-success"></i></a>
                <a href="editProject.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i></a>
                <!-- <a href="deleteProject.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash text-danger"></i></a> -->
            </td>
        </tr>
    <?php
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
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addDeptLabel">Add Project Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ProjectName" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="ProjectName" name="ProjectName" required>
                    </div>
                    <div class="mb-3">
                        <label for="domainName" class="form-label">Domain Name</label>
                        <input type="text" class="form-control" id="domainName" name="domainName" required>
                    </div>
                    <div class="mb-3">
                        <label for="companyName" class="form-label">Company Name</label>
                        <select name="companyName" id="companyName" class="form-control" required>
                            <option value="">Select Company</option>
                            <!-- Option values populated dynamically via PHP or JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="DeadlineDate" class="form-label">Deadline Date</label>
                        <input type="date" class="form-control" id="DeadlineDate" name="DeadlineDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="proposal" class="form-label">Proposal</label>
                        <input type="file" class="form-control" id="proposal" accept=".doc, .docx, .pdf" name="proposal">
                    </div>
                    <div class="mb-3">
                        <label for="mou" class="form-label">MOU</label>
                        <input type="file" class="form-control" id="mou" accept=".doc, .docx, .pdf" name="mou">
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <?php
        include "common/conn.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Include the connection file
        

            // Retrieve form data
            $projectName = $_POST['ProjectName'];
            $domainName = $_POST['domainName'];
            $companyName = $_POST['companyName'];
            $startDate = $_POST['startDate'];
            $deadlineDate = $_POST['DeadlineDate'];

            // File handling
            $proposalFileName = $_FILES['proposal']['name'];
            $proposalTempName = $_FILES['proposal']['tmp_name'];
            $mouFileName = $_FILES['mou']['name'];
            $mouTempName = $_FILES['mou']['tmp_name'];

            // Move uploaded files to a directory
            $proposalDestination = "uploads/proposal/" . $proposalFileName;
            $mouDestination = "uploads/mou/" . $mouFileName;
            move_uploaded_file($proposalTempName, $proposalDestination);
            move_uploaded_file($mouTempName, $mouDestination);

            // Insert data into database
            $sql = "INSERT INTO projects (project_name, domain_name, company_id, start_date, end_date, Proposal, Mou) 
                VALUES ('$projectName', '$domainName', '$companyName', '$startDate', '$deadlineDate', '$proposalDestination', '$mouDestination')";

            if (mysqli_query($conn, $sql)) {
                echo " <script>alert('success')</script>";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }

            // Close connection
            mysqli_close($conn);
        }
    ?>
</body>

</html>
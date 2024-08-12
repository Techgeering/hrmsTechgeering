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
                        <h2 class="my-2">Task List</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addtasklist">
                            <i class="fa-solid fa-plus"></i>Task List
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
                                        <th>Assign Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
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
                                                <td>
                                                    <a href="singleProject.php?id=<?php echo $row['id']; ?>"><i
                                                            class="fa-solid fa-eye text-success"></i></a>
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
    <!-- task modal -->
    <div class="modal fade" id="addtasklist" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Tasks</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form1" id="form1" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" value="<?php echo $proId; ?>" id="project_name"
                                name="project_name" required>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="ProjectTitle" class="form-label">Task Title</label>
                                    <input type="text" class="form-control" id="Project_Title" name="Project_Title"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="assigndate" class="form-label">Assign Date</label>
                                    <input type="date" class="form-control" id="assign_Date" name="assign_Date"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_Date" name="start_Date" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="ProjectEndDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="Project_EndDate" id="Project_EndDate"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="assigned_users" class="form-label">Assigned Users</label>
                                    <select class="form-control" name="assigned_users" id="assigned_users">
                                        <option value="" disabled selected>Select a user</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql5 = "SELECT * FROM employee ";
                                        $result5 = $conn->query($sql5);
                                        while ($row5 = $result5->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row5['full_name']; ?>">
                                                <?php echo $row5['full_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="assigned_users1" class="form-label">Collaborators</label>
                                    <select class="form-control" name="assigned_users1[]" id="assigned_users1" multiple>
                                        <option value="" disabled>Select users</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql5 = "SELECT * FROM employee";
                                        $result5 = $conn->query($sql5);
                                        while ($row5 = $result5->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row5['full_name']; ?>">
                                                <?php echo $row5['full_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <h6>Type</h6>
                                <label class="radio-container">Office
                                    <input type="radio" name="office" value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-6">
                                <h6>Status</h6>
                                <label class="radio-container">
                                    <input type="radio" name="Status" value="complete">Complete
                                    <input type="radio" name="Status" value="running">Running
                                    <input type="radio" name="Status" value="cancel">Cancel
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="mb-2">
                                <label for="ProjectDescription" class="form-label">Project Description</label>
                                <textarea class="form-control" id="ProjectDescription" name="ProjectDescription"
                                    rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="task_list">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include "common/conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_list'])) {
        // $project_name = $_POST['project_name'];
        $Project_Title = $_POST['Project_Title'];
        $assign_Date = $_POST['assign_Date'];
        $start_Date = $_POST['start_Date'];
        $Project_EndDate = $_POST['Project_EndDate'];
        $assigned_users = $_POST['assigned_users']; // This will be an array
        // $office = $_POST['office'];
        $assigned_users1 = $_POST['assigned_users1'];
        $Status = $_POST['Status'];
        $ProjectDescription = $_POST['ProjectDescription'];

        $assigned_users1_list = implode(',', $assigned_users1);

        if ($office == 1) {
            $sqltask = "INSERT INTO pro_task (pro_id, task_title, start_date, end_date, description, task_type, status) VALUES ('$project_name', '$projecttitle', '$startdate', '$enddate', '$ProjectDescription', 'Office', '$Status')";
        } else {
            $sqltask = "INSERT INTO pro_task (pro_id, task_title, start_date, end_date, description, task_type, status) VALUES ('$project_name', '$projecttitle', '$startdate', '$enddate', '$ProjectDescription', 'Field', '$Status')";
        }

        if ($conn->query($sqltask) === true) {
            $last_id = $conn->insert_id;
            $sqltask1 = "INSERT INTO assign_task (task_id, project_id, assign_user, user_type) VALUES ('$last_id', '$project_name', '$assigned_users', 'Team Head')";

            if ($conn->query($sqltask1) === true) {
                // Insert the comma-separated list of collaborators
                $sqltask2 = "INSERT INTO assign_task (task_id, project_id, assign_user, user_type) VALUES ('$last_id', '$project_name', '$assigned_users1_list', 'Collaborators')";

                if ($conn->query($sqltask2) === true) {
                    echo "success";
                } else {
                    error_log("Error in SQL task 2: " . $conn->error);
                    echo $conn->error;
                }
            } else {
                error_log("Error in SQL task 1: " . $conn->error);
                echo $conn->error;
            }
        } else {
            error_log("Error in SQL task: " . $conn->error);
            echo $conn->error;
        }
    }
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>
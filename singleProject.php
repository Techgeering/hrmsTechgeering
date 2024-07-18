<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time();?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px 12px;
        transition: 0.3s;
        font-size: 15px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        animation: fadeEffect 1s;
    }

    /* Go from zero to full opacity */
    @keyframes fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>

        <?php
             include 'common/conn.php';
            $proId= $_GET["id"];

            $sql = "SELECT * FROM project WHERE id =$proId";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        ?>


        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="my-2">Project Details</h3>
                        <a href="projects.php" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> project Details
                        </a>
                    </div>
                    <div class="tab profile">
                        <button class="tablinks" onclick="openDialog(event, 'ProjectView')" id="defaultOpen">Project View</button>
                        <button class="tablinks" onclick="openDialog(event, 'ProjectTasks')"> Project Tasks </button>
                        <button class="tablinks" onclick="openDialog(event, 'OfficeTasks')"> Office Tasks </button>
                        <button class="tablinks" onclick="openDialog(event, 'projectsFiles')"> Projects Files </button>
                        <button class="tablinks" onclick="openDialog(event, 'notes')"> Notes </button>
                        <button class="tablinks" onclick="openDialog(event, 'Expenses')"> Expenses </button>
                    </div>
                    <div id="ProjectView" class="tabcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="assets/uploads/employee/6614b390d974e.jpg" class="img-circle"
                                            width="150">
                                        <h4 class="card-title m-t-10">ccccc</h4>
                                        <h6 class="card-subtitle">ccccc</h6>
                                    </div>
                                    <div>
                                        <hr>
                                    </div>
                                    <div class="card-body">
                                        <small class="text-muted">Email address </small>
                                        <h6>ffff</h6>
                                        <small class="text-muted p-t-30 db">Phone</small>
                                        <h6>ffff</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form class="row" action="Update" method="post" enctype="multipart/form-data"
                                    novalidate="novalidate">
                                    <div class="form-group col-md-12 m-t-10">
                                        <label>Project Title </label>
                                        <p class="form-control form-control-line"><?php echo $row["pro_name"]; ?>
                                        </p>
                                    </div>
                                    <div class="form-group col-md-6 m-t-10">
                                        <label>Project Start Date </label>
                                        <p class="form-control form-control-line"><?php echo $row["pro_start_date"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-6 m-t-10">
                                        <label>Project End Date</label>
                                        <p class="form-control form-control-line"><?php echo $row["pro_end_date"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-12 m-t-10">
                                        <label>Project Summary </label>
                                        <p class="form-control form-control-line"><?php echo $row["pro_summary"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-12 m-t-10">
                                        <label>Details </label>
                                        <p class="form-control form-control-line"><?php echo $row["pro_description"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-12 m-t-10">
                                        <label>Status</label>
                                        <p class="form-control form-control-line"><?php echo $row["pro_status"]; ?></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="ProjectTasks" class="tabcontent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="">Projects Tasks</h6>
                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i>Add Tasks
                            </button>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Project Title</th>
                                            <th>Start date</th>
                                            <th>End Date</th>
                                            <th>Assigned Users</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include "common/conn.php";                                         
                                            $sql1 = "SELECT pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date, 
                                                        GROUP_CONCAT(at.assign_user SEPARATOR ', ') AS assign_users
                                                        FROM  pro_task pt
                                                        JOIN  assign_task at
                                                        ON      pt.id = at.task_id
                                                        WHERE pt.pro_id = $proId AND pt.task_type = 'Field'
                                                        GROUP BY 
                                                        pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date";
                                            $result1 = $conn->query($sql1);
                                            if ($result1->num_rows > 0) {
                                                while ($row1 = $result1->fetch_assoc()) {
                                            ?>
                                        <tr>
                                            <td><?php echo $row1["pro_id"]; ?></td>
                                            <td><?php echo $row1["task_title"]; ?></td>
                                            <td><?php echo $row1["start_date"]; ?></td>
                                            <td><?php echo $row1["end_date"]; ?></td>
                                            <td><?php echo $row1["assign_users"]; ?></td>
                                            <td>
                                                <a href="projectDetails.php?id=<?php echo $row1['id']; ?>">
                                                    <i class="fa-solid fa-eye text-success"></i>
                                                </a>
                                                <a href="editProject.php?id=<?php echo $row1['id']; ?>">
                                                    <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                </a>
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
                    <div id="OfficeTasks" class="tabcontent">
                        <div class="card p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="">OfficeTasks</h6>
                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i>Add OfficeTasks
                            </button>
                        </div>
                            <table class="table table-bordered">
                                <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Project Title</th>
                                            <th>Start date</th>
                                            <th>End Date</th>
                                            <th>Assigned Users</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include "common/conn.php";                                         
                                            $sql2 = "SELECT pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date, 
                                                        GROUP_CONCAT(at.assign_user SEPARATOR ', ') AS assign_users
                                                        FROM  pro_task pt
                                                        JOIN  assign_task at
                                                        ON      pt.id = at.task_id
                                                        WHERE pt.pro_id = $proId AND pt.task_type = 'Office'
                                                        GROUP BY 
                                                        pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date";
                                            $result2 = $conn->query($sql2);
                                            if ($result2->num_rows > 0) {
                                                while ($row2 = $result2->fetch_assoc()) {
                                            ?>
                                        <tr>
                                            <td><?php echo $row2["pro_id"]; ?></td>
                                            <td><?php echo $row2["task_title"]; ?></td>
                                            <td><?php echo $row2["start_date"]; ?></td>
                                            <td><?php echo $row2["end_date"]; ?></td>
                                            <td><?php echo $row2["assign_users"]; ?></td>
                                            <td>
                                                <a href="projectDetails.php?id=<?php echo $row2['id']; ?>">
                                                    <i class="fa-solid fa-eye text-success"></i>
                                                </a>
                                                <a href="editProject.php?id=<?php echo $row2['id']; ?>">
                                                    <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                                </a>
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
                    <div id="projectsFiles" class="tabcontent">
                        <div class="card p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="">Projects Tasks</h6>
                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i>Add Tasks
                            </button>
                        </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>File Details</th>
                                        <th>File Url</th>
                                        <th>Assigned Users</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            include "common/conn.php";                                         
                                            $sql3 = "SELECT * FROM project_file WHERE pro_id='$proId'";
                                            $result3 = $conn->query($sql3);
                                            if ($result3->num_rows > 0) {
                                                while ($row3 = $result3->fetch_assoc()) {
                                            ?>
                                    <tr>
                                        <td><?php echo $row3["id"]; ?></td>
                                        <td><?php echo $row3["file_details"]; ?></td>
                                        <td><?php echo $row3["file_url"]; ?></td>
                                        <td><?php echo $row3["assigned_to"]; ?></td>
                                        <td>
                                            <a href="projectDetails.php?id=<?php echo $row3['id']; ?>">
                                                <i class="fa-solid fa-eye text-success"></i>
                                            </a>
                                            <a href="editProject.php?id=<?php echo $row3['id']; ?>">
                                                <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                            </a>
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
                    <div id="notes" class="tabcontent">
                        <div class="card p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="">Projects Tasks</h6>
                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i>Add Tasks
                            </button>
                        </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Project Title</th>
                                        <th>Start date</th>
                                        <th>End Date</th>
                                        <th>Assigned Users</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            include "common/conn.php";                                         
                                            $sql4 = "SELECT * FROM pro_notes WHERE pro_id='$proId'";
                                            $result4 = $conn->query($sql4);
                                            if ($result4->num_rows > 0) {
                                                while ($row4 = $result4->fetch_assoc()) {
                                            ?>
                                    <tr>
                                        <td><?php echo $row4["id"]; ?></td>
                                        <td><?php echo $row4["details"]; ?></td>
                                        <td><?php echo $row4["assign_to"]; ?></td>
                                        <td><?php echo $row4["pro_status"]; ?></td>
                                        <td>
                                            <a href="projectDetails.php?id=<?php echo $row4['id']; ?>">
                                                <i class="fa-solid fa-eye text-success"></i>
                                            </a>
                                            <a href="editProject.php?id=<?php echo $row4['id']; ?>">
                                                <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                            </a>
                                            <!-- <a href="deleteProject.php?id=<?php //echo $row['id']; ?>"><i class="fa-solid fa-trash text-danger"></i></a> -->
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
                    <div id="Expenses" class="tabcontent">
                        <div class="card p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="">Projects Tasks</h6>
                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i>Add Tasks
                            </button>
                        </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Details</th>
                                        <th>Assigned users</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            include "common/conn.php";                                         
                                            $sql5 = "SELECT * FROM pro_expenses WHERE pro_id	='$proId'";
                                            $result5 = $conn->query($sql5);
                                            if ($result5->num_rows > 0) {
                                                while ($row5 = $result5->fetch_assoc()) {
                                            ?>
                                    <tr>
                                        <td><?php echo $row5["id"]; ?></td>
                                        <td><?php echo $row5["details"]; ?></td>
                                        <td><?php echo $row5["assign_to"]; ?></td>
                                        <td><?php echo $row5["date"]; ?></td>
                                        <td><?php echo $row5["amount"]; ?></td>
                                        <td>
                                            <a href="projectDetails.php?id=<?php echo $row5['id']; ?>">
                                                <i class="fa-solid fa-eye text-success"></i>
                                            </a>
                                            <a href="editProject.php?id=<?php echo $row5['id']; ?>">
                                                <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                            </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script>
    function openDialog(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it to display the default tab
    document.getElementById("defaultOpen").click();
    </script>
</body>

</html>
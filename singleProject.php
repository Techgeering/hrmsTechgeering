<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Single Project - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
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

        /* color of value */
        .negative-amount {
            color: red;
        }

        .positive-amount {
            color: green;
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
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <?php
        include 'common/conn.php';
        // $proId = 2;
        // $proId = $_GET["id"];
        $proId = isset($_GET['id']) ? $_GET['id'] : NULL;
        $proId = base64_decode($proId);
        $sql = "SELECT * FROM project WHERE id ='$proId'";
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
                            View All Projects
                        </a>
                    </div>
                    <div class="tab profile">
                        <button class="tablinks" onclick="openDialog(event, 'ProjectView')" id="defaultOpen">Project
                            View</button>
                        <?php if ($em_role == '1' || $em_role == '4' || $em_role == '2') { ?>
                            <button class="tablinks" onclick="openDialog(event, 'ProjectTasks')"> Project Tasks </button>
                        <?php } ?>
                        <?php if ($em_role == '1' || $em_role == '4' || $em_role == '2') { ?>
                            <button class="tablinks" onclick="openDialog(event, 'OfficeTasks')"> Office Tasks </button>
                        <?php } ?>
                        <?php if ($em_role == '1' || $em_role == '4' || $em_role == '2') { ?>
                            <button class="tablinks" onclick="openDialog(event, 'projectsFiles')"> Projects Files </button>
                        <?php } ?>
                        <?php if ($em_role == '1' || $em_role == '4') { ?>
                            <button class="tablinks" onclick="openDialog(event, 'notes')"> Notes </button>
                        <?php } ?>
                        <?php if ($em_role == '1') { ?>
                            <button class="tablinks" onclick="openDialog(event, 'Expenses')"> Expenses </button>
                        <?php } ?>
                        <?php if ($em_role == '1') { ?>
                            <button class="tablinks" onclick="openDialog(event, 'Purchase')"> Purchase </button>
                        <?php } ?>
                        <?php if ($em_role == '1') { ?>
                            <button class="tablinks" onclick="openDialog(event, 'Users')"> Users </button>
                        <?php } ?>
                    </div>
                    <div id="ProjectView" class="tabcontent">
                        <div class="row">
                            <?php if ($em_role == '1') { ?>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="<?php echo $row["pro_image"];
                                            ?>" class="img-circle" width="150">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter">
                                                <i class="fas fa-pencil-alt edit-icon">Edit image</i>
                                            </button>
                                        </div>
                                        <div>
                                            <hr>
                                        </div>
                                        <div class="card-body">
                                            <small class="text-muted">Email address </small>
                                            <h6 class="edit">
                                                <?php echo !empty($row["pro_email"]) ? $row["pro_email"] : 'N/A'; ?>
                                            </h6>
                                            <input type="text" class='txtedit'
                                                value='<?php echo !empty($row["pro_email"]) ? $row["pro_email"] : 'N/A'; ?>'
                                                id='pro_email-<?php echo $row["id"]; ?>-project' style="display:none;">
                                            </input>
                                            <small class="text-muted p-t-30 db">Phone</small>
                                            <h6 class="edit">
                                                <?php echo !empty($row["pro_mobile"]) ? $row["pro_mobile"] : 'N/A'; ?>
                                            </h6>
                                            <input type="text" class='txtedit'
                                                value='<?php echo !empty($row["pro_mobile"]) ? $row["pro_mobile"] : 'N/A'; ?>'
                                                id='pro_mobile-<?php echo $row["id"]; ?>-project' style="display:none;">
                                            </input>
                                            <small class="text-muted p-t-30 db">GST Number</small>
                                            <h6 class="edit">
                                                <?php echo !empty($row["pro_gstno"]) ? $row["pro_gstno"] : 'N/A'; ?>
                                            </h6>
                                            <input type="text" class='txtedit'
                                                value='<?php echo !empty($row["pro_gstno"]) ? $row["pro_gstno"] : 'N/A'; ?>'
                                                id='pro_gstno-<?php echo $row["id"]; ?>-project' style="display:none;">
                                            </input>
                                            <small class="text-muted p-t-30 db">Address</small>
                                            <h6 class="edit">
                                                <?php echo !empty($row["pro_address"]) ? $row["pro_address"] : 'N/A'; ?>
                                            </h6>
                                            <input type="text" class='txtedit'
                                                value='<?php echo !empty($row["pro_address"]) ? $row["pro_address"] : 'N/A'; ?>'
                                                id='pro_address-<?php echo $row["id"]; ?>-project' style="display:none;">
                                            </input>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                <?php } else { ?>
                                    <div class="col-md-12">
                                    <?php } ?>
                                    <div class="row">
                                        <div class="form-group col-md-12 m-t-10">
                                            <label>Project Title </label>
                                            <?php if ($em_role == '1') { ?>
                                                <input type="text" class="form-control form-control-line edit"
                                                    value="<?php echo $row["pro_name"]; ?>" />
                                            <?php } else { ?>
                                                <p class="form-control form-control-line"><?php echo $row["pro_name"]; ?>
                                                </p>
                                            <?php } ?>
                                            <?php if ($em_role == '1') { ?>
                                                <input type="text" class='txtedit' value='<?php echo $row["pro_name"]; ?>'
                                                    id='pro_name-<?php echo $row["id"]; ?>-project' style="display:none;">
                                            <?php } ?>
                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Project Start Date </label>
                                            <?php if ($em_role == '1') { ?>
                                                <input type="text" class="form-control form-control-line edit"
                                                    value="<?php echo $row["pro_start_date"]; ?>" />
                                            <?php } else { ?>
                                                <p class="form-control form-control-line">
                                                    <?php echo $row["pro_start_date"]; ?>
                                                </p>
                                            <?php } ?>
                                            <?php if ($em_role == '1') { ?>
                                                <input type="date" class='txtedit'
                                                    value='<?php echo $row["pro_start_date"]; ?>'
                                                    id='pro_start_date-<?php echo $row["id"]; ?>-project'
                                                    style="display:none;">
                                            <?php } ?>
                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Project End Date</label>
                                            <?php if ($em_role == '1') { ?>
                                                <input type="text" class="form-control form-control-line edit"
                                                    value="<?php echo $row["pro_end_date"]; ?>" />
                                            <?php } else { ?>
                                                <p class="form-control form-control-line">
                                                    <?php echo $row["pro_end_date"]; ?>
                                                </p>
                                            <?php } ?>
                                            <?php if ($em_role == '1') { ?>
                                                <input type="date" class='txtedit'
                                                    value='<?php echo $row["pro_end_date"]; ?>'
                                                    id='pro_end_date-<?php echo $row["id"]; ?>-project'
                                                    style="display:none;">
                                            <?php } ?>
                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Status</label>
                                            <?php if ($em_role == '1') { ?>
                                                <p class="form-control form-control-line edit"
                                                    onclick="showDropdown('pro_status-<?php echo $row['id']; ?>-project')">
                                                    <?php echo $row["pro_status"]; ?>
                                                </p>
                                                <select class='txtedit' id='pro_status-<?php echo $row["id"]; ?>-project'
                                                    style="display:none;">
                                                    <option value="upcoming" <?php if ($row["pro_status"] == "upcoming")
                                                        echo 'selected="selected"'; ?>>upcoming
                                                    </option>
                                                    <option value="complete" <?php if ($row["pro_status"] == "complete")
                                                        echo 'selected="selected"'; ?>>complete
                                                    </option>
                                                    <option value="running" <?php if ($row["pro_status"] == "running")
                                                        echo 'selected="selected"'; ?>>running</option>
                                                    <option value="hold" <?php if ($row["pro_status"] == "Hold")
                                                        echo 'selected="selected"'; ?>>hold</option>
                                                </select>
                                            <?php } else { ?>
                                                <p class="form-control form-control-line">
                                                    <?php echo $row["pro_status"]; ?>
                                                </p>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group col-md-12 m-t-10">
                                            <div class="form-group col-md-12 m-t-10">
                                                <label>Project Summary </label>
                                                <?php if ($em_role == '1') { ?>
                                                    <!-- <textarea class="form-control form-control-line edit"
                                                        value="<?php echo $row["pro_summary"]; ?>"></textarea> -->
                                                    <input type="text" class="form-control form-control-line edit"
                                                        value="<?php echo $row["pro_summary"]; ?>">
                                                <?php } else { ?>
                                                    <p class="form-control form-control-line">
                                                        <?php echo $row["pro_summary"]; ?>
                                                    </p>
                                                <?php } ?>
                                                <?php if ($em_role == '1') { ?>
                                                    <textarea class='txtedit'
                                                        id='pro_summary-<?php echo $row["id"]; ?>-project'
                                                        style="display:none;"><?php echo $row["pro_summary"]; ?></textarea>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 m-t-10">
                                            <label>Details</label>
                                            <?php if ($em_role == '1') { ?>
                                                <textarea class="form-control form-control-line col-6 edit" rows="6"
                                                    cols="80"><?php echo $row["pro_description"]; ?></textarea>
                                            <?php } else { ?>
                                                <p class="form-control form-control-line">
                                                    <?php echo $row["pro_description"]; ?>
                                                </p>
                                            <?php } ?>
                                            <?php if ($em_role == '1') { ?>
                                                <textarea class='txtedit'
                                                    id='pro_description-<?php echo $row["id"]; ?>-project'
                                                    style="display:none; width:100%; height:150px;"><?php echo $row["pro_description"]; ?></textarea>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ProjectTasks" class="tabcontent">
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
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">Project Title</th>
                                            <th class="text-center">Start date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">Assigned Manager</th>
                                            <th class="text-center">Assigned Employees</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Desc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "common/conn.php";
                                        if ($em_role == '4') {
                                            // Admin or similar role
                                            $sql1 = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                        FROM pro_task pt
                                                        LEFT JOIN assign_task at ON pt.id = at.task_id WHERE pt.pro_id = $proId 
                                                        AND pt.task_type = 'Field' 
                                                        AND FIND_IN_SET('$em_code', at.assign_user) > 0
                                                    GROUP BY pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date ORDER BY 
                                                        CASE 
                                                           WHEN status = 'Not Started' THEN 1
                                                            WHEN status = 'Started' THEN 2
                                                            WHEN status = 'Testing' THEN 3
                                                            WHEN status = 'Complete' THEN 4
                                                            WHEN status = 'Cancel' THEN 5
                                                            ELSE 6 
                                                        END";
                                        } elseif ($em_role == '2') {
                                            $sql1 = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                        FROM pro_task pt
                                                        LEFT JOIN assign_task at ON pt.id = at.task_id
                                                        WHERE pt.pro_id = $proId AND pt.task_type = 'Field' AND 
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') = '$em_code'
                                                        GROUP BY pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date ORDER BY 
                                                        CASE 
                                                            WHEN status = 'Not Started' THEN 1
                                                            WHEN status = 'Started' THEN 2
                                                            WHEN status = 'Testing' THEN 3
                                                            WHEN status = 'Complete' THEN 4
                                                            WHEN status = 'Cancel' THEN 5
                                                            ELSE 6 
                                                        END";
                                        } else {
                                            // General user or other roles
                                            $sql1 = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                    FROM pro_task pt
                                                    LEFT JOIN assign_task at ON pt.id = at.task_id
                                                    WHERE pt.pro_id = $proId AND pt.task_type = 'Field'
                                                    GROUP BY pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date ORDER BY 
                                                        CASE 
                                                             WHEN status = 'Not Started' THEN 1
                                                            WHEN status = 'Started' THEN 2
                                                            WHEN status = 'Testing' THEN 3
                                                            WHEN status = 'Complete' THEN 4
                                                            WHEN status = 'Cancel' THEN 5
                                                            ELSE 6 
                                                        END";
                                        }
                                        $result1 = $conn->query($sql1);
                                        $slno = 1;
                                        if ($result1->num_rows > 0) {
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $idd = $row1["pro_task_id"];
                                                $teamHeadId = $row1["team_head_id"];
                                                $collaboratorId = $row1["collaborator_id"];
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $slno; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row1['task_title']; ?></p>
                                                            <input type="text" class='txtedit'
                                                                value='<?php echo $row1["task_title"]; ?>'
                                                                id='task_title-<?php echo $row1["pro_task_id"]; ?>-pro_task'
                                                                style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row1['task_title']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row1['start_date']; ?></p>
                                                            <input type="date" class='txtedit'
                                                                value='<?php echo $row1["start_date"]; ?>'
                                                                id='start_date-<?php echo $row1["pro_task_id"]; ?>-pro_task'
                                                                style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row1['start_date']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row1['end_date']; ?></p>
                                                            <input type="date" class='txtedit'
                                                                value='<?php echo $row1["end_date"]; ?>'
                                                                id='end_date-<?php echo $row1["pro_task_id"]; ?>-pro_task'
                                                                style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row1['end_date']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3' || $em_role == '2') { ?>
                                                            <p class="edit">
                                                                <?php
                                                                $asign_manager = $row1['assigned_manager'];
                                                                $sql34 = "SELECT * FROM employee WHERE em_code = '$asign_manager' AND em_role = '2'";
                                                                $result34 = $conn->query($sql34);
                                                                $row34 = $result34->fetch_assoc();
                                                                echo $row34["full_name"];
                                                                ?>
                                                            </p>
                                                            <select class='txtedit' value='<?php echo $row1['assign_user']; ?>'
                                                                id='assign_user-<?php echo $row1["team_head_id"]; ?>-assign_task'
                                                                style="display: none;">
                                                                <?php
                                                                include "common/conn.php";
                                                                $sqlproject = "SELECT * FROM employee WHERE em_role = '2'";
                                                                $resultproject = $conn->query($sqlproject);
                                                                while ($rowproject = $resultproject->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $rowproject['em_code']; ?>">
                                                                        <?php echo $rowproject['full_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } else { ?>
                                                            <p><?php
                                                            $asign_manager = $row1['assigned_manager'];
                                                            $sql34 = "SELECT * FROM employee WHERE em_code = '$asign_manager' AND em_role = '2'";
                                                            $result34 = $conn->query($sql34);
                                                            $row34 = $result34->fetch_assoc();
                                                            echo $row34["full_name"];
                                                            ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3' || $em_role == '2') { ?>
                                                            <div class="d-flex align-items-center">
                                                                <p class="mb-0 assigned-names">
                                                                    <?php
                                                                    $asign = $row1['assign_users'];
                                                                    $asignArray = explode(',', $asign);
                                                                    $asignArray = array_map('trim', $asignArray);
                                                                    $asignList = implode("','", $asignArray);

                                                                    // Fetch all employee names
                                                                    $sql33 = "SELECT full_name, em_code FROM employee WHERE em_role = '4'";
                                                                    $result33 = $conn->query($sql33);
                                                                    $employeeNames = [];
                                                                    while ($row33 = $result33->fetch_assoc()) {
                                                                        $employeeNames[$row33['em_code']] = $row33['full_name'];
                                                                    }

                                                                    // Display assigned employee names with delete icon
                                                                    $assignedNames = [];
                                                                    foreach ($asignArray as $code) {
                                                                        if (isset($employeeNames[$code])) {
                                                                            $assignedNames[] = $employeeNames[$code];
                                                                            echo '<span class="assigned-name-item">' . $employeeNames[$code] .
                                                                                ' <i class="fa fa-times delete-icon" onclick="deleteName(\'' . $code . '\', ' . $row1['pro_task_id'] . ')"></i></span> ';
                                                                        }
                                                                    }
                                                                    echo !empty($assignedNames) ? '' : "No employees assigned.";
                                                                    ?>
                                                                </p>
                                                                <!-- Select Dropdown -->
                                                                <select class="txtedit form-select"
                                                                    id="assign_users-<?php echo $row1['collaborator_id']; ?>-assign_task"
                                                                    style="display: none;"
                                                                    onchange="saveSelectedName(this.value, '<?php echo $row1['pro_task_id']; ?>')">
                                                                    <option value="">Select a user</option>
                                                                    <?php
                                                                    // Populate select options with employee names
                                                                    foreach ($employeeNames as $code => $name) {
                                                                        echo '<option value="' . htmlspecialchars($code) . '">' . htmlspecialchars($name) . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <!-- Button to toggle visibility of the select element -->
                                                                <button class="btn btn-outline-primary ms-2" type="button"
                                                                    onclick="toggleSelect('<?php echo $row1['collaborator_id']; ?>')">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <?php
                                                            $asign = $row1['assign_users'];
                                                            $asignArray = explode(',', $asign);
                                                            $asignArray = array_map('trim', $asignArray);
                                                            $asignList = implode("','", $asignArray);

                                                            // Fetch all employee names
                                                            $sql33 = "SELECT full_name, em_code FROM employee WHERE em_role = '4'";
                                                            $result33 = $conn->query($sql33);
                                                            $employeeNames = [];
                                                            while ($row33 = $result33->fetch_assoc()) {
                                                                $employeeNames[$row33['em_code']] = $row33['full_name'];
                                                            }

                                                            // Display assigned employee names
                                                            $assignedNames = [];
                                                            foreach ($asignArray as $code) {
                                                                if (isset($employeeNames[$code])) {
                                                                    $assignedNames[] = $employeeNames[$code];
                                                                }
                                                            }

                                                            if (!empty($assignedNames)) {
                                                                // Display the names separated by commas
                                                                echo implode(', ', $assignedNames);
                                                            } else {
                                                                echo "No employees assigned.";
                                                            }
                                                            ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="form-control form-control-line edit"
                                                            onclick="showDropdown('status-<?php echo $row1['pro_task_id']; ?>-pro_task')">
                                                            <?php echo $row1["status"]; ?>
                                                        </p>
                                                        <select class='txtedit'
                                                            id='status-<?php echo $row1["pro_task_id"]; ?>-pro_task'
                                                            style="display:none;">
                                                            <option value="Not Started" <?php if ($row1["status"] == "Not Started")
                                                                echo 'selected="selected"'; ?>>Not Started
                                                            </option>
                                                            <option value="Started" <?php if ($row1["status"] == "Started")
                                                                echo 'selected="selected"'; ?>>Started
                                                            </option>
                                                            <option value="Testing" <?php if ($row1["status"] == "Testing")
                                                                echo 'selected="selected"'; ?>>Testing
                                                            </option>
                                                            <option value="Complete" <?php if ($row1["status"] == "Complete")
                                                                echo 'selected="selected"'; ?>>Complete
                                                            </option>
                                                            <option value="Cancel" <?php if ($row1["status"] == "Cancel")
                                                                echo 'selected="selected"'; ?>>Cancel
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#paragraphmodal_<?php echo $idd; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="paragraphmodal_<?php echo $idd; ?>" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <?php
                                                            $sql17 = "SELECT * FROM pro_task WHERE id =$idd";
                                                            $result17 = $conn->query($sql17);
                                                            $row17 = $result17->fetch_assoc();
                                                            ?>
                                                            <!-- <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <div class="col-md-12">
                                                                        <strong>Project Description:</strong>
                                                                        <?php echo $row17["description"]; ?>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <div class="col-md-12">
                                                                        <strong>Project Description:</strong>
                                                                        <?php if ($em_role == '1') { ?>
                                                                            <textarea
                                                                                class="form-control form-control-line col-6 edit"
                                                                                rows="6"
                                                                                cols="80"><?php echo $row17["description"]; ?></textarea>
                                                                        <?php } else { ?>
                                                                            <textarea class="form-control form-control-line"
                                                                                rows="6" cols="80" readonly>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php echo htmlspecialchars($row17["description"]); ?></textarea>
                                                                        <?php } ?>
                                                                        <?php if ($em_role == '1') { ?>
                                                                            <textarea class='txtedit'
                                                                                id='description-<?php echo $row17["id"]; ?>-pro_task'
                                                                                style="display:none; width:100%; height:150px;"><?php echo $row17["description"]; ?></textarea>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">Project Title</th>
                                            <th class="text-center">Start date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">Assigned Manager</th>
                                            <th class="text-center">Assigned Employees</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "common/conn.php";
                                        if ($em_role == '4') {

                                            $sql2 = "SELECT pt.id AS pro_task_id, 
                                                (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                FROM pro_task pt
                                                LEFT JOIN assign_task at ON pt.id = at.task_id
                                                WHERE pt.pro_id = $proId 
                                                AND pt.task_type = 'Office' 
                                                AND FIND_IN_SET('$em_code', at.assign_user) > 0
                                                GROUP BY pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date ORDER BY 
                                                        CASE 
                                                           WHEN status = 'Not Started' THEN 1
                                                            WHEN status = 'Started' THEN 2
                                                            WHEN status = 'Testing' THEN 3
                                                            WHEN status = 'Complete' THEN 4
                                                            WHEN status = 'Cancel' THEN 5
                                                            ELSE 6 
                                                        END";
                                        } elseif ($em_role == '2') {
                                            // Team Head role
                                            $sql2 = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                    FROM pro_task pt
                                                    LEFT JOIN assign_task at ON pt.id = at.task_id
                                                    WHERE pt.pro_id = $proId AND pt.task_type = 'Office' AND 
                                                    (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') = '$em_code'
                                                    GROUP BY pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date ORDER BY 
                                                        CASE 
                                                           WHEN status = 'Not Started' THEN 1
                                                            WHEN status = 'Started' THEN 2
                                                            WHEN status = 'Testing' THEN 3
                                                            WHEN status = 'Complete' THEN 4
                                                            WHEN status = 'Cancel' THEN 5
                                                            ELSE 6 
                                                        END";
                                        } else {
                                            // General user or other roles
                                            $sql2 = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                    FROM pro_task pt
                                                    LEFT JOIN assign_task at ON pt.id = at.task_id
                                                    WHERE pt.pro_id = $proId AND pt.task_type = 'Office'
                                                    GROUP BY pt.id, pt.pro_id, pt.task_title, pt.start_date, pt.end_date ORDER BY 
                                                        CASE 
                                                           WHEN status = 'Not Started' THEN 1
                                                            WHEN status = 'Started' THEN 2
                                                            WHEN status = 'Testing' THEN 3
                                                            WHEN status = 'Complete' THEN 4
                                                            WHEN status = 'Cancel' THEN 5
                                                            ELSE 6 
                                                        END";
                                        }
                                        $result2 = $conn->query($sql2);
                                        $slno = 1;
                                        if ($result2->num_rows > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                $idd2 = $row2["pro_task_id"];
                                                $teamHeadId = $row2["team_head_id"];
                                                $collaboratorId = $row2["collaborator_id"];
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $slno; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row2['task_title']; ?></p>
                                                            <input type="text" class='txtedit'
                                                                value='<?php echo $row2["task_title"]; ?>'
                                                                id='task_title-<?php echo $row2["pro_task_id"]; ?>-pro_task'
                                                                style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row2['task_title']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row2['start_date']; ?></p>
                                                            <input type="date" class='txtedit'
                                                                value='<?php echo $row2["start_date"]; ?>'
                                                                id='start_date-<?php echo $row2["pro_task_id"]; ?>-pro_task'
                                                                style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row2['start_date']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row2['end_date']; ?></p>
                                                            <input type="date" class='txtedit'
                                                                value='<?php echo $row2["end_date"]; ?>'
                                                                id='end_date-<?php echo $row2["pro_task_id"]; ?>-pro_task'
                                                                style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row2['end_date']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3' || $em_role == '2') { ?>
                                                            <p class="edit">
                                                                <?php
                                                                $asign_manager1 = $row2['assigned_manager'];
                                                                $sql35 = "SELECT * FROM employee WHERE em_code = '$asign_manager1' AND em_role = '2'";
                                                                $result35 = $conn->query($sql35);
                                                                $row35 = $result35->fetch_assoc();
                                                                echo $row35["full_name"];
                                                                ?>
                                                            </p>
                                                            <select class='txtedit' value='<?php echo $row2['assigned_manager']; ?>'
                                                                id='assign_user-<?php echo $row2["team_head_id"]; ?>-assign_task'
                                                                style="display: none;">
                                                                <?php
                                                                include "common/conn.php";
                                                                $sqlproject1 = "SELECT * FROM employee WHERE em_role = '2'";
                                                                $resultproject1 = $conn->query($sqlproject1);
                                                                while ($rowproject1 = $resultproject1->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $rowproject1['em_code']; ?>">
                                                                        <?php echo $rowproject1['full_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } else { ?>
                                                            <p><?php
                                                            $asign_manager1 = $row2['assigned_manager'];
                                                            $sql35 = "SELECT * FROM employee WHERE em_code = '$asign_manager' AND em_role = '2'";
                                                            $result35 = $conn->query($sql35);
                                                            $row35 = $result35->fetch_assoc();
                                                            echo $row35["full_name"];
                                                            ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3' || $em_role == '2') { ?>
                                                            <div class="d-flex align-items-center">
                                                                <p class="mb-0 assigned-names">
                                                                    <?php
                                                                    $asign1 = $row2['assign_users'];
                                                                    $asignArray1 = explode(',', $asign1);
                                                                    $asignArray1 = array_map('trim', $asignArray1);
                                                                    $asignList1 = implode("','", $asignArray1);

                                                                    // Fetch all employee names
                                                                    $sql33 = "SELECT full_name, em_code FROM employee WHERE em_role = '4'";
                                                                    $result33 = $conn->query($sql33);
                                                                    $employeeNames = [];
                                                                    while ($row33 = $result33->fetch_assoc()) {
                                                                        $employeeNames[$row33['em_code']] = $row33['full_name'];
                                                                    }

                                                                    // Display assigned employee names with delete icon
                                                                    $assignedNames = [];
                                                                    foreach ($asignArray1 as $code) {
                                                                        if (isset($employeeNames[$code])) {
                                                                            $assignedNames[] = $employeeNames[$code];
                                                                            echo '<span class="assigned-name-item">' . $employeeNames[$code] .
                                                                                ' <i class="fa fa-times delete-icon" onclick="deleteName(\'' . $code . '\', ' . $row2['pro_task_id'] . ')"></i></span> ';
                                                                        }
                                                                    }
                                                                    echo !empty($assignedNames) ? '' : "No employees assigned.";
                                                                    ?>
                                                                </p>
                                                                <!-- Select Dropdown -->
                                                                <select class="txtedit form-select"
                                                                    id="assign_users-<?php echo $row2['collaborator_id']; ?>-assign_task"
                                                                    style="display: none;"
                                                                    onchange="saveSelectedName(this.value, '<?php echo $row2['pro_task_id']; ?>')">
                                                                    <option value="">Select a user</option>
                                                                    <?php
                                                                    // Populate select options with employee names
                                                                    foreach ($employeeNames as $code => $name) {
                                                                        echo '<option value="' . htmlspecialchars($code) . '">' . htmlspecialchars($name) . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <!-- Button to toggle visibility of the select element -->
                                                                <button class="btn btn-outline-primary ms-2" type="button"
                                                                    onclick="toggleSelect('<?php echo $row2['collaborator_id']; ?>')">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <?php
                                                            $asign1 = $row2['assign_users'];
                                                            $asignArray1 = explode(',', $asign1);
                                                            $asignArray1 = array_map('trim', $asignArray1);
                                                            $asignList1 = implode("','", $asignArray1);

                                                            // Fetch all employee names
                                                            $sql33 = "SELECT full_name, em_code FROM employee WHERE em_role = '4'";
                                                            $result33 = $conn->query($sql33);
                                                            $employeeNames = [];
                                                            while ($row33 = $result33->fetch_assoc()) {
                                                                $employeeNames[$row33['em_code']] = $row33['full_name'];
                                                            }

                                                            // Display assigned employee names with delete icon
                                                            $assignedNames = [];
                                                            foreach ($asignArray1 as $code) {
                                                                if (isset($employeeNames[$code])) {
                                                                    $assignedNames[] = $employeeNames[$code];
                                                                    echo '<span class="assigned-name-item">' . $employeeNames[$code] .
                                                                        '</span> ';
                                                                }
                                                            }
                                                            echo !empty($assignedNames) ? '' : "No employees assigned.";
                                                            ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <p class="form-control form-control-line edit"
                                                            onclick="showDropdown('status-<?php echo $row2['pro_task_id']; ?>-pro_task')">
                                                            <?php echo $row2["status"]; ?>
                                                        </p>
                                                        <select class='txtedit'
                                                            id='status-<?php echo $row2["pro_task_id"]; ?>-pro_task'
                                                            style="display:none;">
                                                            <option value="Not Started" <?php if ($row2["status"] == "Not Started")
                                                                echo 'selected="selected"'; ?>>Not Started
                                                            </option>
                                                            <option value="Started" <?php if ($row2["status"] == "Started")
                                                                echo 'selected="selected"'; ?>>Started
                                                            </option>
                                                            <option value="Testing" <?php if ($row2["status"] == "Testing")
                                                                echo 'selected="selected"'; ?>>Testing
                                                            </option>
                                                            <option value="Complete" <?php if ($row2["status"] == "Complete")
                                                                echo 'selected="selected"'; ?>>Complete
                                                            </option>
                                                            <option value="Cancel" <?php if ($row2["status"] == "Cancel")
                                                                echo 'selected="selected"'; ?>>Cancel
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#paragraphmodal2_<?php echo $idd2; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="paragraphmodal2_<?php echo $idd2; ?>" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <?php
                                                            $sql18 = "SELECT * FROM pro_task WHERE id =$idd2";
                                                            $result18 = $conn->query($sql18);
                                                            $row18 = $result18->fetch_assoc();
                                                            ?>
                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <div class="col-md-12">
                                                                        <strong>Project Description:</strong>
                                                                        <?php if ($em_role == '1') { ?>
                                                                            <textarea
                                                                                class="form-control form-control-line col-6 edit"
                                                                                rows="6"
                                                                                cols="80"><?php echo $row18["description"]; ?></textarea>
                                                                        <?php } else { ?>
                                                                            <textarea class="form-control form-control-line col-6"
                                                                                rows="6" col="80" readonly>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php echo $row18["description"]; ?></textarea>
                                                                        <?php } ?>
                                                                        <?php if ($em_role == '1') { ?>
                                                                            <textarea class='txtedit'
                                                                                id='description-<?php echo $row18["id"]; ?>-pro_task'
                                                                                style="display:none; width:100%; height:150px;"><?php echo $row18["description"]; ?></textarea>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <div id="projectsFiles" class="tabcontent">
                            <div class="card p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="">Projects Files</h6>
                                    <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                        data-bs-target="#addfiles">
                                        <i class="fa-solid fa-plus"></i>Add Files
                                    </button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">File Details</th>
                                            <th class="text-center">Upload Document</th>
                                            <th class="text-center">Assigned Users</th>
                                            <!-- <th class="text-center">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "common/conn.php";
                                        if ($em_role == '4' || $em_role == '2') {
                                            $sql3 = "SELECT * FROM project_file WHERE pro_id='$proId' AND assigned_to = '$name'";
                                        } else {
                                            $sql3 = "SELECT * FROM project_file WHERE pro_id='$proId'";
                                        }
                                        $result3 = $conn->query($sql3);
                                        $slno = 1;
                                        if ($result3->num_rows > 0) {
                                            while ($row3 = $result3->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $slno; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row3['file_details']; ?></p>
                                                            <input type="text" class='txtedit'
                                                                value='<?php echo $row3["file_details"]; ?>'
                                                                id='file_details-<?php echo $row3["id"]; ?>-project_file'
                                                                name="pdf_file" style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row3['file_details']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="uploads/<?php echo $row3["file_url"]; ?>" target="_blank">
                                                            <i class="fas fa-file-pdf" style="font-size: 20px; color: red;"></i>
                                                        </a>
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <i class="fas fa-edit"
                                                                style="font-size: 20px; color: blue; cursor: pointer;"
                                                                onclick="showFileInput(<?php echo $row3['id']; ?>)"></i>
                                                        <?php } ?>
                                                        <input type="file" id="fileInput-<?php echo $row3['id']; ?>"
                                                            style="display: none;"
                                                            onchange="uploadFile(<?php echo $row3['id']; ?>)">
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row3['assigned_to']; ?></p>
                                                            <select class='txtedit' value='<?php echo $row3['assigned_to']; ?>'
                                                                id='assigned_to-<?php echo $row3["id"]; ?>-project_file'
                                                                style="display: none;">
                                                                <?php
                                                                include "common/conn.php";
                                                                $sqlnotes = "SELECT * FROM employee";
                                                                $resultnotes = $conn->query($sqlnotes);
                                                                while ($rownotes = $resultnotes->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $rownotes['full_name']; ?>">
                                                                        <?php echo $rownotes['full_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } else { ?>
                                                            <p><?php echo $row3['assigned_to']; ?></p>
                                                        <?php } ?>
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
                        <div id="notes" class="tabcontent">
                            <div class="card p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="">Projects Notes</h6>
                                    <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                        data-bs-target="#addnotes">
                                        <i class="fa-solid fa-plus"></i>Add Notes
                                    </button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">Project Details</th>
                                            <th class="text-center">Assigned Users</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "common/conn.php";
                                        if ($em_role == '4' || $em_role == '2') {
                                            $sql4 = "SELECT * FROM pro_notes WHERE pro_id='$proId' AND assign_to = '$name'";
                                        } else {
                                            $sql4 = "SELECT * FROM pro_notes WHERE pro_id='$proId'";
                                        }
                                        $result4 = $conn->query($sql4);
                                        $slno = 1;
                                        if ($result4->num_rows > 0) {
                                            while ($row4 = $result4->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $slno; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row4['details']; ?></p>
                                                            <input type="text" class='txtedit'
                                                                value='<?php echo $row4["details"]; ?>'
                                                                id='details-<?php echo $row4["id"]; ?>-pro_notes'
                                                                style="display: none;">
                                                            </input>
                                                        <?php } else { ?>
                                                            <p><?php echo $row4['details']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                            <p class="edit"><?php echo $row4['assign_to']; ?></p>
                                                            <select class='txtedit'
                                                                id='assign_to-<?php echo $row4["id"]; ?>-pro_notes'
                                                                style="display: none;">
                                                                <?php
                                                                include "common/conn.php";
                                                                $sqlnotes = "SELECT * FROM employee WHERE em_role = '4'";
                                                                $resultnotes = $conn->query($sqlnotes);
                                                                while ($rownotes = $resultnotes->fetch_assoc()) {
                                                                    $selected = ($rownotes['full_name'] == $row4['assign_to']) ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?php echo $rownotes['full_name']; ?>" <?php echo $selected; ?>>
                                                                        <?php echo $rownotes['full_name']; ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        <?php } else { ?>
                                                            <p><?php echo $row4['assign_to']; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="form-control form-control-line edit"
                                                            onclick="showDropdown('pro_status-<?php echo $row4['id']; ?>-pro_notes')">
                                                            <?php echo $row4["pro_status"]; ?>
                                                        </p>
                                                        <select class='txtedit'
                                                            id='pro_status-<?php echo $row4["id"]; ?>-pro_notes'
                                                            style="display:none;">
                                                            <option value="Not Started" <?php if ($row4["pro_status"] == "Not Started")
                                                                echo 'selected="selected"'; ?>>Not Started
                                                            </option>
                                                            <option value="Started" <?php if ($row4["pro_status"] == "Started")
                                                                echo 'selected="selected"'; ?>>Started
                                                            </option>
                                                            <option value="Complete" <?php if ($row4["pro_status"] == "Complete")
                                                                echo 'selected="selected"'; ?>>Complete
                                                            </option>
                                                            <option value="Testing" <?php if ($row4["pro_status"] == "Testing")
                                                                echo 'selected="selected"'; ?>>Testing
                                                            </option>
                                                            <option value="Done" <?php if ($row4["pro_status"] == "Done")
                                                                echo 'selected="selected"'; ?>>Done
                                                            </option>
                                                            <option value="Cancel" <?php if ($row4["pro_status"] == "Cancel")
                                                                echo 'selected="selected"'; ?>>Cancel
                                                            </option>
                                                        </select>
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
                        <div id="Expenses" class="tabcontent">
                            <div class="card p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <?php
                                    include "common/conn.php";
                                    $sql_c =
                                        "SELECT 
                                                    SUM(deposite) AS total, 
                                                    SUM(withdraw) AS totall 
                                                FROM (
                                                    SELECT deposite, withdraw FROM account WHERE pro_id='$proId'
                                                    UNION ALL
                                                    SELECT deposite, withdraw FROM pro_expenses WHERE pro_id='$proId'
                                                ) AS combined";

                                    $result_c = $conn->query($sql_c);
                                    if ($result_c->num_rows > 0) {
                                        $row_c = $result_c->fetch_assoc();
                                        $depositetotal = $row_c['total'];
                                        $withdrawtotal = $row_c['totall'];
                                        $balance = $depositetotal - $withdrawtotal;
                                    }
                                    ?>
                                    <h6 class="">Projects Expenses:-<?php echo $balance; ?></h6>
                                    <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                        data-bs-target="#addExpences">
                                        <i class="fa-solid fa-plus"></i>Add Expenses
                                    </button>

                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Assigned users</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Tax Type</th>
                                            <th class="text-center">Deposite</th>
                                            <th class="text-center">Withdraw</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql5 = "SELECT * FROM (
                                            SELECT date, assign_to, particulars, tex_type, deposite, withdraw FROM account WHERE pro_id='$proId'
                                            UNION ALL
                                            SELECT date, assign_to, particulars, tex_type, deposite, withdraw FROM pro_expenses WHERE pro_id='$proId'
                                        ) AS combined ORDER BY date DESC";
                                        $result5 = $conn->query($sql5);
                                        $slno = 1;
                                        if ($result5->num_rows > 0) {
                                            while ($row5 = $result5->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $row5['date']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row5['assign_to']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row5['particulars']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row5['tex_type']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row5['deposite']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row5['withdraw']; ?>
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
                        <div id="Purchase" class="tabcontent">
                            <div class="card p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                        data-bs-target="#addPurchase">
                                        <i class="fa-solid fa-plus"></i>Purchase
                                    </button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sl.No</th>
                                            <th class="text-center">Service Name</th>
                                            <th class="text-center">Date Of Purchase</th>
                                            <th class="text-center">Service Start Date</th>
                                            <th class="text-center">Service End Date</th>
                                            <th class="text-center">Duration</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Renewal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "common/conn.php";
                                        $sqlpur = "SELECT * FROM purchase WHERE pro_id='$proId'";
                                        $resultpur = $conn->query($sqlpur);
                                        $slno = 1;
                                        if ($resultpur->num_rows > 0) {
                                            while ($rowpur = $resultpur->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $slno; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        $service_id = $rowpur["service_id"];
                                                        $stmt = $conn->prepare("SELECT service_name FROM service WHERE id = ?");
                                                        $stmt->bind_param("i", $service_id);
                                                        $stmt->execute();
                                                        $result1 = $stmt->get_result();
                                                        if ($row1 = $result1->fetch_assoc()) {
                                                            echo htmlspecialchars($row1["service_name"], ENT_QUOTES, 'UTF-8');
                                                        }
                                                        $stmt->close();
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?php echo $rowpur["date_of_purchase"]; ?></td>
                                                    <td class="text-center"><?php echo $rowpur["ser_start_dt"]; ?></td>
                                                    <td class="text-center"><?php echo $rowpur["ser_end_dt"]; ?></td>
                                                    <td class="text-center"><?php echo $rowpur["duration"]; ?> Days</td>
                                                    <td class="text-center">
                                                        <?php
                                                        $enddate = $rowpur["ser_end_dt"];
                                                        $today = date('Y-m-d');
                                                        if ($today > $enddate) {
                                                            $status = 0;
                                                        } else {
                                                            $status = 1;
                                                        }
                                                        if ($status === 0) {
                                                            echo "<span style='color: red;'>Expired</span>";
                                                        } else {
                                                            echo "<span style='color: green;'>Not Expired</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <i class="fa fa-refresh" aria-hidden="true" data-bs-toggle="modal"
                                                            onclick="myfcn10(<?php echo $rowpur['id']; ?>,'<?php echo $rowpur['service_id']; ?>')"
                                                            data-bs-target="#renewal"></i>
                                                    </td>
                                                </tr>
                                                <?php
                                                $slno++;
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
                        <!-- purchase update modal -->
                        <div class="modal fade" id="renewal" tabindex="-1" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Renewal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form name="form_pur1" id="form_pur1" method="post">
                                        <div class="modal-body">
                                            <input type="hidden" name="id10" id="id10">
                                            <div class="row">
                                                <input type="hidden" class="form-control" value="<?php echo $proId; ?>"
                                                    id="project_name" name="project_name" required>
                                                <div class="col-12">
                                                    <div class="mb-2">
                                                        <label for="assigned_users" class="form-label">Service
                                                            Name</label>
                                                        <select class="form-control" name="service_name"
                                                            id="service_namee1">
                                                            <option value="" disabled selected>Select a Service</option>
                                                            <?php
                                                            include "common/conn.php";
                                                            $sql_service = "SELECT * FROM service";
                                                            $result_service = $conn->query($sql_service);
                                                            while ($row_service = $result_service->fetch_assoc()) {
                                                                ?>
                                                                <option value="<?php echo $row_service['id']; ?>">
                                                                    <?php echo $row_service['service_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="insurance_company">Date Of Purchase</label>
                                                    <input type="date" class="form-control" name="date_of_pur"
                                                        id="date_of_purchase" value="<?php echo date('Y-m-d'); ?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Service Start Date</label>
                                                    <input type="date" class="form-control"
                                                        value="<?php echo date('Y-m-d'); ?>" name="service_start_dt"
                                                        id="service_start_date1" onchange="calculateDuration1()">
                                                </div>
                                                <div class="col-6">
                                                    <label>Service End Date</label>
                                                    <input type="date" class="form-control" name="service_end_dt"
                                                        id="service_end_date1" onchange="calculateDuration1()">
                                                </div>
                                                <div class="col-6">
                                                    <label>Duration</label>
                                                    <input type="text" class="form-control" name="duration1"
                                                        id="duration12" readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"
                                                    name="project_purchase">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="Users" class="tabcontent">
                            <div class="card p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="">Users</h6>
                                    <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                        data-bs-target="#addUsers">
                                        <i class="fa-solid fa-plus"></i>Add Users
                                    </button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Mobile Number</th>
                                            <th class="text-center">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "common/conn.php";
                                        $sql8 = "SELECT * FROM representative WHERE pro_id='$proId'";
                                        $result8 = $conn->query($sql8);
                                        $slno = 1;
                                        if ($result8->num_rows > 0) {
                                            while ($row8 = $result8->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $slno; ?></td>
                                                    <td class="text-center">
                                                        <p class="edit"><?php echo $row8['user_name']; ?></p>
                                                        <input type="text" class='txtedit'
                                                            value='<?php echo $row8["user_name"]; ?>'
                                                            id='user_name-<?php echo $row8["id"]; ?>-representative'
                                                            style="display: none;">
                                                        </input>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="edit"><?php echo $row8['user_designation']; ?></p>
                                                        <input type="text" class='txtedit'
                                                            value='<?php echo $row8["user_designation"]; ?>'
                                                            id='user_designation-<?php echo $row8["id"]; ?>-representative'
                                                            style="display: none;">
                                                        </input>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="edit"><?php echo $row8['user_mobile_number']; ?></p>
                                                        <input type="text" class='txtedit'
                                                            value='<?php echo $row8["user_mobile_number"]; ?>'
                                                            id='user_mobile_number-<?php echo $row8["id"]; ?>-representative'
                                                            style="display: none;">
                                                        </input>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="edit"><?php echo $row8['user_email']; ?></p>
                                                        <input type="text" class='txtedit'
                                                            value='<?php echo $row8["user_email"]; ?>'
                                                            id='user_email-<?php echo $row8["id"]; ?>-representative'
                                                            style="display: none;">
                                                        </input>
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
    <?php
    include "common/conn.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_update']) && isset($_POST['idd'])) {
        $status = $_POST['status_update'];
        $id = $_POST['idd'];
        $pro_id = $_POST['pro_id'];
        $sql21 = "UPDATE pro_task SET status='$status' WHERE id='$id'";
        if ($conn->query($sql21) === TRUE) {
            // echo "<script>alert('success')</script>";
            // header("Location: singleProject.php?id=<?php echo $proId");
            echo "<script>window.location.href = 'singleProject.php?id=" . $proId . "';</script>";
        } else {
            echo $conn->error;
        }
        $conn->close();
    }
    ?>
    <!-- task modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
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
                                    <label for="assigned_users" class="form-label">Manager</label>
                                    <select class="form-control" name="assigned_users" id="assigned_users">
                                        <option value="" disabled selected>Select a user</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql5 = "SELECT * FROM employee WHERE em_role = '2'";
                                        $result5 = $conn->query($sql5);
                                        while ($row5 = $result5->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row5['em_code']; ?>">
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
                                        if ($em_role == '2') {
                                            $sql5 = "SELECT * FROM employee WHERE em_role = '4' AND dep_id = '$dept'";
                                        } else {
                                            $sql5 = "SELECT * FROM employee WHERE em_role = '4'";
                                        }
                                        $result5 = $conn->query($sql5);
                                        while ($row5 = $result5->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row5['em_code']; ?>">
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
                                <input type="radio" name="Status" value="Not Started">Not Started
                                <input type="radio" name="Status" value="Started">Started
                                <input type="radio" name="Status" value="Complete">Complete
                                <input type="radio" name="Status" value="Complete">Complete
                                <input type="radio" name="Status" value="Cancel">Cancel
                                <span class="checkmark"></span>
                            </div>
                            <div class="mb-2">
                                <label for="ProjectDescription" class="form-label">Project Description</label>
                                <textarea class="form-control" id="ProjectDescription" name="ProjectDescription"
                                    rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="project_task">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- project file insert modal -->
    <div class="modal fade" id="addfiles" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Files</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="files_form" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="project_name" value="<?php echo $proId; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="filename" class="form-label">File Details</label>
                                    <input type="text" class="form-control" id="filename" name="file_name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="pdf" class="form-label">Upload Document</label>
                                    <input type="file" class="form-control" accept=".pdf,.docx,.doc" id="pdf1"
                                        name="pdf1">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="assigned_users" class="form-label">Assigned
                                        Users</label>
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add_file">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- notes modal -->
    <div class="modal fade" id="addnotes" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Files</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="notes_file_form">
                    <input type="hidden" class="form-control" name="project_name" value="<?php echo $proId; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="filename" class="form-label">File Details</label>
                                    <input type="text" class="form-control" id="filenamenotes" name="filenamenotes"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="assigned_users" class="form-label">Assigned Users</label>
                                    <select class="form-control" name="assignedusernotes" id="assignedusernotes">
                                        <option value="" disabled selected>Select a user</option>
                                        <?php
                                        include "common/conn.php";
                                        $sqlnotes = "SELECT * FROM employee";
                                        $resultnotes = $conn->query($sqlnotes);
                                        while ($rownotes = $resultnotes->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $rownotes['full_name']; ?>">
                                                <?php echo $rownotes['full_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_notes">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Expences modal -->
    <div class="modal fade" id="addExpences" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Expenses</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form1" id="form2" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" value="<?php echo $proId; ?>" id="project_name"
                                name="project_name" required>

                            <div class="col-4">
                                <div class="mb-2">
                                    <label for="startDate" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="Date" name="Date" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <label class="form-label">Transaction Type</label>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <input type="radio" id="deposit" name="transaction_type" value="deposit"
                                                required>
                                            <label for="deposit">Deposit</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="withdrawal" name="transaction_type"
                                                value="withdrawal" required>
                                            <label for="withdrawal">Withdrawal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" id="gst_type_field" style="display:none;">
                                <div class="mb-2">
                                    <label class="form-label">GST Type</label>
                                    <div class="d-flex">
                                        <div class="me-1">
                                            <input type="radio" name="taxtype" id="include_gst" value="NONGST" required>
                                            <label for="include_gst">NON-GST</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="taxtype" id="exclude_gst" value="GST" required>
                                            <label for="exclude_gst">GST</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="taxtype" id="withoutadding" value="withoutadding"
                                                required>
                                            <label for="without">WithoutAdding</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="ProjectTitle" class="form-label">Expenses Details</label>
                                    <input type="text" class="form-control" id="Project_Details" name="Project_Details"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2" id="assigned_users_field" style="display:none;">
                                    <label for="assigned_users" class="form-label">Assigned Users</label>
                                    <select class="form-control" name="assigned_users" id="assigned_users">
                                        <option value="" disabled selected>Select a user</option>
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
                                <div class="mb-2" id="gst_field" style="display:none;">
                                    <label for="gst" class="form-label">GST %</label>
                                    <input type="text" class="form-control" id="gst" name="gst">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2" id="deposite1" style="display:none;">
                                    <label for="Amount" class="form-label">deposite</label>
                                    <input type="text" class="form-control" name="deposite1">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2" id="withdrawl1" style="display:none;">
                                    <label for="Amount" class="form-label">withdrawl</label>
                                    <input type="text" class="form-control" name="withdrawl1">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="task_type" value="protask">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="project_task">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Purchase modal -->
    <div class="modal fade" id="addPurchase" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Purchase</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form_pur" id="form_pur" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" value="<?php echo $proId; ?>" id="project_name"
                                name="project_name" required>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="assigned_users" class="form-label">Service Name</label>
                                    <select class="form-control" name="service_name" id="service_namee">
                                        <option value="" disabled selected>Select a Service</option>
                                        <?php
                                        include "common/conn.php";
                                        $sql_service = "SELECT * FROM service";
                                        $result_service = $conn->query($sql_service);
                                        while ($row_service = $result_service->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row_service['id']; ?>">
                                                <?php echo $row_service['service_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="insurance_company">Date Of Purchase</label>
                                <input type="date" class="form-control" name="date_of_pur" id="date_of_purchase"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-6">
                                <label>Service Start Date</label>
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                    name="service_start_dt" id="service_start_date" onchange="calculateDuration()">
                            </div>
                            <div class="col-6">
                                <label>Service End Date</label>
                                <input type="date" class="form-control" name="service_end_dt" id="service_end_date"
                                    onchange="calculateDuration()">
                            </div>
                            <div class="col-6">
                                <label>Duration</label>
                                <input type="text" class="form-control" name="duration1" id="duration" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="project_purchase">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- user modal -->
    <div class="modal fade" id="addUsers" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Add Users</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form name="form1" id="form_user" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" value="<?php echo $proId; ?>" id="project_name"
                                name="project_name" required>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="ProjectTitle" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="representative_namee"
                                        name="representative_name"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="ProjectTitle" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="representative_designationn"
                                        name="representative_designation" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="startDate" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile_numberr" name="mobile_numberr1"
                                        oninput="if(this.value.length > 10) this.value = this.value.slice(0, 20); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="ProjectTitle" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email_id" name="emaill_id" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="task_type" value="protask">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="project_task">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body bg-success text-white">
                Form Submit Successfully!
            </div>
        </div>
    </div>


    <!-- modal for change image -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="myform" action="<?php $_SERVER['PHP_SELF']; ?>" method='post'
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputfile"></label>
                                <input type="hidden" value="<?php echo $row["id"]; ?>" name="id7" id="id7">
                                <div class="form-group col-12">
                                    <label for="image">Project Image</label>
                                    <input type="file" class="form-control" placeholder="" name="image" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update3" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['update3'])) {
        include "common/conn.php";
        $id = $_POST["id7"];
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];
        $file_type = pathinfo($image_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_type;

        $upload_dir = "assets/uploads/project";

        // Check if the directory exists, and create it if not
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $target_file = $upload_dir . '/' . $new_file_name;
        // Check for file upload errors
        if ($image_error === 0) {
            if (move_uploaded_file($image_tmp, $target_file)) {
                echo "<script>alert('Image uploaded successfully');</script>";
            } else {
                echo "<script>alert('Image not uploaded');</script>";
            }

            // Update the database with the new image path
            $sql34 = "UPDATE project SET pro_image='assets/uploads/project/$new_file_name' WHERE id='$id'";
            if ($conn->query($sql34) === true) {
                echo "<script>window.location.href='singleProject.php';</script>";
            } else {
                echo "<script>alert('Database update failed: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error during image upload');</script>";
        }

        $conn->close();
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- for project view -->
    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit', function () {
                var txtEdit = $(this).next('.txtedit');
                var editText = $(this);

                txtEdit.show().focus();
                editText.hide();

                txtEdit.focusout(function () {
                    var field_name = txtEdit.attr('id').split("-")[0];
                    var edit_id = txtEdit.attr('id').split("-")[1];
                    var table_name = txtEdit.attr('id').split("-")[2];
                    var value = txtEdit.val();

                    console.log("Field:", field_name, "ID:", edit_id, "Table:", table_name,
                        "Value:", value);

                    if (value !== null && value.trim() !== '') {
                        var pattern = txtEdit.attr('pattern');
                        if (pattern) {
                            var regex = new RegExp(pattern);
                            if (!regex.test(value)) {
                                alert('Invalid pattern. Please enter a valid value.');
                                return;
                            }
                        }
                    }
                    editText.show();
                    editText.text(value);
                    txtEdit.hide();
                    $.ajax({
                        url: 'insert.php',
                        type: 'post',
                        data: {
                            field: field_name,
                            value: value,
                            id: edit_id,
                            tbnm: table_name
                        },
                        success: function (response) {
                            console.log("AJAX response:", response);
                            if (response == 1) {
                                console.log('Save Successfully');
                            } else {
                                console.log('Not Saved');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX error:", status, error);
                        }
                    });
                });
            });
        });
    </script>

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

    <script>
        function showInput(inputId) {
            document.getElementById(inputId).style.display = 'inline';
        }

        function hideInput(inputId) {
            document.getElementById(inputId).style.display = 'none';
        }
    </script>

    <!-- for project Task -->
    <script>
        $(document).ready(function () {
            $('#form1').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'project_task.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        $('#form1')[0].reset();
                        $('#addDept').modal('hide');
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error submitting the form. Please try again later.');
                    }
                });
            });
        });
    </script>
    <!-- for project files -->
    <script>
        $(document).ready(function () {
            $('#files_form').submit(function (event) {
                // Prevent default form submission
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'project_file.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Handle successful submission
                        console.log(response);
                        // Reset the form
                        $('#files_form')[0].reset();
                        $('#addfiles').modal('hide');
                        // Show an alert message
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        // Optionally, show an error alert
                        alert('Error submitting the form. Please try again later.');
                    }
                });
            });
        });
    </script>

    <!-- for project Notes -->
    <script>
        $(document).ready(function () {
            $('#notes_file_form').submit(function (event) {
                // Prevent default form submission
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'notes_file.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Handle successful submission
                        console.log(response);
                        // Reset the form
                        $('#notes_file_form')[0].reset();
                        $('#addnotes').modal('hide');
                        // Show an alert message
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        // Optionally, show an error alert
                        alert('Error submitting the form. Please try again later.');
                    }
                });
            });
        });
    </script>

    <!-- for project Expences -->
    <script>
        $(document).ready(function () {
            $('#form2').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'project_expences.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        $('#form2')[0].reset();
                        $('#addExpences').modal('hide');
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error submitting the form. Please try again later.');
                    }
                });
            });
        });
    </script>

    <!-- for project Purchase -->
    <script>
        $(document).ready(function () {
            $('#form_pur').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'project_purchase.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        $('#form_pur')[0].reset();
                        $('#addPurchase').modal('hide');
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error submitting the form. Please try again later.');
                    }
                });
            });
        });
    </script>

    <!-- for project Purchase renewal-->
    <script>
        $(document).ready(function () {
            $('#form_pur1').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'project_purchase.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        $('#form_pur1')[0].reset();
                        $('#renewal').modal('hide');
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error submitting the form. Please try again later.');
                    }
                });
            });
        });
    </script>
    <!-- for user -->
    <script>
        $(document).ready(function () {
            $('#form_user').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'project_representative.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        $('#form_user')[0].reset();
                        $('#addExpences').modal('hide');
                        var toastEl = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error submitting the form. Please try again later.');
                    }
                });
            });
        });
    </script>
    <!-- for input show and hide -->
    <script>
        function showInput(inputId) {
            document.getElementById(inputId).style.display = 'inline';
        }

        function hideInput(inputId) {
            document.getElementById(inputId).style.display = 'none';
        }
    </script>
    <script>
        function showFileInput(id) {
            document.getElementById('fileInput-' + id).style.display = 'block';
        }
        function uploadFile(id) {
            var fileInput = document.getElementById('fileInput-' + id);
            var file = fileInput.files[0];
            if (file) {
                var formData = new FormData();
                formData.append('file', file);
                formData.append('id', id);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'pdf_upload.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert('File uploaded successfully.');
                        location.reload();
                    } else {
                        alert('An error occurred while uploading the file.');
                    }
                };
                xhr.send(formData);
            }
        }
    </script>
    <!-- for withdrawal amount of expences -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const depositRadio = document.getElementById('deposit');
            const withdrawalRadio = document.getElementById('withdrawal');
            const includeGstRadio = document.getElementById('include_gst');
            const excludeGstRadio = document.getElementById('exclude_gst');
            const gstField = document.getElementById('gst_field');
            const gstTypeField = document.getElementById('gst_type_field');
            const assignedUsersField = document.getElementById('assigned_users_field');
            const amountInput = document.getElementById('Amount');
            const gstInput = document.getElementById('gst');
            const depositeInput = document.getElementById('deposite1');
            const withdrawlInput = document.getElementById('withdrawl1');

            function toggleFields() {
                if (depositRadio.checked) {
                    gstTypeField.style.display = 'block';
                    gstField.style.display = 'block';
                    assignedUsersField.style.display = 'none';
                    depositeInput.style.display = 'block';
                    withdrawlInput.style.display = 'none';
                    const amount = parseFloat(amountInput.value);
                    if (!isNaN(amount)) {
                        amountInput.value = Math.abs(amount); // Ensure positive value
                    }
                } else if (withdrawalRadio.checked) {
                    gstTypeField.style.display = 'block';
                    gstField.style.display = 'block';
                    assignedUsersField.style.display = 'block';
                    depositeInput.style.display = 'none';
                    withdrawlInput.style.display = 'block';
                    const amount = parseFloat(amountInput.value);
                    if (!isNaN(amount)) {
                        amountInput.value = -Math.abs(amount); // Ensure negative value
                    }
                }
            }
            depositRadio.addEventListener('change', toggleFields);
            withdrawalRadio.addEventListener('change', toggleFields);

            // Ensure fields are properly toggled on page load
            toggleFields();

            function calculateGST() {
                const amount = parseFloat(amountInput.value);
                const gstPercent = parseFloat(gstInput.value);
                if (!isNaN(amount) && !isNaN(gstPercent)) {
                    let gstAmount;
                    let finalAmount;

                    if (includeGstRadio.checked) {
                        gstAmount = (amount * gstPercent) / 100;
                        finalAmount = amount + gstAmount;
                    } else if (excludeGstRadio.checked) {
                        gstAmount = amount - (amount * (100 / (100 + gstPercent)));
                        finalAmount = amount - gstAmount;
                    }

                    if (!isNaN(finalAmount)) {
                        amountInput.value = finalAmount.toFixed(2);
                    }
                }
            }

            includeGstRadio.addEventListener('change', calculateGST);
            excludeGstRadio.addEventListener('change', calculateGST);

            document.getElementById('form2').addEventListener('submit', function (e) {
                if (depositRadio.checked) {
                    calculateGST();
                } else if (withdrawalRadio.checked) {
                    const amount = parseFloat(amountInput.value);
                    if (!isNaN(amount)) {
                        amountInput.value = -Math.abs(amount); // Ensure negative value
                    }
                }
            });
        });
    </script>
    <!-- for employee dropdown in the project task-->
    <script>
        function toggleSelect(id) {
            const selectElement = document.getElementById('assign_users-' + id + '-assign_task');
            if (selectElement.style.display === 'none') {
                selectElement.style.display = 'block';
            } else {
                selectElement.style.display = 'none';
            }
        }

        function saveSelectedName(em_code, pro_task_id) {
            // Send AJAX request to save the selected name
            $.ajax({
                url: 'save_assigned_user.php',
                type: 'POST',
                data: {
                    em_code: em_code,
                    pro_task_id: pro_task_id
                },
                success: function (response) {
                    if (response == 'success') {
                        location.reload(); // Reload the page to show the updated names
                    } else {
                        alert('Failed to save the name. Please try again.');
                    }
                }
            });
        }

        function deleteName(em_code, pro_task_id) {
            // Send AJAX request to delete the name
            $.ajax({
                url: 'delete_assigned_user.php',
                type: 'POST',
                data: {
                    em_code: em_code,
                    pro_task_id: pro_task_id
                },
                success: function (response) {
                    if (response == 'success') {
                        location.reload(); // Reload the page to show the updated names
                    } else {
                        alert('Failed to delete the name. Please try again.');
                    }
                }
            });
        }
    </script>
</body>

</html>
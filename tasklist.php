<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Task List - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=1.2" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                                        <th>Project Name</th>
                                        <th>Project Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Desc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    if ($em_role == '4') {
                                        $sql = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                        FROM pro_task pt
                                                        LEFT JOIN assign_task at ON pt.id = at.task_id WHERE
                                                        FIND_IN_SET('$em_code', at.assign_user) > 0
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
                                        $sql = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                        FROM pro_task pt
                                                        LEFT JOIN assign_task at ON pt.id = at.task_id
                                                        WHERE
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
                                        $sql = "SELECT pt.id AS pro_task_id, 
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Team Head') AS team_head_id,
                                                        (SELECT at.id FROM assign_task at WHERE at.task_id = pt.id AND at.user_type = 'Collaborators' LIMIT 1) AS collaborator_id,
                                                        pt.pro_id, pt.task_title, pt.start_date, pt.end_date, pt.status,
                                                        GROUP_CONCAT(CASE WHEN at.user_type = 'Collaborators' THEN at.assign_user END SEPARATOR ',') AS assign_users,
                                                        (SELECT assign_user FROM assign_task WHERE task_id = pt.id AND user_type = 'Team Head') AS assigned_manager
                                                    FROM pro_task pt
                                                    LEFT JOIN assign_task at ON pt.id = at.task_id
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
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['pro_task_id'];
                                        $pro_id = $row["pro_id"];
                                        $sql1 = "SELECT * FROM project WHERE id = $pro_id";
                                        $result1 = $conn->query($sql1);
                                        $row1 = $result1->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td><?php echo $slno; ?></td>
                                            <td><?php echo $row1["pro_name"]; ?></td>
                                            <td><?php echo $row["task_title"]; ?></td>
                                            <td><?php echo $row["start_date"]; ?></td>
                                            <td><?php echo $row["end_date"]; ?></td>
                                            <td class="text-center">
                                                <p class="form-control form-control-line edit"
                                                    onclick="showDropdown('status-<?php echo $row['pro_task_id']; ?>-pro_task')">
                                                    <?php echo $row["status"]; ?>
                                                </p>
                                                <select class='txtedit'
                                                    id='status-<?php echo $row["pro_task_id"]; ?>-pro_task'
                                                    style="display:none;">
                                                    <option value="Not Started" <?php if ($row["status"] == "Not Started")
                                                        echo 'selected="selected"'; ?>>Not Started
                                                    </option>
                                                    <option value="Started" <?php if ($row["status"] == "Started")
                                                        echo 'selected="selected"'; ?>>Started
                                                    </option>
                                                    <option value="Testing" <?php if ($row["status"] == "Testing")
                                                        echo 'selected="selected"'; ?>>Testing
                                                    </option>
                                                    <option value="Complete" <?php if ($row["status"] == "Complete")
                                                        echo 'selected="selected"'; ?>>Complete
                                                    </option>
                                                    <option value="Cancel" <?php if ($row["status"] == "Cancel")
                                                        echo 'selected="selected"'; ?>>Cancel
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#paragraphmodal_<?php echo $id; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="paragraphmodal_<?php echo $id; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <?php
                                                    $sql17 = "SELECT * FROM pro_task WHERE id =$id";
                                                    $result17 = $conn->query($sql17);
                                                    $row17 = $result17->fetch_assoc();
                                                    ?>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-12">
                                                                <strong>Project Description:</strong>
                                                                <?php if ($em_role == '1') { ?>
                                                                    <textarea class="form-control form-control-line col-6 edit"
                                                                        rows="6"
                                                                        cols="80"><?php echo $row17["description"]; ?></textarea>
                                                                <?php } else { ?>
                                                                    <textarea class="form-control form-control-line" rows="6"
                                                                        cols="80"
                                                                        readonly><?php echo htmlspecialchars($row17["description"]); ?></textarea>
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
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="projectInput">Project Name:</label>
                                    <input type="text" id="projectInput" class="form-control"
                                        placeholder="Enter project name...." autocomplete="off" required>
                                    <div id="projectSuggestions" class="dropdown-menu"
                                        style="display: none; max-height: 200px; overflow-y: auto; border: 1px solid #ccc; position: absolute; z-index: 1000;">
                                    </div>
                                    <!-- Hidden input to store project ID -->
                                    <input type="hidden" id="projectId" name="pro_value">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="ProjectTitle" class="form-label">Task Title</label>
                                    <input type="text" class="form-control" id="Project_Title" name="Project_Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_Date" name="start_Date">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="ProjectEndDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="Project_EndDate" id="Project_EndDate">
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
                                            $sql5 = "SELECT * FROM employee WHERE em_role IN (4, 5)' AND dep_id = '$dept'";
                                        } else {
                                            $sql5 = "SELECT * FROM employee WHERE em_role IN (4, 5)";
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
                                <input type="radio" name="Status" value="Testing">Testing
                                <input type="radio" name="Status" value="Complete">Complete
                                <input type="radio" name="Status" value="Cancel">Cancel
                                <span class="checkmark"></span>
                            </div>
                            <div class="mb-2">
                                <label for="ProjectDescription" class="form-label">Project Description</label>
                                <textarea class="form-control" id="ProjectDescription" name="ProjectDescription"
                                    rows="4">
                                </textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                        $('#addtasklist').modal('hide');
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
    <!-- disable the date of end date -->
    <script>
        const startDateInput = document.getElementById("start_Date");
        const endDateInput = document.getElementById("Project_EndDate");
        startDateInput.addEventListener("change", function () {
            endDateInput.min = startDateInput.value;
        });
    </script>
    <!-- for project name suggetions -->
    <script>
        document.getElementById('projectInput').addEventListener('input', function () {
            const selectedProject = this.value;
            const suggestionsContainer = document.getElementById('projectSuggestions');
            if (selectedProject) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'get_projects.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    if (this.status === 200) {
                        const projects = JSON.parse(this.responseText);
                        suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                        if (projects.length > 0) {
                            projects.forEach(project => {
                                // Create a suggestion item
                                const suggestionItem = document.createElement('div');
                                suggestionItem.textContent = project.pro_name; // Adjust this according to your data
                                suggestionItem.className = 'dropdown-item';
                                suggestionItem.style.cursor = 'pointer';

                                // When a suggestion is clicked
                                suggestionItem.addEventListener('click', function () {
                                    document.getElementById('projectInput').value = project.pro_name;
                                    document.getElementById('projectId').value = project.id; // Store the project ID
                                    suggestionsContainer.style.display = 'none'; // Hide suggestions
                                });

                                suggestionsContainer.appendChild(suggestionItem);
                            });
                            suggestionsContainer.style.display = 'block'; // Show suggestions
                        } else {
                            suggestionsContainer.style.display = 'none'; // Hide if no suggestions
                        }
                    }
                };
                xhr.send('pro_name=' + encodeURIComponent(selectedProject));
            } else {
                suggestionsContainer.style.display = 'none'; // Hide if input is empty
            }
        });
        // Hide suggestions when clicking outside
        document.addEventListener('click', function (e) {
            if (!document.getElementById('projectInput').contains(e.target)) {
                document.getElementById('projectSuggestions').style.display = 'none';
            }
        });
    </script>
</body>

</html>
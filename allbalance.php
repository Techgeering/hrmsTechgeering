<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Balance Sheet - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
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
                        <h3 class="my-2">All Balance</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i>All Balance
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Asssign To</th>
                                        <th>Particulars</th>
                                        <th>Deposite</th>
                                        <th>Withdraw</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM
                                     account 
                                    ORDER BY date_time DESC";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row["date"]; ?></td>
                                                <td>
                                                    <?php
                                                    $pro_id = $row["pro_id"];
                                                    $sql1 = "SELECT * FROM project WHERE id = $pro_id";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch_assoc();

                                                    if ($pro_id === '-1') {
                                                        echo "Internship";
                                                    } elseif ($pro_id === '0') {
                                                        echo "Loan";
                                                    } else {
                                                        echo htmlspecialchars($row1["pro_name"], ENT_QUOTES, 'UTF-8');
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $em_id = $row["assign_to"];
                                                    $sql11 = "SELECT * FROM employee WHERE em_code = '$em_id'";
                                                    $result11 = $conn->query($sql11);

                                                    // Fetch the result and check if it's NULL
                                                    if ($result11 && $result11->num_rows > 0) {
                                                        $row11 = $result11->fetch_assoc();
                                                        echo htmlspecialchars($row11["full_name"], ENT_QUOTES, 'UTF-8');
                                                    } else {
                                                        echo "NULL"; // Display "NULL" if no record is found
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $row["particulars"]; ?></td>
                                                <td><?php echo $row["deposite"]; ?></td>
                                                <td><?php echo $row["withdraw"]; ?></td>
                                                <td><?php echo $row["balance"]; ?></td>
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">All Balance</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form10" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label for="Project_Name" class="form-label">Project Name</label>
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
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <div class="col-12">
                                    <label for="particulars">Particulars</label>
                                    <input type="text" class="form-control" id="particulars" name="particular" required>
                                </div>
                                <div class="col-6">
                                    <label for="assigned_users" class="form-label">Tax Type</label>
                                    <select class="form-control" name="taxtype" id="assigned_users" required>
                                        <option value="" disabled selected>Select a Type</option>
                                        <option value="GST">Tax</option>
                                        <option value="NONGST">Without-Tax</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="deposit">Deposit</label>
                                    <input type="text" class="form-control" id="deposit" name="ddeposite"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                                <div class="col-6">
                                    <label for="withdraw">Withdraw</label>
                                    <input type="text" class="form-control" id="withdraw" name="withdraw"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                        required>
                                </div>
                                <div class="col-6">
                                    <label for="assigned_users_container">Assigned Users</label>
                                    <div class="mb-2" id="assigned_users_container">
                                        <select class="form-control" name="assigned_users" id="assigned_users">
                                            <option value="" disabled selected>Select a user</option>
                                            <?php
                                            include "common/conn.php";
                                            $sql_emp = "SELECT * FROM employee ";
                                            $result_emp = $conn->query($sql_emp);
                                            while ($row_emp = $result_emp->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row_emp['em_code']; ?>">
                                                    <?php echo $row_emp['full_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
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
    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        $Project_Name = $_POST["pro_value"];
        $assigned_users = $_POST["assigned_users"];
        $particulars = $_POST["particular"];
        $taxtype = $_POST["taxtype"];
        $gst = $_POST["gst"];
        $deposit = $_POST["ddeposite"];
        $withdraw = $_POST["withdraw"];
        $date = $_POST["date"];

        $datetimes = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $time = $datetimes->format('H:i:s');
        $datetime = $date . " " . $time;

        // Initialize the current balance
        $current_balance_T;
        $current_balance;
        $current_balance_WT;

        $balance_query = "SELECT balance_T FROM account WHERE balance_T IS NOT NULL AND date_time < '$datetime' ORDER BY date_time DESC LIMIT 1";
        $balance_result = $conn->query($balance_query);
        if ($balance_result->num_rows > 0) {
            $row = $balance_result->fetch_assoc();
            $current_balance_T = $row["balance_T"];
        } else {
            $current_balance_T = 0;
        }
        $balance_query1 = "SELECT balance FROM account WHERE date_time < '$datetime' ORDER BY date_time DESC LIMIT 1";
        $balance_result1 = $conn->query($balance_query1);
        if ($balance_result1->num_rows > 0) {
            $row1 = $balance_result1->fetch_assoc();
            $current_balance = $row1["balance"];
        } else {
            $current_balance = 0;
        }
        $balance_query2 = "SELECT balance_WT FROM account WHERE balance_WT IS NOT NULL AND date_time < '$datetime' ORDER BY date_time DESC LIMIT 1";
        $balance_result2 = $conn->query($balance_query2);
        if ($balance_result2->num_rows > 0) {
            $row2 = $balance_result2->fetch_assoc();
            $current_balance_WT = $row2["balance_WT"];
        } else {
            $current_balance_WT = 0;
        }

        if ($taxtype == 'GST') {
            if (!empty($deposit)) {
                $current_balance = (float) $current_balance + (float) $deposit;
                $current_balance_T = (float) $current_balance_T + (float) $deposit;
                $current_balance_WT = (float) $current_balance_WT;
            } elseif (!empty($withdraw)) {
                $current_balance = (float) $current_balance - (float) $withdraw;
                $current_balance_T = (float) $current_balance_T - (float) $withdraw;
                $current_balance_WT = (float) $current_balance_WT;
            }
        } else {
            if (!empty($deposit)) {
                $current_balance = (float) $current_balance + (float) $deposit;
                $current_balance_T = (float) $current_balance_T;
                $current_balance_WT = (float) $current_balance_WT + (float) $deposit;
            } elseif (!empty($withdraw)) {
                $current_balance = (float) $current_balance - (float) $withdraw;
                $current_balance_T = (float) $current_balance_T;
                $current_balance_WT = (float) $current_balance_WT - (float) $withdraw;
            }
        }

        if ($taxtype == 'GST') {
            $sql = "INSERT INTO account (pro_id, assign_to, particulars, tex_type, gst, deposite, withdraw, balance, balance_T, balance_WT, date, date_time) 
            VALUES ('$Project_Name','$assigned_users','$particulars', 'GST', '$gst', '$deposit', '$withdraw', '$current_balance', '$current_balance_T', '', '$date', '$datetime')";
        } else {
            $sql = "INSERT INTO account (pro_id, assign_to, particulars, tex_type, deposite, withdraw, balance, balance_T, balance_WT, date, date_time) 
            VALUES ('$Project_Name','$assigned_users','$particulars', 'NONGST', '$deposit', '$withdraw', '$current_balance', '', '$current_balance_WT', '$date', '$datetime')";
        }
        if ($conn->query($sql) === TRUE) {

            if ($taxtype == 'GST') {
                if (!empty($deposit)) {
                    $sql15 = "SELECT * FROM account WHERE balance_T IS NOT NULL AND date_time > '$datetime'";
                    $result15 = $conn->query($sql15);
                    while ($row15 = $result15->fetch_assoc()) {
                        $balancetid = $row15["id"];

                        $sql16 = "UPDATE account SET balance_T = balance_T + $deposit , balance = balance + $deposit WHERE id = '$balancetid'";
                        if ($conn->query($sql16) === TRUE) {
                            echo '<script>alert("Data Updated successfully")</script>';
                        } else {
                            echo '<script>alert("Error")</script>';
                        }
                    }
                } elseif (!empty($withdraw)) {
                    $sqlw15 = "SELECT * FROM account WHERE balance_T IS NOT NULL AND date_time > '$datetime'";
                    $resultw15 = $conn->query($sqlw15);
                    while ($roww15 = $resultw15->fetch_assoc()) {
                        $balancetwid = $roww15["id"];

                        $sqlw16 = "UPDATE account SET balance_T = balance_T - $withdraw , balance = balance - $withdraw WHERE id = '$balancetwid'";
                        if ($conn->query($sqlw16) === TRUE) {
                            echo '<script>alert("Data Updated successfully")</script>';

                        } else {
                            echo '<script>alert("Error while updating")</script>';
                        }
                    }
                } else {
                    echo '<script>alert("New record created successfully")</script>';
                }

            } else {

                if (!empty($deposit)) {
                    $sql15 = "SELECT * FROM account WHERE balance_WT IS NOT NULL AND date_time > '$datetime'";
                    $result15 = $conn->query($sql15);
                    while ($row15 = $result15->fetch_assoc()) {
                        $balancetid = $row15["id"];

                        $sql16 = "UPDATE account SET balance_WT = balance_WT + $deposit , balance = balance + $deposit WHERE id = '$balancetid'";
                        if ($conn->query($sql16) === TRUE) {
                            echo '<script>alert("Data Updated successfully")</script>';
                        } else {
                            echo '<script>alert("Error")</script>';
                        }
                    }
                } elseif (!empty($withdraw)) {
                    $sqlw15 = "SELECT * FROM account WHERE balance_WT IS NOT NULL AND date_time > '$datetime'";
                    $resultw15 = $conn->query($sqlw15);
                    while ($roww15 = $resultw15->fetch_assoc()) {
                        $balancetwid = $roww15["id"];

                        $sqlw16 = "UPDATE account SET balance_WT = balance_WT - $withdraw , balance = balance - $withdraw WHERE id = '$balancetwid'";
                        if ($conn->query($sqlw16) === TRUE) {
                            echo '<script>alert("Data Updated successfully")</script>';

                        } else {
                            echo '<script>alert("Error while updating")</script>';
                        }
                    }
                } else {
                    echo '<script>alert("New record created successfully")</script>';
                }

            }
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=1.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const depositField = document.getElementById('deposit');
            const withdrawField = document.getElementById('withdraw');

            depositField.addEventListener('input', () => {
                if (depositField.value.trim() !== "") {
                    withdrawField.disabled = true;
                } else {
                    withdrawField.disabled = false;
                }
            });
            withdrawField.addEventListener('input', () => {
                if (withdrawField.value.trim() !== "") {
                    depositField.disabled = true;
                } else {
                    depositField.disabled = false;
                }
            });
        });
    </script>
    <!-- for deposite , withdraw and assigned user -->
    <script>
        // Get references to deposit, withdraw inputs, assigned users container, and form
        const depositInput = document.getElementById('deposit');
        const withdrawInput = document.getElementById('withdraw');
        const assignedUsersContainer = document.getElementById('assigned_users_container');
        const assignedUsersField = document.getElementById('assigned_users');
        const form = document.getElementById('Form10'); // Replace 'yourForm' with your actual form ID

        // Add event listener to detect input changes in deposit and withdraw fields
        depositInput.addEventListener('input', function () {
            if (depositInput.value.trim() !== '') {
                // Hide the assigned users field when deposit is filled
                assignedUsersContainer.style.display = 'none';
                assignedUsersField.required = false; // Remove required attribute
            } else {
                // Show the assigned users field if deposit is empty
                assignedUsersContainer.style.display = 'block';
            }
        });

        withdrawInput.addEventListener('input', function () {
            if (withdrawInput.value.trim() !== '') {
                // Show the assigned users field and make it required when withdraw is filled
                assignedUsersContainer.style.display = 'block';
                assignedUsersField.required = true; // Add required attribute
            } else {
                // Hide the assigned users field if withdraw is empty
                assignedUsersContainer.style.display = 'none';
                assignedUsersField.required = false; // Remove required attribute
            }
        });

        // Add event listener for form submission
        form.addEventListener('submit', function (event) {
            // Prevent form submission if withdraw is filled and assigned users field is empty
            if (withdrawInput.value.trim() !== '' && assignedUsersField.value.trim() === '') {
                event.preventDefault();
                alert('Assigned Users field is required when withdrawing.');
            }
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
                                suggestionItem.textContent = project.pro_name;
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
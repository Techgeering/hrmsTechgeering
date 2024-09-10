<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Balance Sheet(Tax) - Hrms Techgeering</title>
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
                        <h3 class="my-2">Balance Sheet(Tax)</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i>Tax Balance
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Assign To</th>
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
                                    account AS a
                                    INNER JOIN project AS p
                                    ON a.pro_id = p.id 
                                    WHERE tex_type = 'GST' ORDER BY date_time DESC";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row["date"]; ?></td>

                                                <td><?php echo $row["pro_name"]; ?></td>
                                                <td><?php echo $row["assign_to"]; ?></td>
                                                <td><?php echo $row["particulars"]; ?></td>
                                                <td><?php echo $row["deposite"]; ?></td>
                                                <td><?php echo $row["withdraw"]; ?></td>
                                                <td><?php echo $row["balance_T"]; ?></td>
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
                    <h1 class="modal-title fs-5" id="addDeptLabel">GST Balance</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label for="Project_Name" class="form-label">Project Name</label>
                                        <select class="form-select" name="Project_Name" id="Project_Name">
                                            <option value="" disabled selected>Select a project</option>
                                            <?php
                                            include "common/conn.php";
                                            $sql_pro = "SELECT * FROM project ";
                                            $result_pro = $conn->query($sql_pro);
                                            while ($row_pro = $result_pro->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row_pro['id']; ?>">
                                                    <?php echo $row_pro['pro_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
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
                                <div class="col-12">
                                    <label for="particulars">Particulars</label>
                                    <input type="text" class="form-control" id="particulars" name="particular">
                                </div>
                                <div class="col-6">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                                <div class="col-6">
                                    <label for="gst">GST</label>
                                    <input type="text" class="form-control" id="gst" name="gst">
                                </div>
                                <div class="col-6">
                                    <label for="deposit">Deposit</label>
                                    <input type="text" class="form-control" id="deposit" name="ddeposite">
                                </div>
                                <div class="col-6">
                                    <label for="withdraw">Withdraw</label>
                                    <input type="text" class="form-control" id="withdraw" name="withdraw">
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
        $Project_Name = $_POST["Project_Name"];
        $assigned_users = $_POST["assigned_users"];
        $particulars = $_POST["particular"];
        $taxtype = $_POST["taxtype"];
        $gst = $_POST["gst"];
        $deposit = $_POST["ddeposite"];
        $withdraw = $_POST["withdraw"];
        $balance = $_POST["balance_T"];
        $date = $_POST["date"]; // Example: 2024-08-11
    
        $datetimes = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $time = $datetimes->format('H:i:s');

        // Combine the provided date with the current time
        $datetime = $date . " " . $time;

        $current_balance_T;
        $current_balance;
        // Fetch the latest balance from the database
        // $balance_query = "SELECT balance_T FROM account WHERE balance_T!='' ORDER BY id DESC LIMIT 1";
        $balance_query = "SELECT balance_T FROM account WHERE balance_T IS NOT NULL AND date_time < '$datetime' ORDER BY date_time DESC LIMIT 1";
        $balance_result = $conn->query($balance_query);
        if ($balance_result->num_rows > 0) {
            $row = $balance_result->fetch_assoc();
            $current_balance_T = $row["balance_T"];
        } else {
            $current_balance_T = 0;
        }

        $balance_query1 = "SELECT balance FROM account WHERE balance_T IS NOT NULL AND date_time < '$datetime' ORDER BY date_time DESC LIMIT 1";
        $balance_result1 = $conn->query($balance_query1);
        if ($balance_result1->num_rows > 0) {
            $row1 = $balance_result1->fetch_assoc();
            $current_balance = $row1["balance"];
        } else {
            $current_balance = 0;
        }

        if (!empty($deposit)) {
            $current_balance = (float) $current_balance + (float) $deposit;
            $current_balance_T = (float) $current_balance_T + (float) $deposit;
        } elseif (!empty($withdraw)) {
            $current_balance = (float) $current_balance - (float) $withdraw;
            $current_balance_T = (float) $current_balance_T - (float) $withdraw;
        }

        // Insert the new transaction along with the updated balance
        $sql = "INSERT INTO account (pro_id, assign_to, particulars, tex_type, gst, deposite, withdraw, balance, balance_T, date, date_time) 
            VALUES ('$Project_Name',' $assigned_users','$particulars', 'GST', '$gst', '$deposit', '$withdraw', '$current_balance', '$current_balance_T', '$date', '$datetime')";
        if ($conn->query($sql) === TRUE) {

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
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
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
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Holidays - Hrms Techgeering</title>
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
                        <h2 class="my-2">Holidays</h2>
                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                                <i class="fa-solid fa-plus"></i> Holidays
                            </button>
                        <?php } ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="p-4 border border-secondary">Sl No</th>
                                        <th class="p-4 border border-secondary">Name</th>
                                        <th class="p-4 border border-secondary">Closing Start Date</th>
                                        <th class="p-4 border border-secondary">Opening Date</th>
                                        <th class="p-4 border border-secondary">Days</th>
                                        <th class="p-4 border border-secondary">Year</th>
                                        <th class="p-4 border border-secondary">Hour</th>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <th class="p-4 border border-secondary">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM holiday";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $slno = 1;
                                        $currentMonth = date("m");
                                        $currentYear = date("Y");

                                        while ($row = $result->fetch_assoc()) {
                                            // Extract month and year from the 'from_date' field
                                            $holidayMonth = date("m", strtotime($row["from_date"]));
                                            $holidayYear = date("Y", strtotime($row["from_date"]));

                                            // Check if current month and year match the holiday's from_date
                                            $rowClass = ($currentMonth == $holidayMonth && $currentYear == $holidayYear) ? 'class="bg-success text-white"' : '';
                                            ?>
                                            <tr <?php echo $rowClass; ?>>
                                                <td class="p-4 border border-secondary"><?php echo $slno; ?></td>
                                                <td class="p-4 border border-secondary"><?php echo $row["holiday_name"]; ?></td>
                                                <td class="p-4 border border-secondary"><?php echo $row["from_date"]; ?></td>
                                                <td class="p-4 border border-secondary"><?php echo $row["to_date"]; ?></td>
                                                <td class="p-4 border border-secondary"><?php echo $row["number_of_days"]; ?>
                                                </td>
                                                <td class="p-4 border border-secondary"><?php echo $row["year"]; ?></td>
                                                <td class="p-4 border border-secondary">
                                                    <?php echo $row["number_of_holiday_hour"]; ?>
                                                </td>
                                                <?php if ($em_role == '1' || $em_role == '3') { ?>
                                                    <td class="p-4 border border-secondary">
                                                        <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"
                                                            onclick="myfcn4(<?php echo $row['id']; ?>, '<?php echo addslashes(htmlspecialchars_decode($row['holiday_name'])); ?>', '<?php echo htmlspecialchars($row['from_date']); ?>', '<?php echo htmlspecialchars($row['to_date']); ?>')"
                                                            data-bs-toggle="modal" data-bs-target="#updateholiday"></i>

                                                        <a onclick="confirmDelete(<?php echo $row['id']; ?>, tb='holiday', tbc='id',returnpage='holiday.php');"
                                                            title="Delete">
                                                            <i class="fa-solid fa fa-trash text-danger" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                <?php } ?>
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
    <!-- Insert Modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="holiday">Holiday Name</label>
                            <input type="text" class="form-control" id="holiday" name="holiday"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="from_date">Closing Start Date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" required>
                        </div>
                        <div class="form-group">
                            <label for="to_date">Opening Date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" required>
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
    function calculateHours($date1, $date2)
    {
        $totalHours = 0;
        $endDate = clone $date2;
        // $endDate->modify('-1 day');
        while ($date1 < $endDate) {
            $dayOfWeek = $date1->format('N');
            if ($dayOfWeek == 6) {
                $totalHours += 5;
            } elseif ($dayOfWeek == 7) {
            } else {
                $totalHours += 9;
            }
            $date1->modify('+1 day');
        }
        return $totalHours;
    }

    if (isset($_POST['submit'])) {
        // Retrieve form data
        $holiday = htmlspecialchars($_POST["holiday"]);
        $from_date = $_POST["from_date"];
        $to_date = $_POST["to_date"];
        // $year = date('m-Y');
    
        $date1 = new DateTime($from_date);
        $date2 = new DateTime($to_date);

        $year = $date1->format('Y');

        $totalHours = calculateHours(clone $date1, $date2);
        $interval = $date1->diff($date2);
        $days = $interval->days;

        if (!empty($holiday) && !empty($from_date) && !empty($to_date)) {

            $sql = $conn->prepare("INSERT INTO holiday (holiday_name, from_date, to_date, number_of_days, year, number_of_holiday_hour) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param('sssssi', $holiday, $from_date, $to_date, $days, $year, $totalHours);

            if ($sql->execute()) {
                echo "<script>alert('success');</script>";
            } else {
                echo "<script>alert('error');</script>";
            }
        } else {
            echo "<script>alert('Form Should Not Be Submit Blank')</script>";
        }
        $sql->close();
    }
    $conn->close();
    ?>
    <!-- Update modal -->
    <div class="modal fade" id="updateholiday" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id4" id="id4">
                        <div class="form-group">
                            <label for="DepartmentName">Holiday Name</label>
                            <input type="text" class="form-control" id="holiday1" name="holiday"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="from_date">Closing Start Date</label>
                            <input type="date" class="form-control" id="from_date1" name="from_date" required>
                        </div>
                        <div class="form-group">
                            <label for="to_date">Opening Date</label>
                            <input type="date" class="form-control" id="to_date1" name="to_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updateholiday">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['updateholiday'])) {
        include "common/conn.php";
        $id = $_POST["id4"];
        $holiday = htmlspecialchars($_POST["holiday"]);
        $from_date = $_POST["from_date"];
        $to_date = $_POST["to_date"];

        $date1 = new DateTime($from_date);
        $date2 = new DateTime($to_date);
        $year = $date1->format('Y');

        $totalHours = calculateHours(clone $date1, $date2);
        $interval = $date1->diff($date2);
        $days = $interval->days;

        if (!empty($holiday) && !empty($from_date) && !empty($to_date)) {

            $sql1 = "UPDATE holiday SET year='$year' , holiday_name='$holiday', from_date='$from_date', to_date=' $to_date', number_of_days = '$days',number_of_holiday_hour = '$totalHours' WHERE id='$id'";
            if ($conn->query($sql1) === true) {
                echo " <script>alert('success')</script>";
            } else {
                echo $conn->error;
            }
        } else {
            echo "<script>alert('Form Should Not Be Submit Blank')</script>";
        }
        $conn->close();
    }
    ?>
    <script>
        function myfcn4(idx, holiday, form_date, to_date) {
            document.getElementById("id4").value = idx;
            document.getElementById("holiday1").value = holiday;
            document.getElementById("from_date1").value = form_date;
            document.getElementById("to_date1").value = to_date;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=1.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <!-- for date of closing and opening update-->
    <script>
        document.getElementById("from_date1").addEventListener("change", function () {
            document.getElementById("to_date1").min = this.value;
        });
    </script>
    <!-- for date of closing and opening insert-->
    <script>
        document.getElementById("from_date").addEventListener("change", function () {
            document.getElementById("to_date").min = this.value;
        });
    </script>
</body>

</html>
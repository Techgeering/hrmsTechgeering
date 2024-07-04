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
                        <h1 class="my-2">Holidays</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Holidays
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Days</th>
                                        <th>Year</th>
                                        <th>Hour</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM holiday";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th><?php echo $row["id"]; ?></th>
                                        <th><?php echo $row["holiday_name"]; ?></th>
                                        <th><?php echo $row["from_date"]; ?></th>
                                        <th><?php echo $row["to_date"]; ?></th>
                                        <th><?php echo $row["number_of_days"]; ?></th>
                                        <th><?php echo $row["year"]; ?></th>
                                        <th><?php echo $row["number_of_holiday_hour"]; ?></th>
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
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="holiday">Holiday Name</label>
                            <input type="text" class="form-control" id="holiday" name="holiday">
                        </div>
                        <div class="form-group">
                            <label for="from_date">from_date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date">
                        </div>
                        <div class="form-group">
                            <label for="to_date">to_date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date">
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

function calculateHours($date1, $date2) {
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
    $holiday = $_POST["holiday"];
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $year = date('m-Y');

    $date1 = new DateTime($from_date);
    $date2 = new DateTime($to_date);
    
    $totalHours = calculateHours(clone $date1, $date2); 
    $interval = $date1->diff($date2);
    $days = $interval->days;
    $sql = $conn->prepare("INSERT INTO holiday (holiday_name, from_date, to_date, number_of_days, year, number_of_holiday_hour) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param('sssssi', $holiday, $from_date, $to_date, $days, $year, $totalHours);

    if ($sql->execute()) {
        echo "<script>alert('success');</script>";
    } else {
        echo "<script>alert('error');</script>";
    }
    $sql->close();
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
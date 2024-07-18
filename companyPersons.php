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
    <link href="css/styles.css" rel="stylesheet" />
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
                        <h1 class="my-2">Company Persons</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDept">
                            <i class="fa-solid fa-plus"></i> Company Person
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="th-sm">Sl.No</th>
                                        <th class="th-sm">Company Name</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Designation</th>
                                        <th class="th-sm">Mobile Number</th>
                                        <th class="th-sm">Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="th-sm">Sl.No</th>
                                        <th class="th-sm">Company Name</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Designation</th>
                                        <th class="th-sm">Mobile Number</th>
                                        <th class="th-sm">Email</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT cp.name, cp.designation, cp.mob, cp.email ,c.comp_name
                                    FROM company_person cp
                                    LEFT JOIN company c ON cp.comp_id = c.id";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th>1</th>
                                                <th><?php echo $row["comp_name"]; ?></th>
                                                <th><?php echo $row["name"]; ?></th>
                                                <th><?php echo $row["designation"]; ?></th>
                                                <th><?php echo $row["mob"]; ?></th>
                                                <th><?php echo $row["email"]; ?></th>
                                                <th>adfds</th>
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
                            <label for="companyName">Company Name</label>
                            <select class="form-control" id="companyName" name="companyName">
                                <?php
                                include "common/conn.php";
                                $sql = "SELECT * FROM company";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["comp_name"]; ?></option>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="personName">Name</label>
                            <input type="text" class="form-control" id="personName" name="personName">
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation">
                        </div>
                        <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <input type="text" class="form-control" id="mobileNumber" name="mobileNumber">
                        </div>
                        <div class="form-group">
                            <label for="emailId">Email Id</label>
                            <input type="text" class="form-control" id="emailId" name="emailId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        $companyName = $_POST["companyName"];
        $personName = $_POST["personName"];
        $designation = $_POST["designation"];
        $mobileNumber = $_POST["mobileNumber"];
        $emailId = $_POST["emailId"];

        $sql = "INSERT INTO company_person (comp_id, name, designation, mob, email)
                    VALUES ('$companyName', '$personName', '$designation','$mobileNumber', '$emailId')";

        if ($conn->query($sql) === TRUE) {
            echo " <script>alert('success')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
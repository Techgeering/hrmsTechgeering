<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Department - Hrms Techgeering</title>
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
                        <h2 class="my-2">Internship Student</h2>
                        <a href="internAdd.php" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Internship Student
                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Internship On</th>
                                        <th>View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM internship";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td class="text-center"><img
                                                        src="assets/uploads/intern/<?php echo $row['intern_image']; ?>"
                                                        alt="profile image" width="50" height="50"><button class="border-0"
                                                        data-toggle="modal" data-target="#update10"></button>
                                                </td>
                                                <td><?php echo $row["intern_name"]; ?></td>
                                                <td><?php echo $row["phone"]; ?></td>
                                                <td><?php echo $row["internship_on"]; ?></td>
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
                                                        <div class="modal-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <strong>Father Name:</strong>
                                                                    <?php echo $row["father_name"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Mother Name:</strong>
                                                                    <?php echo $row["mother_name"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Dob:</strong>
                                                                    <?php echo $row["dob"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Gender:</strong> <?php echo $row["gender"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Email Id:</strong>
                                                                    <?php echo $row["intern_email"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Address:</strong>
                                                                    <?php echo $row["intern_add"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Valid Govt. Id No.:</strong>
                                                                    <?php echo $row["valid_govt_no"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Id Type:</strong>
                                                                    <?php echo $row["id_type"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>College Id Number:</strong>
                                                                    <?php echo $row["college_id"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Current Educational Qualification:</strong>
                                                                    <?php echo $row["edu_qualification"]; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>College Name:</strong>
                                                                    <?php echo $row["clg_name"]; ?>
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
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Internship On</th>
                                        <th>View Details</th>
                                    </tr>
                                </tfoot>
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
</body>

</html>
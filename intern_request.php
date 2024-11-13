<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Internship Request - Hrms Techgeering</title>
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
                        <h2 class="my-2">Intern Request</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addreq">
                            <i class="fa-solid fa-plus"></i>Intern Request
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Mobile Number</th>
                                        <th class="text-center">Whatsapp Number</th>
                                        <th class="text-center">College Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Last Followup Date</th>
                                        <th class="text-center">Next Followup Date</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM intern_request";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $encoded_id = base64_encode($row['id']);
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno; ?></td>
                                                <td class="text-center"><?php echo $row["name"]; ?></td>
                                                <td class="text-center"><?php echo $row["email"]; ?></td>
                                                <td class="text-center"><?php echo $row["mob_num"]; ?></td>
                                                <td class="text-center"><?php echo $row["wp_num"]; ?></td>
                                                <td class="text-center"><?php echo $row["clg_name"]; ?></td>
                                                <td class="text-center"><?php echo $row["address"]; ?></td>
                                                <td class="text-center"><?php echo $row["lastfollow"]; ?></td>
                                                <td class="text-center"><?php echo $row["nextfollow"]; ?></td>
                                                <td>
                                                    <a href="intern_requestview.php?id=<?php echo $encoded_id; ?>"><i
                                                            class="fa-solid fa-eye text-success"></i></a>
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
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Mobile Number</th>
                                        <th class="text-center">Whatsapp Number</th>
                                        <th class="text-center">College Name</th>
                                        <th class="text-center">Address</th>
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
    <!-- Modal -->
    <div class="modal fade" id="addreq" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Intern Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Name</label>
                                    <input type="text" class="form-control" id="Name" name="Name"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Email Id</label>
                                    <input type="email" class="form-control" id="Email" name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile" name="mobilenum"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="DepartmentName">Whatsapp Number</label>
                                    <input type="text" class="form-control" id="wpnum" name="wpnum"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="DepartmentName">College Name</label>
                            <input type="text" class="form-control" id="Collegenm" name="clgname">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="DepartmentName">Address</label>
                            <input type="text" class="form-control" id="address" name="Address">
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
    if (isset($_POST['submit'])) {
        include "common/conn.php";
        $Name = $_POST["Name"];
        $mobilenum = $_POST["mobilenum"];
        $wpnum = $_POST["wpnum"];
        $email = $_POST["email"];
        $clgname = htmlspecialchars($_POST["clgname"]);
        $Address = htmlspecialchars($_POST["Address"]);

        if (!empty($Name) && !empty($mobilenum) && !empty($wpnum) && !empty($email) && !empty($clgname) && !empty($Address)) {

            $sql = "INSERT INTO intern_request (name, mob_num, wp_num, email, clg_name, address) VALUES ('$Name','$mobilenum','$wpnum','$email','$clgname','$Address')";
            if ($conn->query($sql) === true) {
                echo "<script>window.location.href='intern_request.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('Form Should Not Be Submit Blank')</script>";
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
</body>

</html>
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
                        <h1 class="my-2">Add New Intern</h1>
                        <a href="internship.php" type="button" class="btn btn-primary">
                            Internship List
                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fathername">Father Name</label>
                                            <input type="text" class="form-control" id="fathername" name="fathername"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="doj">Gender</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="doj">DOB</label>
                                            <input type="date" class="form-control" id="dob" name="dob" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="maritalstatus">Current Educational Qualification</label>
                                            <input type="text" class="form-control" id="currntedu" name="currntedu">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="employeeId">Mobile Number</label>
                                            <input type="text" class="form-control" id="mobilenumber"
                                                name="mobilenumber"
                                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mothername">Mother Name</label>
                                            <input type="text" class="form-control" id="mothername" name="mothername"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Id Type</label>
                                            <select name="idtype" id="idtype" class="form-control" required>
                                                <option value="">Select Id</option>
                                                <option value="adhaar">Adhaar</option>
                                                <option value="pan card">Pan</option>
                                                <option value="driving licence">Driving Licence</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="professionalEmail">College Name</label>
                                            <input type="text" class="form-control" id="clgname" name="clgname">
                                        </div>
                                        <div class="form-group">
                                            <label for="emergencycontact">Internship On</label>
                                            <input type="text" class="form-control" id="internship" name="internship">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="imagess">

                                        </div>
                                        <div class="form-group">
                                            <label for="personalEmail">Email Id</label>
                                            <input type="email" class="form-control" id="emailid" name="emailid"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="govtid">Govt Id Number</label>
                                            <input type="text" class="form-control" id="govtid" name="govtid">
                                        </div>
                                        <div class="form-group">
                                            <label for="clgid">College Id Number</label>
                                            <input type="text" class="form-control" id="clgid" name="clgid">
                                        </div>
                                        <div class="form-group">
                                            <label for="clgid">Document</label>
                                            <input type="file" class="form-control" id="clgid" name="clgid">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <?php
    include "common/conn.php";
    if (isset($_POST['submit'])) {
        function handleFileUpload($fieldName, $uploadDir)
        {
            global $conn;
            $image_name = $_FILES[$fieldName]['name'];
            $image_size = $_FILES[$fieldName]['size'];
            $image_tmp = $_FILES[$fieldName]['tmp_name'];
            $file_type = pathinfo($image_name, PATHINFO_EXTENSION);
            $new_file_name = uniqid() . '.' . $file_type;

            // Ensure upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Ensure directory is writable
            }
            $target_file = $uploadDir . $new_file_name;

            if (move_uploaded_file($image_tmp, $target_file)) {
                return $new_file_name; // Return the generated file name if upload succeeds
            } else {
                return null; // Return null if upload fails
            }
        }
        // File upload directory
        $upload_dir = "assets/uploads/intern/";

        $new_file_name1 = handleFileUpload('imagess', $upload_dir);

        $name = $_POST["name"];
        $fathername = $_POST["fathername"];
        $address = htmlspecialchars($_POST["address"]);
        $emailid = $_POST["emailid"];
        $clgname = htmlspecialchars($_POST["clgname"]);
        $gender = $_POST["gender"];
        $mobilenumber = $_POST["mobilenumber"];
        $mothername = $_POST["mothername"];
        $idtype = $_POST["idtype"];
        $dob = $_POST["dob"];
        $currntedu = htmlspecialchars($_POST["currntedu"]);
        $internship = $_POST["internship"];
        $govtid = $_POST["govtid"];
        $clgid = $_POST["clgid"];

        $sql = "INSERT INTO internship (intern_name, father_name, intern_add, intern_email, clg_name, gender, phone, mother_name, id_type, dob, edu_qualification, internship_on, valid_govt_no, college_id, intern_image) VALUES ('$name','$fathername','$address','$emailid','$clgname','$gender','$mobilenumber','$mothername','$idtype','$dob','$currntedu','$internship','$govtid','$clgid','$new_file_name1')";
        if ($conn->query($sql) === true) {
            echo "<script>window.location.href='internship.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
</body>

</html>
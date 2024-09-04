<?php
session_start(); {
    $em_role = $_SESSION["em_role"];
}
?>
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
                        <h1 class="my-2">Add New Employee</h1>
                        <a href="employees.php" type="button" class="btn btn-primary">
                            Employee List
                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
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
                                            <label for="department">Department</label>
                                            <select name="department" id="department" class="form-control" required>
                                                <option value="">Select Department</option>
                                                <?php
                                                include "common/conn.php";
                                                $result = mysqli_query($conn, "SELECT * FROM department");
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>">
                                                        <?php echo $row["dep_name"]; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Designation</label>
                                            <select name="desig" id="desig" class="form-control" required>
                                                <option value="">Select Designation</option>
                                                <?php
                                                include "common/conn.php";
                                                $result = mysqli_query($conn, "SELECT * FROM designation");
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>">
                                                        <?php echo $row["des_name"]; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
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
                                            <label for="contactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="contactNumber"
                                                name="contactNumber"
                                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bloodGroup">Blood Group</label>
                                            <select name="bloodGroup" id="bloodGroup" class="form-control" required>
                                                <option value="">Select Blood Group</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B-">B-</option>
                                                <option value="B+">B+</option>
                                                <option value="Ab+">AB+</option>
                                                <option value="Ab-">AB-</option>
                                                <option value="OB+">OB+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="employeeId">Employee Id</label>
                                            <input type="text" class="form-control" id="employeeId" name="employeeId"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Role</label>
                                            <select name="role" id="role" class="form-control" required>
                                                <option value="">Select Role</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Manager</option>
                                                <option value="3">Hr</option>
                                                <option value="4">Employee</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="doj">DOB</label>
                                            <input type="date" class="form-control" id="doj" name="doj" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="personalEmail">Email (Personal)</label>
                                            <input type="email" class="form-control" id="personalEmail"
                                                name="personalEmail" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="whatsappNumber">WhatsApp Number</label>
                                            <input type="text" class="form-control" id="whatsappNumber"
                                                name="whatsappNumber"
                                                oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="professionalEmail">Email (Professional)</label>
                                            <input type="email" class="form-control" id="professionalEmail"
                                                name="professionalEmail" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <img src="user.jpg" alt="" class="img-fluid mt-2" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="aadharNumber">Aadhar Number</label>
                                            <input type="text" class="form-control" id="aadharNumber"
                                                name="aadharNumber" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="panNumber">PAN Number</label>
                                            <input type="text" class="form-control" id="panNumber" name="panNumber"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="JoiningDate">Joining Date</label>
                                            <input type="date" class="form-control" id="JoiningDate" name="JoiningDate"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="LeavingDate">Leaving Date <small>(Privious
                                                    Company)</small></label>
                                            <input type="date" class="form-control" id="LeavingDate" name="LeavingDate">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
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
        $name = $_POST["name"];
        $department = $_POST["department"];
        $desig = $_POST["desig"];
        $gender = $_POST["gender"];
        $contactNumber = $_POST["contactNumber"];
        $bloodGroup = $_POST["bloodGroup"];
        $employeeId = $_POST["employeeId"];
        $role = $_POST["role"];
        $doj = $_POST["doj"];
        $personalEmail = $_POST["personalEmail"];
        $whatsappNumber = $_POST["whatsappNumber"];
        $professionalEmail = $_POST["professionalEmail"];
        $aadharNumber = $_POST["aadharNumber"];
        $panNumber = $_POST["panNumber"];
        $JoiningDate = $_POST["JoiningDate"];
        $LeavingDate = $_POST["LeavingDate"];
        $password = $_POST["contactNumber"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Now you can store $hashedPassword in the database
    
        // $image = $_POST["image"];
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            $temp = explode('.', $_FILES['image']['name']);
            $extension = end($temp);
            $upload_file = 'assets/uploads/employee/' . uniqid() . '.' . $extension;
            // Check if file type is allowed
            if (in_array($extension, $allowed_types)) {
                // Move uploaded file to desired directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_file)) {
                    echo "File uploaded successfully.";
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file type. Allowed types: jpg, jpeg, png, gif";
            }
        } else {
            echo "Error: " . $_FILES["image"]["error"];
        }
        $sql = "INSERT INTO employee (des_id, dep_id, full_name, em_email, prof_email, em_password, em_code, em_role, em_gender, em_phone, em_wahtsapp, em_birthday, em_blood_group, em_joining_date, last_company_date, em_aadher, em_pan, em_image) 
            VALUES ('$desig', '$department', '$name', '$personalEmail', '$professionalEmail', '$hashedPassword', '$employeeId', '$role', '$gender', '$contactNumber', '$whatsappNumber', '$doj', '$bloodGroup', '$JoiningDate', '$LeavingDate', '$aadharNumber', '$panNumber', '$upload_file')";
        if (mysqli_query($conn, $sql)) {
            $sql1 = "INSERT INTO address (emp_id, type) VALUES ('$employeeId', 'Permanent')";
            if (mysqli_query($conn, $sql1)) {
                $sql2 = "INSERT INTO address (emp_id, type) VALUES ('$employeeId', 'Present')";
                if (mysqli_query($conn, $sql2)) {
                    $sql3 = "INSERT INTO bank_info (em_id) VALUES ('$employeeId')";
                    if (mysqli_query($conn, $sql3)) {
                        echo "<script>window.location.href='employees.php';</script>";
                    } else {
                        echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                    }
                    echo "<script>alert('Sign up successful!');</script>";
                } else {
                    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    $conn->close();
    ?>
</body>

</html>
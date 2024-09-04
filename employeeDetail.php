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
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 12px;
            transition: 0.3s;
            font-size: 15px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
            animation: fadeEffect 1s;
        }

        /* Go from zero to full opacity */
        @keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>

        <?php
        include 'common/conn.php';
        $empId = isset($_GET['em_id']) ? $_GET['em_id'] : NULL;
        $empId = base64_decode($empId);
        $sql = "SELECT * FROM employee WHERE em_code='$empId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sql1 = "SELECT * FROM address WHERE emp_id='$empId' AND type='Permanent'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $sql2 = "SELECT * FROM address WHERE emp_id='$empId' AND type='Present'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $sql5 = "SELECT * FROM bank_info WHERE em_id='$empId' ";
        $result5 = $conn->query($sql5);
        $row5 = $result5->fetch_assoc();
        ?>

        <!-- end Side Navbar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="my-2">Employee</h3>
                        <a href="employeeAdd.php" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Employee
                        </a>
                    </div>
                    <div class="tab profile ">
                        <button class="tablinks" onclick="openDilog(event, 'PersonalInfo')" id="defaultOpen"> Personal
                            Info</button>
                        <button class="tablinks" onclick="openDilog(event, 'Address')"> Address </button>
                        <button class="tablinks" onclick="openDilog(event, 'Education')">Education</button>
                        <button class="tablinks" onclick="openDilog(event, 'Experience')">Experience</button>
                        <button class="tablinks" onclick="openDilog(event, 'Bank')">Bank Account</button>
                        <button class="tablinks" onclick="openDilog(event, 'Document')">Document</button>
                        <button class="tablinks" onclick="openDilog(event, 'Salary')">Salary</button>
                        <button class="tablinks" onclick="openDilog(event, 'Leave')">Leave</button>
                        <button class="tablinks" onclick="openDilog(event, 'Password')"> Change Password</button>
                    </div>
                    <div id="PersonalInfo" class="tabcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="<?php echo $row["em_image"];
                                        ?>" class="img-circle" width="150">
                                        <h4 class="card-title m-t-10 edit"><?php echo $row["full_name"]; ?></h4>
                                        <input type="text" class='txtedit' value='<?php echo $row["full_name"]; ?>'
                                            id='full_name-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                        <h6 class="card-subtitle edit">Employee Id: <?php echo $row["em_code"]; ?></h6>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_code"]; ?>'
                                            id='em_code-<?php echo $row["id"]; ?>-em_code'
                                            style="display:none;"></input>
                                    </div>
                                    <div>
                                        <hr>
                                    </div>
                                    <div class="card-body"> <small class="text-muted">Email address </small>
                                        <h6 class="edit"><?php echo $row["em_email"]; ?></h6>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_email"]; ?>'
                                            id='em_email-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                        <small class="text-muted p-t-30 db">Phone</small>
                                        <h6 class="edit"><?php echo $row["em_phone"]; ?></h6>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_phone"]; ?>'
                                            id='em_phone-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                        <!-- <small class="text-muted p-t-30 db">Social Profile</small>
                                        <br>
                                        <a class="btn btn-circle btn-secondary" href="" target="_blank"><i
                                                class="fa-brands fa-square-facebook"></i></a>
                                        <a class="btn btn-circle btn-secondary" href="" target="_blank"><i
                                                class="fa-brands fa-instagram"></i></a>
                                        <a class="btn btn-circle btn-secondary" href="" target="_blank"><i
                                                class="fa-brands fa-skype"></i></a>
                                        <a class="btn btn-circle btn-secondary" href="" target="_blank"><i
                                                class="fa-brands fa-linkedin"></i></a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form class="row" action="Update" method="post" enctype="multipart/form-data"
                                    novalidate="novalidate">
                                    <!-- <div class="form-group col-md-4 m-t-10">
                                        <label>Employee Code</label>
                                        <p class="form-control form-control-line"></p>
                                    </div> -->
                                    <!-- <div class="form-group col-md-4 m-t-10">
                                        <label>Full Name</label>
                                        <p class="form-control form-control-line">Asutosh Das</p>
                                    </div> -->
                                    <!-- <div class="form-group col-md-4 m-t-10">
                                        <label>Blood Group </label>
                                        <p class="form-control form-control-line edit">
                                            <?php echo $row["em_blood_group"]; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_blood_group"]; ?>'
                                            id='em_blood_group-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                    </div> -->
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Blood Group</label>
                                        <p class="form-control form-control-line edit"
                                            onclick="showDropdown('em_blood_group-<?php echo $row['id']; ?>-employee')">
                                            <?php echo $row["em_blood_group"]; ?>
                                        </p>
                                        <select class='txtedit' id='em_blood_group-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;">
                                            <option value="A+" <?php if ($row["em_blood_group"] == "A+")
                                                echo 'selected="selected"'; ?>>A+</option>
                                            <option value="A-" <?php if ($row["em_blood_group"] == "A-")
                                                echo 'selected="selected"'; ?>>A-</option>
                                            <option value="B+" <?php if ($row["em_blood_group"] == "B+")
                                                echo 'selected="selected"'; ?>>B+</option>
                                            <option value="B-" <?php if ($row["em_blood_group"] == "B-")
                                                echo 'selected="selected"'; ?>>B-</option>
                                            <option value="O+" <?php if ($row["em_blood_group"] == "O+")
                                                echo 'selected="selected"'; ?>>O+</option>
                                            <option value="O-" <?php if ($row["em_blood_group"] == "O-")
                                                echo 'selected="selected"'; ?>>O-</option>
                                            <option value="AB+" <?php if ($row["em_blood_group"] == "AB+")
                                                echo 'selected="selected"'; ?>>AB+</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Gender </label>
                                        <p class="form-control form-control-line edit"
                                            onclick="showDropdown('em_gender-<?php echo $row['id']; ?>-employee')">
                                            <?php echo $row["em_gender"]; ?>
                                        </p>
                                        <select class='txtedit' id='em_gender-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;">
                                            <option value="Male" <?php if ($row["em_gender"] == "Male")
                                                echo 'selected="selected"'; ?>>Male</option>
                                            <option value="Female" <?php if ($row["em_gender"] == "Female")
                                                echo 'selected="selected"'; ?>>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>User Type </label>
                                        <p class="form-control form-control-line edit"
                                            onclick="showDropdown('em_role-<?php echo $row['id']; ?>-employee')">
                                            <?php
                                            if ($row["em_role"] == 1) {
                                                echo "Admin";
                                            } elseif ($row["em_role"] == 2) {
                                                echo "Manager";
                                            } elseif ($row["em_role"] == 3) {
                                                echo "HR";
                                            } else {
                                                echo "Employee";
                                            }
                                            ?>
                                        </p>
                                        <select class='txtedit' id='em_role-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;">
                                            <option value="1" <?php if ($row["em_role"] == "1")
                                                echo 'selected="selected"'; ?>>Admin</option>
                                            <option value="2" <?php if ($row["em_role"] == "2")
                                                echo 'selected="selected"'; ?>>Manager</option>
                                            <option value="3" <?php if ($row["em_role"] == "3")
                                                echo 'selected="selected"'; ?>>Hr</option>
                                            <option value="4" <?php if ($row["em_role"] == "4")
                                                echo 'selected="selected"'; ?>>Employee</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Status </label>
                                        <p class="form-control form-control-line edit"
                                            onclick="showDropdown('status-<?php echo $row['id']; ?>-employee')">
                                            <?php echo $row["status"]; ?>
                                        </p>
                                        <select class='txtedit' id='status-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;">
                                            <option value="ACTIVE" <?php if ($row["status"] == "ACTIVE")
                                                echo 'selected="selected"'; ?>>ACTIVE</option>
                                            <option value="INACTIVE" <?php if ($row["status"] == "INACTIVE")
                                                echo 'selected="selected"'; ?>>INACTIVE</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group col-md-4 m-t-10">
                                        <label>Date Of Birth </label>
                                        <p class="form-control form-control-line edit">
                                            <?php echo $row["em_birthday"]; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_birthday"]; ?>'
                                            id='em_birthday-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                    </div> -->
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Date Of Birth</label>
                                        <p class="form-control form-control-line edit">
                                            <?php echo $row["em_birthday"]; ?>
                                        </p>
                                        <input type="date" class='txtedit' value='<?php echo $row["em_birthday"]; ?>'
                                            id='em_birthday-<?php echo $row["id"]; ?>-employee' style="display:none;">
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Whatsapp Number </label>
                                        <p class="form-control form-control-line edit">
                                            <?php echo $row["em_wahtsapp"]; ?>
                                        </p>
                                        <input type="text" class="txtedit" value="<?php echo $row["em_wahtsapp"]; ?>"
                                            id="em_wahtsapp-<?php echo $row["id"]; ?>-employee" pattern="\d{10}"
                                            maxlength="10" minlength="10" title="Please enter exactly 10 digits"
                                            oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                            style="display:none;">
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Department</label>
                                        <p class="form-control form-control-line edit">
                                            <?php
                                            $dept_id = $row["dep_id"];
                                            $sql12 = "SELECT * FROM department WHERE id = $dept_id";
                                            $result12 = $conn->query($sql12);
                                            $row12 = $result12->fetch_assoc();
                                            echo $row12["dep_name"];
                                            ?>
                                        </p>
                                        <select class='txtedit' value='<?php echo $row["dep_id"]; ?>'
                                            id='dep_id-<?php echo $row["id"]; ?>-employee' style="display: none;">
                                            <?php
                                            $sqlaa = "SELECT * FROM department";
                                            $resultaa = $conn->query($sqlaa);
                                            while ($rowa = $resultaa->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $rowa['id']; ?>">
                                                    <?php echo $rowa['dep_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Designation </label>
                                        <p class="form-control form-control-line edit">
                                            <?php
                                            $des_id = $row["des_id"];
                                            $sql13 = "SELECT * FROM designation WHERE id = $des_id";
                                            $result13 = $conn->query($sql13);
                                            $row13 = $result13->fetch_assoc();
                                            echo $row13["des_name"];
                                            ?>
                                        </p>
                                        <select class='txtedit' value='<?php echo $row["des_id"]; ?>'
                                            id='des_id-<?php echo $row["id"]; ?>-employee' style="display: none;">
                                            <?php
                                            $sqlaaa = "SELECT * FROM designation";
                                            $resultaaa = $conn->query($sqlaaa);
                                            while ($rowaa = $resultaaa->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $rowaa['id']; ?>">
                                                    <?php echo $rowaa['des_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Date Of Joining </label>
                                        <p class="form-control form-control-line edit">
                                            <?php echo $row["em_joining_date"]; ?>
                                        </p>
                                        <input type="date" class='txtedit'
                                            value='<?php echo $row["em_joining_date"]; ?>'
                                            id='em_joining_date-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Contract End Date</label>
                                        <p class="form-control form-control-line edit">
                                            <?php echo $row["em_contact_end"]; ?>
                                        </p>
                                        <input type="date" class='txtedit' value='<?php echo $row["em_contact_end"]; ?>'
                                            id='em_contact_end-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;">
                                    </div>
                                    <!-- <div class="form-group col-md-4 m-t-10">
                                        <label>Email </label>
                                        <p class="form-control form-control-line">email@mail.com</p>
                                    </div> -->
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Aadher Number </label>
                                        <p class="form-control form-control-line edit"><?php echo $row["em_aadher"]; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_aadher"]; ?>'
                                            id='em_aadher-<?php echo $row["id"]; ?>-employee'
                                            oninput="if(this.value.length > 20) this.value = this.value.slice(0, 20); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                            style="display:none;">
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>PAN Number </label>
                                        <p class="form-control form-control-line edit"><?php echo $row["em_pan"]; ?></p>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_pan"]; ?>'
                                            id='em_pan-<?php echo $row["id"]; ?>-employee' style="display:none;">
                                    </div>
                                    <!-- <div class="form-actions col-md-12">
                                        <input type="hidden" name="emid" value="Soy1332">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                            Save</button>
                                        <button type="button" class="btn btn-danger">Cancel</button>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="Address" class="tabcontent">
                        <div class="row m-2">
                            <div class="col-6 card p-2">
                                <h4 class="test-center">Permanent Address</h4>
                                <p class="form-control form-control-line edit">
                                    <?php echo !empty($row1["address1"]) ? $row1["address1"] : "N/A"; ?>
                                </p>
                                <input type="text" class='txtedit' value='<?php echo $row1["address1"]; ?>'
                                    id='address1-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                <p class="form-control form-control-line edit">
                                    <?php echo !empty($row1["address2"]) ? $row1["address2"] : "N/A"; ?>
                                </p>
                                <input type="text" class='txtedit' value='<?php echo $row1["address2"]; ?>'
                                    id='address2-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row1["city"]) ? $row1["city"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row1["city"]; ?>'
                                            id='city-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row1["state"]) ? $row1["state"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row1["state"]; ?>'
                                            id='state-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row1["country"]) ? $row1["country"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row1["country"]; ?>'
                                            id='country-<?php echo $row1["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row1["pincode"]) ? $row1["pincode"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row1["pincode"]; ?>'
                                            id='pincode-<?php echo $row1["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 card p-2">
                                <h4 class="test-center">Present Address</h4>
                                <p class="form-control form-control-line edit">
                                    <?php echo !empty($row2["address1"]) ? $row2["address1"] : "N/A"; ?>
                                </p>
                                <input type="text" class='txtedit' value='<?php echo $row2["address1"]; ?>'
                                    id='address1-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                <p class="form-control form-control-line edit">
                                    <?php echo !empty($row2["address2"]) ? $row2["address2"] : "N/A"; ?>
                                </p>
                                <input type="text" class='txtedit' value='<?php echo $row2["address2"]; ?>'
                                    id='address2-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row2["city"]) ? $row2["city"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row2["city"]; ?>'
                                            id='city-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row2["state"]) ? $row2["state"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row2["state"]; ?>'
                                            id='state-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row2["country"]) ? $row2["country"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row2["country"]; ?>'
                                            id='country-<?php echo $row2["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit">
                                            <?php echo !empty($row2["pincode"]) ? $row2["pincode"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit' value='<?php echo $row2["pincode"]; ?>'
                                            id='pincode-<?php echo $row2["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="Address" class="tabcontent">
                        <div class="row m-2">
                            <div class="col-6 card p-2">
                                <h4 class="test-center">Present Address</h4>
                                <p class="form-control form-control-line edit"
                                    onclick="editField('address1-<?php echo $row1["id"]; ?>-address')">
                                    <?php echo !empty($row1["address1"]) ? $row1["address1"] : "N/A"; ?>
                                </p>
                                <input type="text" class='txtedit'
                                    value='<?php echo !empty($row1["address1"]) ? $row1["address1"] : "N/A"; ?>'
                                    id='address1-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                <p class="form-control form-control-line edit"
                                    onclick="editField('address2-<?php echo $row1["id"]; ?>-address')">
                                    <?php echo !empty($row1["address2"]) ? $row1["address2"] : "N/A"; ?>
                                </p>
                                <input type="text" class='txtedit'
                                    value='<?php echo !empty($row1["address2"]) ? $row1["address2"] : "N/A"; ?>'
                                    id='address2-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('city-<?php echo $row1["id"]; ?>-address')">
                                            <?php echo !empty($row1["city"]) ? $row1["city"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row1["city"]) ? $row1["city"] : "N/A"; ?>'
                                            id='city-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('state-<?php echo $row1["id"]; ?>-address')">
                                            <?php echo !empty($row1["state"]) ? $row1["state"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row1["state"]) ? $row1["state"] : "N/A"; ?>'
                                            id='state-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('country-<?php echo $row1["id"]; ?>-address')">
                                            <?php echo !empty($row1["country"]) ? $row1["country"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row1["country"]) ? $row1["country"] : "N/A"; ?>'
                                            id='country-<?php echo $row1["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('pincode-<?php echo $row1["id"]; ?>-address')">
                                            <?php echo !empty($row1["pincode"]) ? $row1["pincode"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row1["pincode"]) ? $row1["pincode"] : "N/A"; ?>'
                                            id='pincode-<?php echo $row1["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 card p-2">
                                <h4 class="test-center">Permanent Address</h4>
                                <p class="form-control form-control-line"
                                    onclick="editField('address1-<?php echo $row2["id"]; ?>-address')">
                                    <?php echo !empty($row2["address1"]) ? $row2["address1"] : "N/A"; ?>
                                </p>
                                <p class="form-control form-control-line"
                                    onclick="editField('address2-<?php echo $row2["id"]; ?>-address')">
                                    <?php echo !empty($row2["address2"]) ? $row2["address2"] : "N/A"; ?>
                                </p>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('city-<?php echo $row2["id"]; ?>-address')">
                                            <?php echo !empty($row2["city"]) ? $row2["city"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row2["city"]) ? $row2["city"] : "N/A"; ?>'
                                            id='city-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('state-<?php echo $row2["id"]; ?>-address')">
                                            <?php echo !empty($row2["state"]) ? $row2["state"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row2["state"]) ? $row2["state"] : "N/A"; ?>'
                                            id='state-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('country-<?php echo $row2["id"]; ?>-address')">
                                            <?php echo !empty($row2["country"]) ? $row2["country"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row2["country"]) ? $row2["country"] : "N/A"; ?>'
                                            id='country-<?php echo $row2["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('pincode-<?php echo $row2["id"]; ?>-address')">
                                            <?php echo !empty($row2["pincode"]) ? $row2["pincode"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class='txtedit'
                                            value='<?php echo !empty($row2["pincode"]) ? $row2["pincode"] : "N/A"; ?>'
                                            id='pincode-<?php echo $row2["id"]; ?>-address'
                                            style="display:none;"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div id="Education" class="tabcontent p-2">
                        <div class="card p-2 m-2">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Degree Title</th>
                                        <th>Institute Name</th>
                                        <th>University Name</th>
                                        <th>Result</th>
                                        <th>Passing Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql3 = "SELECT * FROM education WHERE emp_id='$empId'";
                                    $result3 = $conn->query($sql3);
                                    $slno = 1;
                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $row3["edu_type"]; ?></td>
                                                <td><?php echo $row3["institute"]; ?></td>
                                                <td><?php echo $row3["university"]; ?></td>
                                                <td><?php echo $row3["result"]; ?></td>
                                                <td><?php echo $row3["year"]; ?></td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card m-2">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="m-2">
                                            <input type="text" class="form-control form-control-line P-2"
                                                name="degreetitle" id="degreetitle" placeholder="Degree Title" required>
                                        </div>
                                        <div class="m-2">
                                            <input type="text" class="form-control form-control-line" name="university"
                                                id="university" placeholder="University Name" required>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="m-2">
                                            <input type="text" class="form-control form-control-line" name="institute"
                                                id="institute"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                                placeholder="Institute Name" required>
                                        </div>
                                        <div class="row m-2">
                                            <div class="col-6">
                                                <div class="">
                                                    <input type="text" class="form-control form-control-line P-2"
                                                        name="result"
                                                        oninput="this.value = this.value.replace(/[^0-9+_.%]/g,'');"
                                                        id="result" placeholder="Result" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="">
                                                    <input type="text" class="form-control form-control-line"
                                                        name="passingyear" id="passingyear"
                                                        oninput="this.value = this.value.replace(/[^0-9+_.%]/g,'');"
                                                        placeholder="Passing Year" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 m-3">
                                        <button type="submit" class="btn btn-success" name="insertdegree">
                                            <i class="fa fa-check"></i>Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['insertdegree'])) {
                        include "common/conn.php";
                        $degreetitle = $_POST["degreetitle"];
                        $result = $_POST["result"];
                        $institute = $_POST["institute"];
                        $university = $_POST["university"];
                        $passingyear = $_POST["passingyear"];
                        $sqleducation = "INSERT INTO education (edu_type, institute, university, result, year, emp_id) VALUES ('$degreetitle', '$institute', '$university', '$result', '$passingyear', '$empId')";
                        if ($conn->query($sqleducation) === true) {
                            echo "<script>alert('Form submitted successfully');</script>";
                        } else {
                            $conn->error;
                        }
                        $conn->close();
                    }
                    ?>
                    <div id="Experience" class="tabcontent p-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Company name</th>
                                                <th>Position </th>
                                                <th>Work Duration</th>
                                                <th>Address</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql4 = "SELECT * FROM emp_experience WHERE emp_id='$empId'";
                                            $result4 = $conn->query($sql4);
                                            $slno = 1;
                                            if ($result4->num_rows > 0) {
                                                // output data of each row
                                                while ($row4 = $result4->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $slno; ?></td>
                                                        <td><?php echo $row4["exp_company"]; ?></td>
                                                        <td><?php echo $row4["exp_com_position"]; ?></td>
                                                        <td><?php echo $row4["exp_workduration"]; ?></td>
                                                        <td><?php echo $row4["exp_com_address"]; ?></td>
                                                    </tr>
                                                    <?php
                                                    $slno++;
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="row" action="<?php $_SERVER['PHP_SELF']; ?>" method="post"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    <div class="form-group col-md-6 m-t-5">
                                        <label> Company Name</label>
                                        <input type="text" name="company_name" id="companyname"
                                            class="form-control form-control-line company_name"
                                            placeholder="Company Name" minlength="2" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Position</label>
                                        <input type="text" name="position_name" id="positionname"
                                            class="form-control form-control-line position_name"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); this.value = this.value.split(' ').map(function(word) {return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();}).join(' ');this.setCustomValidity(''); this.checkValidity();"
                                            placeholder="Position" minlength="3" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Address</label>
                                        <input type="text" name="address" id="addressa"
                                            class="form-control form-control-line duty" placeholder="Address"
                                            minlength="7" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Working Duration</label>
                                        <input type="text" name="work_duration" id="workingduration"
                                            class="form-control form-control-line working_period"
                                            placeholder="Working Duration"
                                            oninput="this.value = this.value.replace(/[^0-9+_.%]/g,'');" required>
                                    </div>
                                    <div class="form-actions col-md-12">
                                        <input type="hidden" name="emid" value="Soy1332">
                                        <button type="submit" class="btn btn-success" name="insertexperience">
                                            <i class="fa fa-check"></i>
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['insertexperience'])) {
                        include "common/conn.php";
                        $companyname = $_POST["company_name"];
                        $positionname = $_POST["position_name"];
                        $address = $_POST["address"];
                        $workduration = $_POST["work_duration"];
                        $sqlexperience = "INSERT INTO emp_experience (exp_company, exp_com_position, exp_com_address, exp_workduration, emp_id) VALUES ('$companyname','$positionname','$address', '$workduration','$empId')";
                        if ($conn->query($sqlexperience) === true) {
                            echo "<script>alert('Form submitted successfully');</script>";
                        } else {
                            $conn->error;
                        }
                        $conn->close();
                    }
                    ?>
                    <div id="Bank" class="tabcontent">
                        <div class="card">
                            <div class="card-body">
                                <form class="row" action="Add_bank_info" method="post" enctype="multipart/form-data"
                                    novalidate="novalidate">
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Name</label>
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('bank_name-<?php echo $row5["id"]; ?>-bank_info')">
                                            <?php echo !empty($row5["bank_name"]) ? $row5["bank_name"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class="txtedit"
                                            value="<?php echo !empty($row5["bank_name"]) ? $row5["bank_name"] : ""; ?>"
                                            id="bank_name-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Holder Name</label>
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('holder_name-<?php echo $row5["id"]; ?>-bank_info')">
                                            <?php echo !empty($row5["holder_name"]) ? $row5["holder_name"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class="txtedit"
                                            value="<?php echo !empty($row5["holder_name"]) ? $row5["holder_name"] : ""; ?>"
                                            id="holder_name-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Branch Name</label>
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('branch_name-<?php echo $row5["id"]; ?>-bank_info')">
                                            <?php echo !empty($row5["branch_name"]) ? $row5["branch_name"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class="txtedit"
                                            value="<?php echo !empty($row5["branch_name"]) ? $row5["branch_name"] : ""; ?>"
                                            id="branch_name-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Number</label>
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('account_number-<?php echo $row5["id"]; ?>-bank_info')">
                                            <?php echo !empty($row5["account_number"]) ? $row5["account_number"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class="txtedit"
                                            value="<?php echo !empty($row5["account_number"]) ? $row5["account_number"] : ""; ?>"
                                            id="account_number-<?php echo $row5["id"]; ?>-bank_info"
                                            style="display:none;">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>IFSC Code</label>
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('ifsc_code-<?php echo $row5["id"]; ?>-bank_info')">
                                            <?php echo !empty($row5["ifsc_code"]) ? $row5["ifsc_code"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class="txtedit"
                                            value="<?php echo !empty($row5["ifsc_code"]) ? $row5["ifsc_code"] : ""; ?>"
                                            id="ifsc_code-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Type</label>
                                        <p class="form-control form-control-line edit"
                                            onclick="editField('account_type-<?php echo $row5["id"]; ?>-bank_info')">
                                            <?php echo !empty($row5["account_type"]) ? $row5["account_type"] : "N/A"; ?>
                                        </p>
                                        <input type="text" class="txtedit"
                                            value="<?php echo !empty($row5["account_type"]) ? $row5["account_type"] : ""; ?>"
                                            id="account_type-<?php echo $row5["id"]; ?>-bank_info"
                                            style="display:none;">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="Document" class="tabcontent">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td>ID </td>
                                                <td>File Name</td>
                                                <td>Files </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql6 = "SELECT * FROM employee_file WHERE em_id='$empId'";
                                            $result6 = $conn->query($sql6);
                                            $slno = 1;
                                            if ($result6->num_rows > 0) {
                                                // output data of each row
                                                while ($row6 = $result6->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $slno; ?></td>
                                                        <td><?php echo $row6["file_title"]; ?></td>
                                                        <td>
                                                            <a href="assets/uploads/employee/<?php echo $row6['file_url']; ?>"
                                                                target="_blank">
                                                                <i class="fas fa-file-pdf"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="row" action="<?php $_SERVER['PHP_SELF']; ?>" method="post"
                                    enctype="multipart/form-data" novalidate="novalidate">
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>File Name</label>
                                        <input type="text" name="file_name"
                                            class="form-control form-control-line company_name" placeholder="File Name"
                                            minlength="2" required="">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Upload Files</label>
                                        <input type="file" name="pdf1"
                                            class="form-control form-control-line position_name"
                                            accept=".pdf,.docx,.doc" placeholder="Position"
                                            onchange="checkFileType(this)" minlength="3" required="">
                                    </div>
                                    <div class="form-actions col-md-12">
                                        <input type="hidden" name="emid" value="Soy1332">
                                        <button type="submit" name="add_file" class="btn btn-success"><i
                                                class="fa fa-check"></i>
                                            Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['add_file'])) {
                        include "common/conn.php";
                        // Check if file was uploaded
                        if (isset($_FILES['pdf1']) && $_FILES['pdf1']['error'] == 0) {
                            $pdf_name = $_FILES['pdf1']['name'];
                            $pdf_size = $_FILES['pdf1']['size'];
                            $pdf_tmp = $_FILES['pdf1']['tmp_name'];
                            $file_type = pathinfo($pdf_name, PATHINFO_EXTENSION);
                            $allowed_types = ['pdf']; // Allowed file types
                    
                            // Validate file type
                            if (in_array($file_type, $allowed_types)) {
                                $new_file_name = uniqid() . '.' . $file_type;
                                $upload_dir = "assets/uploads/employee/";

                                // Create directory if it does not exist
                                if (!is_dir($upload_dir)) {
                                    mkdir($upload_dir);
                                }

                                $target_file = $upload_dir . $new_file_name;

                                // Move uploaded file to target directory
                                if (move_uploaded_file($pdf_tmp, $target_file)) {
                                    // File uploaded successfully
                                } else {
                                    echo "<script>alert('File not uploaded');</script>";
                                }
                            } else {
                                echo "<script>alert('Invalid file type. Only PDFs are allowed.');</script>";
                            }
                        } else {
                            echo "<script>alert('No file uploaded or file upload error.');</script>";
                        }

                        // Get form data
                        $filename = $_POST["file_name"];

                        // Insert data into database
                        $sqldocument = "INSERT INTO employee_file (file_url, file_title, em_id) VALUES ('$new_file_name', '$filename', '$empId')";
                        if ($conn->query($sqldocument) === true) {
                            echo "<script>alert('Form submitted successfully');</script>";
                        } else {
                            $conn->error;
                        }
                        $conn->close();
                    }
                    ?>
                    <div id="Salary" class="tabcontent">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Basic Salary</h3>
                                <form action="Add_Salary" method="post" enctype="multipart/form-data"
                                    novalidate="novalidate">
                                    <div class="row">
                                        <div class="form-group col-md-6 m-t-5">
                                            <label class="control-label">Salary Type</label>
                                            <select class="form-control  custom-select"
                                                data-placeholder="Choose a Category" tabindex="1" name="typeid"
                                                required="">
                                                <!-- <option selected>Choose Type...</option> -->
                                                <option value="2">Monthly</option>
                                                <option value="4">Daily</option>
                                                <option value="1">Hourly</option>
                                                <option value="2">Monthly</option>
                                                <option value="3">Weekly</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Total Salary</label>
                                            <input type="text" name="total" class="form-control form-control-line total"
                                                placeholder="Total Salary" value="18100" minlength="3" required="">
                                        </div>
                                    </div>
                                    <h3 class="card-title">Addition</h3>
                                    <div class="row">
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Basic</label>
                                            <input type="text" name="basic" class="form-control form-control-line basic"
                                                placeholder="Basic..." value="9050.00">
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>House Rent</label>
                                            <input type="text" name="houserent"
                                                class="form-control form-control-line houserent"
                                                placeholder="House Rent..." value="7240.00">
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Medical</label>
                                            <input type="text" name="medical"
                                                class="form-control form-control-line medical" placeholder="Medical..."
                                                value="905.00">
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Conveyance</label>
                                            <input type="text" name="conveyance"
                                                class="form-control form-control-line conveyance"
                                                placeholder="Conveyance..." value="905.00">
                                        </div>
                                    </div>
                                    <h3 class="card-title">Deduction</h3>
                                    <div class="row">
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Insurance</label>
                                            <input type="text" name="bima" class="form-control form-control-line"
                                                placeholder="Insurance" value="">
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Tax</label>
                                            <input type="text" name="tax" class="form-control form-control-line"
                                                placeholder="Tax" value="10">
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Provident Fund</label>
                                            <input type="text" name="provident" class="form-control form-control-line"
                                                placeholder="Provident..." value="500">
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Others</label>
                                            <input type="text" name="others" class="form-control form-control-line"
                                                placeholder="others..." value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="hidden" name="emid" value="Soy1332">
                                            <input type="hidden" name="sid" value="3">
                                            <input type="hidden" name="aid" value="3">
                                            <input type="hidden" name="did" value="3">
                                            <button type="submit" style="float: right" class="btn btn-success">Add
                                                Salary</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="Leave" class="tabcontent">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example1"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Leave Type</th>
                                                <th>Total Leave </th>
                                                <th>Taken Leave</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql4 = "SELECT * FROM leave_types";
                                            $result4 = $conn->query($sql4);

                                            if ($result4->num_rows > 0) {
                                                $slNo = 1;
                                                while ($row4 = $result4->fetch_assoc()) {
                                                    // Calculate taken leave
                                                    $leaveType = $row4["name"];
                                                    $sqlTakenLeave = "SELECT COUNT(*) AS taken_leave FROM emp_leave WHERE typeid = '$leaveType' AND em_id='$empId'";
                                                    $resultTakenLeave = $conn->query($sqlTakenLeave);
                                                    $takenLeave = 0;
                                                    if ($resultTakenLeave->num_rows > 0) {
                                                        $rowTakenLeave = $resultTakenLeave->fetch_assoc();
                                                        $takenLeave = $rowTakenLeave["taken_leave"];
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $slNo; ?></td>
                                                        <td><?php echo $row4["name"]; ?></td>
                                                        <td><?php echo $row4["leave_day"]; ?></td>
                                                        <td><?php echo $takenLeave; ?></td>
                                                    </tr>
                                                    <?php
                                                    $slNo++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>0 results</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="card-body">
                                <form class="row" action="Add_Experience" method="post" enctype="multipart/form-data"
                                    novalidate="novalidate">
                                    <div class="form-group col-md-6 m-t-5">
                                        <label> Company Name</label>
                                        <input type="text" name="company_name"
                                            class="form-control form-control-line company_name"
                                            placeholder="Company Name" minlength="2" required="">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Position</label>
                                        <input type="text" name="position_name"
                                            class="form-control form-control-line position_name" placeholder="Position"
                                            minlength="3" required="">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control form-control-line duty"
                                            placeholder="Address" minlength="7" required="">
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Working Duration</label>
                                        <input type="text" name="work_duration"
                                            class="form-control form-control-line working_period"
                                            placeholder="Working Duration" required="">
                                    </div>
                                    <div class="form-actions col-md-12">
                                        <input type="hidden" name="emid" value="Soy1332">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                            Save</button>
                                    </div>
                                </form>
                            </div> -->
                        </div>
                    </div>
                    <div id="Password" class="tabcontent">
                        <h3>Change Password</h3>
                        <div class="card-body">
                            <form class="row" action="<?php $_SERVER['PHP_SELF']; ?>" method="post"
                                enctype="multipart/form-data" novalidate="novalidate">
                                <div class="form-group col-md-6 m-t-5">
                                    <label>New Password</label>
                                    <input type="text" name="file_name"
                                        class="form-control form-control-line company_name"
                                        placeholder="Give New Password" minlength="2" required="">
                                </div>
                                <div class="form-actions col-md-12">
                                    <input type="hidden" name="emid" value="Soy1332">
                                    <button type="submit" name="changepassword" class="btn btn-success"><i
                                            class="fa fa-check"></i>
                                        Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['changepassword'])) {
                        include "common/conn.php";
                        // Get form data
                        $filename = $_POST["file_name"];
                        $hashedPassword = password_hash($filename, PASSWORD_DEFAULT);

                        // Insert data into database
                        $sqlpessword = "UPDATE employee SET em_password='$hashedPassword' WHERE em_code='$empId'";
                        if ($conn->query($sqlpessword) === true) {
                            echo "<script>alert('Password Changed successfully');</script>";
                        } else {
                            $conn->error;
                        }
                        $conn->close();
                    }
                    ?>
                </div>
            </main>
            <?php include 'common/copyrightfooter.php' ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function openDilog(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
    </script>
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
    <!-- for input show and hide -->
    <script>
        function showInput(inputId) {
            document.getElementById(inputId).style.display = 'inline';
        }

        function hideInput(inputId) {
            document.getElementById(inputId).style.display = 'none';
        }
    </script>
</body>

</html>
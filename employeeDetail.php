<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Employee Details - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
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
                        <h3 class="my-2">Employee Details</h3>
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
                        <button class="tablinks" onclick="openDilog(event, 'Earnings')">Earnings</button>
                        <button class="tablinks" onclick="openDilog(event, 'Password')"> Change Password</button>
                    </div>
                    <div id="PersonalInfo" class="tabcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="<?php echo $row["em_image"];
                                        ?>" class="img-circle" width="150">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter">
                                            <i class="fas fa-pencil-alt edit-icon">Edit image</i>
                                        </button>
                                        <h4 class="card-title m-t-10 edit"><?php echo $row["full_name"]; ?></h4>
                                        <input type="text" class='txtedit' value='<?php echo $row["full_name"]; ?>'
                                            id='full_name-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                        <h6 class="card-subtitle">Employee Id: <?php echo $row["em_code"]; ?></h6>
                                        <button data-bs-toggle="modal" data-bs-target="#exampleModalcode">
                                            <i class="fas fa-pencil-alt edit-icon">Edit Emp Id</i>
                                        </button>
                                    </div>
                                    <div>
                                        <hr>
                                    </div>
                                    <div class="card-body"><small class="text-muted">Email address </small>
                                        <h6 class="edit"><?php echo $row["em_email"]; ?></h6>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_email"]; ?>'
                                            id='em_email-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                        <small class="text-muted">Professional Email address </small>
                                        <h6 class="edit"><?php echo $row["prof_email"]; ?></h6>
                                        <input type="text" class='txtedit' value='<?php echo $row["prof_email"]; ?>'
                                            id='prof_email-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                        <small class="text-muted p-t-30 db">Phone</small>
                                        <h6 class="edit"><?php echo $row["em_phone"]; ?></h6>
                                        <input type="text" class='txtedit' value='<?php echo $row["em_phone"]; ?>'
                                            id='em_phone-<?php echo $row["id"]; ?>-employee'
                                            style="display:none;"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form class="row" action="Update" method="post" enctype="multipart/form-data"
                                    novalidate="novalidate">
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Father Name</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row["father_name"]) ? $row["father_name"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row["father_name"]; ?>'
                                                id='father_name-<?php echo $row["id"]; ?>-employee' style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row["father_name"]) ? $row["father_name"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Mother Name</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row["mother_name"]) ? $row["mother_name"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row["mother_name"]; ?>'
                                                id='mother_name-<?php echo $row["id"]; ?>-employee' style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row["mother_name"]) ? $row["mother_name"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Blood Group</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo $row["em_blood_group"]; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Gender </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo $row["em_gender"]; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Marital Status </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"
                                                onclick="showDropdown('marital_status-<?php echo $row['id']; ?>-employee')">
                                                <?php echo !empty($row["marital_status"]) ? $row["marital_status"] : 'N/A'; ?>
                                            </p>
                                            <select class='txtedit' id='marital_status-<?php echo $row["id"]; ?>-employee'
                                                style="display:none;">
                                                <option value="Single" <?php if ($row["marital_status"] == "Single")
                                                    echo 'selected="selected"'; ?>>Single</option>
                                                <option value="Married" <?php if ($row["marital_status"] == "Married")
                                                    echo 'selected="selected"'; ?>>Married</option>
                                                <option value="Widowed" <?php if ($row["marital_status"] == "Widowed")
                                                    echo 'selected="selected"'; ?>>Widowed</option>
                                                <option value="Divorced" <?php if ($row["marital_status"] == "Divorced")
                                                    echo 'selected="selected"'; ?>>Divorced</option>
                                                <option value="Separated" <?php if ($row["marital_status"] == "Separated")
                                                    echo 'selected="selected"'; ?>>Separated</option>
                                            </select>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row["marital_status"]) ? $row["marital_status"] : 'N/A'; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>User Type </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
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
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Status </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo $row["status"]; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Date Of Birth</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo $row["em_birthday"]; ?>
                                            </p>
                                            <input type="date" class='txtedit' value='<?php echo $row["em_birthday"]; ?>'
                                                id='em_birthday-<?php echo $row["id"]; ?>-employee' style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo $row["em_birthday"]; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Department</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php
                                                $dept_id = $row["dep_id"];
                                                $sql12 = "SELECT * FROM department WHERE id = $dept_id";
                                                $result12 = $conn->query($sql12);
                                                $row12 = $result12->fetch_assoc();
                                                echo $row12["dep_name"];
                                                ?>
                                            <?php } ?>
                                        </p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Designation </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php
                                                $des_id = $row["des_id"];
                                                $sql13 = "SELECT * FROM designation WHERE id = $des_id";
                                                $result13 = $conn->query($sql13);
                                                $row13 = $result13->fetch_assoc();
                                                echo $row13["des_name"];
                                                ?>
                                            <?php } ?>
                                        </p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Date Of Joining </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo $row["em_joining_date"]; ?>
                                            </p>
                                            <input type="date" class='txtedit'
                                                value='<?php echo $row["em_joining_date"]; ?>'
                                                id='em_joining_date-<?php echo $row["id"]; ?>-employee'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo $row["em_joining_date"]; ?>
                                            <?php } ?>
                                        </p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Last Company Date</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["last_company_date"]) ? $row2["last_company_date"] : "N/A"; ?>
                                            </p>
                                            <input type="date" class='txtedit'
                                                value='<?php echo $row["last_company_date"]; ?>'
                                                id='last_company_date-<?php echo $row["id"]; ?>-employee'
                                                style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["last_company_date"]) ? $row2["last_company_date"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-3 m-t-10">
                                        <label>Whatsapp Number </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo $row["em_wahtsapp"]; ?>
                                            </p>
                                            <input type="text" class="txtedit" value="<?php echo $row["em_wahtsapp"]; ?>"
                                                id="em_wahtsapp-<?php echo $row["id"]; ?>-employee" pattern="\d{10}"
                                                maxlength="10" minlength="10" title="Please enter exactly 10 digits"
                                                oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                                style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo $row["em_wahtsapp"]; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-3 m-t-10">
                                        <label>Aadher Number </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"><?php echo $row["em_aadher"]; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row["em_aadher"]; ?>'
                                                id='em_aadher-<?php echo $row["id"]; ?>-employee'
                                                oninput="if(this.value.length > 20) this.value = this.value.slice(0, 20); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity();"
                                                style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"><?php echo $row["em_aadher"]; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-3 m-t-10">
                                        <label>PAN Number </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"><?php echo $row["em_pan"]; ?></p>
                                            <input type="text" class='txtedit' value='<?php echo $row["em_pan"]; ?>'
                                                id='em_pan-<?php echo $row["id"]; ?>-employee' style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"><?php echo $row["em_pan"]; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-3 m-t-10">
                                        <label>Emergency Contact </label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo $row["emergency_contact"]; ?>
                                            </p>
                                            <input type="text" class='txtedit'
                                                value='<?php echo $row["emergency_contact"]; ?>'
                                                id='emergency_contact-<?php echo $row["id"]; ?>-employee'
                                                style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo $row["emergency_contact"]; ?>
                                            <?php } ?>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="Address" class="tabcontent">
                        <div class="row m-2">
                            <div class="col-6 card p-2">
                                <h4 class="test-center">Permanent Address</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <lable>Address 1/At</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["address1"]) ? $row1["address1"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["address1"]; ?>'
                                                id='address1-<?php echo $row1["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["address1"]) ? $row1["address1"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>Post</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["post"]) ? $row1["post"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["post"]; ?>'
                                                id='post-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["post"]) ? $row1["post"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>Police station</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["polic_station"]) ? $row1["polic_station"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["polic_station"]; ?>'
                                                id='polic_station-<?php echo $row1["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["polic_station"]) ? $row1["polic_station"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>City</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["city"]) ? $row1["city"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["city"]; ?>'
                                                id='city-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["city"]) ? $row1["city"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>District</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["dist"]) ? $row1["dist"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["dist"]; ?>'
                                                id='dist-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["dist"]) ? $row1["dist"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>State</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["state"]) ? $row1["state"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["state"]; ?>'
                                                id='state-<?php echo $row1["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["state"]) ? $row1["state"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>Country</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["country"]) ? $row1["country"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["country"]; ?>'
                                                id='country-<?php echo $row1["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["country"]) ? $row1["country"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>Pin code</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row1["pincode"]) ? $row1["pincode"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row1["pincode"]; ?>'
                                                id='pincode-<?php echo $row1["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row1["pincode"]) ? $row1["pincode"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 card p-2">
                                <h4 class="test-center">Present Address</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <lable>Address 1/At</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["address1"]) ? $row2["address1"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["address1"]; ?>'
                                                id='address1-<?php echo $row2["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["address1"]) ? $row2["address1"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>Post</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["post"]) ? $row2["post"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["post"]; ?>'
                                                id='post-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["post"]) ? $row2["post"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>Police Station</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["polic_station"]) ? $row2["polic_station"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["polic_station"]; ?>'
                                                id='polic_station-<?php echo $row2["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["polic_station"]) ? $row2["polic_station"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>City</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["city"]) ? $row2["city"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["city"]; ?>'
                                                id='city-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["city"]) ? $row2["city"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>District</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["dist"]) ? $row2["dist"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["dist"]; ?>'
                                                id='dist-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["dist"]) ? $row2["dist"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>State</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["state"]) ? $row2["state"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["state"]; ?>'
                                                id='state-<?php echo $row2["id"]; ?>-address' style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["state"]) ? $row2["state"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>Country</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["country"]) ? $row2["country"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["country"]; ?>'
                                                id='country-<?php echo $row2["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["country"]) ? $row2["country"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <lable>pincode</lable>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit">
                                                <?php echo !empty($row2["pincode"]) ? $row2["pincode"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class='txtedit' value='<?php echo $row2["pincode"]; ?>'
                                                id='pincode-<?php echo $row2["id"]; ?>-address'
                                                style="display:none;"></input>
                                        <?php } else { ?>
                                            <p class="form-control form-control-line">
                                                <?php echo !empty($row2["pincode"]) ? $row2["pincode"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <th>Action</th>
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
                                                <td><?php echo $row3["result"]; ?>%</td>
                                                <td><?php echo $row3["year"]; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-light"
                                                        onclick="myfcn6(<?php echo $row3['id']; ?>,'<?php echo $row3['edu_type']; ?>','<?php echo $row3['institute']; ?>','<?php echo $row3['university']; ?>','<?php echo $row3['result']; ?>','<?php echo $row3['year']; ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#updateedu"><i
                                                            class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i></button>
                                                </td>
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
                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                            <div class="card m-2">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="m-2">
                                                <select class="form-control form-control-line p-2" name="degreetitle"
                                                    required>
                                                    <option value="">Select Degree Title</option>
                                                    <option value="10th">10th</option>
                                                    <option value="+2">+2</option>
                                                    <option value="+3">+3</option>
                                                    <option value="BBA">BBA</option>
                                                    <option value="BCA">BCA</option>
                                                    <option value="MSC">MSC</option>
                                                    <option value="MCA">MCA</option>
                                                    <option value="MBA">MBA</option>
                                                    <option value="BTECH">BTECH</option>
                                                    <option value="MTECH">MTECH</option>
                                                    <option value="PhD">PhD</option>
                                                    <option value="Diploma">Diploma</option>
                                                </select>
                                            </div>
                                            <div class="m-2">
                                                <input type="text" class="form-control form-control-line" name="university"
                                                    placeholder="University Name" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="m-2">
                                                <input type="text" class="form-control form-control-line" name="institute"
                                                    placeholder="Institute Name" required>
                                            </div>
                                            <div class="row m-2">
                                                <div class="col-6">
                                                    <div class="">
                                                        <input type="text" class="form-control form-control-line P-2"
                                                            name="result"
                                                            oninput="this.value = this.value.replace(/[^0-9%]/g,''); if(this.value.match(/\d+/) && this.value.match(/\d+/)[0].length > 2) this.value = this.value.slice(0, 2);"
                                                            placeholder="Result (%)" maxlength="3" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="">
                                                        <select class="form-select" name="passingyear" required>
                                                            <option value="" selected>Passing Year</option>
                                                            <?php
                                                            $currentYear = date("Y");
                                                            for ($year = 2000; $year <= $currentYear; $year++) {
                                                                echo "<option value=\"$year\">$year</option>";
                                                            }
                                                            ?>
                                                        </select>
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
                        <?php } ?>
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
                    <!-- update modal of education -->
                    <div class="modal fade" id="updateedu" tabindex="-1" aria-labelledby="addDeptLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Education</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <div class="modal-body">
                                        <input type="text" name="id6" id="id6">
                                        <!-- <div class="form-group">
                                            <label for="empid">Emp Id</label>
                                            <input type="text" class="form-control" id="empid22" name="empid">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="degreetitle">Degree Title</label>
                                            <select class="form-control form-control-line p-2"
                                                value="<?php echo $row3['edu_type']; ?>" name="degreetitle"
                                                id="degreetitle22">
                                                <option value="">Select Degree Title</option>
                                                <option value="10th">10th</option>
                                                <option value="+2">+2</option>
                                                <option value="+3">+3</option>
                                                <option value="BBA">BBA</option>
                                                <option value="BCA">BCA</option>
                                                <option value="MSC">MSC</option>
                                                <option value="MCA">MCA</option>
                                                <option value="MBA">MBA</option>
                                                <option value="BTECH">BTECH</option>
                                                <option value="MTECH">MTECH</option>
                                                <option value="PhD">PhD</option>
                                                <option value="Diploma">Diploma</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="institutename">Institute Name</label>
                                            <input type="text" class="form-control" id="institutename22"
                                                name="institutename">
                                        </div>
                                        <div class="form-group">
                                            <label for="universityname">University Name</label>
                                            <input type="text" class="form-control" id="universityname22"
                                                name="universityname">
                                        </div>
                                        <div class="form-group">
                                            <label for="result">Result</label>
                                            <input type="text" class="form-control" id="result22" name="result">
                                        </div>
                                        <div class="form-group">
                                            <label for="passingyear">Passing Year</label>
                                            <div class="">
                                                <select class="form-select" name="passingyear" id="passingyear22"
                                                    required>
                                                    <option value="" selected>Passing Year</option>
                                                    <?php
                                                    $currentYear = date("Y");
                                                    for ($year = 2000; $year <= $currentYear; $year++) {
                                                        echo "<option value=\"$year\">$year</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="updateedu1">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['updateedu1'])) {
                        include "common/conn.php";
                        $degreetitle = $_POST["degreetitle"];
                        $institutename = $_POST["institutename"];
                        $universityname = $_POST["universityname"];
                        $result = $_POST["result"];
                        $passingyear = $_POST["passingyear"];
                        $id = $_POST["id6"];
                        $sql10 = "UPDATE education SET edu_type='$degreetitle', institute='$institutename', university='$universityname', result='$result', year='$passingyear' WHERE id='$id'";
                        if ($conn->query($sql10) === true) {
                            echo " <script>alert('success')</script>";
                        } else {
                            echo $conn->error;
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
                                                <th>Address</th>
                                                <th>Joining Date</th>
                                                <th>Leaving Date</th>
                                                <th>Work Duration</th>
                                                <th>Last Salary Received</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql4 = "SELECT * FROM emp_experience WHERE emp_id='$empId'";
                                            $result4 = $conn->query($sql4);
                                            $slno = 1;
                                            if ($result4->num_rows > 0) {
                                                while ($row4 = $result4->fetch_assoc()) {
                                                    $joining = new DateTime($row4["exp_joining"]);
                                                    $leaving = new DateTime($row4["exp_leaving"]);
                                                    $interval = $leaving->diff($joining);
                                                    $workduration = $interval->y . " years, " . $interval->m . " months, " . $interval->d . " days";
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $slno; ?></td>
                                                        <td><?php echo $row4["exp_company"]; ?></td>
                                                        <td><?php echo $row4["exp_com_position"]; ?></td>
                                                        <td><?php echo $row4["exp_com_address"]; ?></td>
                                                        <td><?php echo $row4["exp_joining"]; ?></td>
                                                        <td><?php echo $row4["exp_leaving"]; ?></td>
                                                        <td><?php echo $workduration ?></td>
                                                        <td><?php echo $row4["salary_received"]; ?></td>
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
                            <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                                            <label>Joining Date</label>
                                            <input type="date" name="joiningdate" id="joiningdate1"
                                                class="form-control form-control-line duty" placeholder="Address"
                                                minlength="7" required>
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Leaving Date</label>
                                            <input type="date" name="leavingdate" id="leavingdate1"
                                                class="form-control form-control-line duty" placeholder="Address"
                                                minlength="7" required>
                                        </div>
                                        <div class="form-group col-md-6 m-t-5">
                                            <label>Last Salary Received</label>
                                            <input type="text" name="lastsalary" id="lastsalary1"
                                                class="form-control form-control-line duty"
                                                placeholder="Last Salary Received" minlength="7" required>
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
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['insertexperience'])) {
                        include "common/conn.php";
                        $companyname = $_POST["company_name"];
                        $positionname = $_POST["position_name"];
                        $address = $_POST["address"];
                        // $workduration = $_POST["work_duration"];
                        $joining = $_POST["joiningdate"];
                        $leaving = $_POST["leavingdate"];
                        $salaryreceived = $_POST["lastsalary"];
                        $sqlexperience = "INSERT INTO emp_experience (exp_company, exp_com_position, exp_com_address, exp_joining, exp_leaving, salary_received, emp_id) VALUES ('$companyname','$positionname','$address', '$joining', '$leaving', '$salaryreceived', '$empId')";
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
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"
                                                onclick="editField('bank_name-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["bank_name"]) ? $row5["bank_name"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class="txtedit"
                                                value="<?php echo !empty($row5["bank_name"]) ? $row5["bank_name"] : ""; ?>"
                                                id="bank_name-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"
                                                onclick="editField('bank_name-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["bank_name"]) ? $row5["bank_name"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Holder Name</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"
                                                onclick="editField('holder_name-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["holder_name"]) ? $row5["holder_name"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class="txtedit"
                                                value="<?php echo !empty($row5["holder_name"]) ? $row5["holder_name"] : ""; ?>"
                                                id="holder_name-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"
                                                onclick="editField('holder_name-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["holder_name"]) ? $row5["holder_name"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Branch Name</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"
                                                onclick="editField('branch_name-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["branch_name"]) ? $row5["branch_name"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class="txtedit"
                                                value="<?php echo !empty($row5["branch_name"]) ? $row5["branch_name"] : ""; ?>"
                                                id="branch_name-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"
                                                onclick="editField('branch_name-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["branch_name"]) ? $row5["branch_name"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Number</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"
                                                onclick="editField('account_number-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["account_number"]) ? $row5["account_number"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class="txtedit"
                                                value="<?php echo !empty($row5["account_number"]) ? $row5["account_number"] : ""; ?>"
                                                id="account_number-<?php echo $row5["id"]; ?>-bank_info"
                                                style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"
                                                onclick="editField('account_number-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["account_number"]) ? $row5["account_number"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>IFSC Code</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"
                                                onclick="editField('ifsc_code-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["ifsc_code"]) ? $row5["ifsc_code"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class="txtedit"
                                                value="<?php echo !empty($row5["ifsc_code"]) ? $row5["ifsc_code"] : ""; ?>"
                                                id="ifsc_code-<?php echo $row5["id"]; ?>-bank_info" style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"
                                                onclick="editField('ifsc_code-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["ifsc_code"]) ? $row5["ifsc_code"] : "N/A"; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Type</label>
                                        <?php if ($em_role == '1' || $em_role == '3') { ?>
                                            <p class="form-control form-control-line edit"
                                                onclick="editField('account_type-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["account_type"]) ? $row5["account_type"] : "N/A"; ?>
                                            </p>
                                            <input type="text" class="txtedit"
                                                value="<?php echo !empty($row5["account_type"]) ? $row5["account_type"] : ""; ?>"
                                                id="account_type-<?php echo $row5["id"]; ?>-bank_info"
                                                style="display:none;">
                                        <?php } else { ?>
                                            <p class="form-control form-control-line"
                                                onclick="editField('account_type-<?php echo $row5['id']; ?>-bank_info')">
                                                <?php echo !empty($row5["account_type"]) ? $row5["account_type"] : "N/A"; ?>
                                            <?php } ?>
                                        </p>
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
                                                <td>Files</td>
                                                <td>Action</td>
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
                                                        <td>
                                                            <button type="button" class="btn btn-light"
                                                                onclick="myfcn8(<?php echo $row6['id']; ?>,'<?php echo $row6['file_title']; ?>')"
                                                                data-bs-toggle="modal" data-bs-target="#updatedocument"><i
                                                                    class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i></button>
                                                        </td>
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
                            <?php if ($em_role == '1' || $em_role == '3') { ?>
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
                            <?php } ?>
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
                                <div class="table-responsive ">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td class="fw-bold">Sl. no</td>
                                                <td class="fw-bold">Month-Year</td>
                                                <td class="text-success fw-bold">Basic</td>
                                                <td class="text-success fw-bold">House Rent</td>
                                                <td class="text-success fw-bold">Medical</td>
                                                <td class="text-success fw-bold">Conveyance</td>
                                                <td class="text-success fw-bold">Performance Bonus</td>
                                                <td class="text-danger fw-bold">Insurance</td>
                                                <td class="text-danger fw-bold">Provident Fund</td>
                                                <td class="text-danger fw-bold">Tax</td>
                                                <td class="text-danger fw-bold">Loans</td>
                                                <td class="text-danger fw-bold">Others</td>
                                                <td class="text-primary fw-bold">Salary Paid</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql11 = "SELECT * FROM pay_salary ";
                                            // $sql11 = "SELECT * FROM pay_salary WHERE em_id='$empId'";
                                            $result11 = $conn->query($sql11);
                                            $slno = 1;
                                            if ($result11->num_rows > 0) {
                                                // output data of each row
                                                while ($row11 = $result11->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $slno; ?></td>
                                                        <td><?php echo $row11["month"] . '/' . $row11["year"]; ?></td>
                                                        <td><?php echo $row11["basic"]; ?></td>
                                                        <td><?php echo $row11["house_rent"]; ?></td>
                                                        <td><?php echo $row11["medical"]; ?></td>
                                                        <td><?php echo $row11["transporting"]; ?></td>
                                                        <td><?php echo $row11["bonus"]; ?></td>
                                                        <td><?php echo $row11["bima"]; ?></td>
                                                        <td><?php echo $row11["provident_fund"]; ?></td>
                                                        <td><?php echo $row11["tax"]; ?></td>
                                                        <td><?php echo $row11["loan"]; ?></td>
                                                        <td><?php echo $row11["other_diduction"]; ?></td>
                                                        <td><?php
                                                        $earn = $row11["basic"] + $row11["house_rent"] + $row11["medical"] + $row11["transporting"] + $row11["bonus"];
                                                        $dedect = $earn - $row11["bima"] - $row11["provident_fund"] - $row11["tax"] - $row11["loan"] - $row11["other_diduction"];

                                                        echo $dedect;
                                                        ?></td>
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
                        </div>
                    </div>
                    <div id="Earnings" class="tabcontent">
                        <div class="card p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                    data-bs-target="#addpayroll">
                                    <i class="fa-solid fa-plus"></i>Earnings
                                </button>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>
                                        <th class="text-center">Basic</th>
                                        <th class="text-center">House Rent</th>
                                        <th class="text-center">Medical</th>
                                        <th class="text-center">Conveyance</th>
                                        <th class="text-center">Performance Bonus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql_payroll = "SELECT * FROM earnings ORDER BY id DESC";
                                    $result = $conn->query($sql_payroll);
                                    if ($result->num_rows > 0) {
                                        $slno = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $slno; ?></th>
                                                <td class="text-center"><?php echo $row["basic"]; ?></td>
                                                <td class="text-center"><?php echo $row["house_rent"]; ?></td>
                                                <td class="text-center"><?php echo $row["medical"]; ?></td>
                                                <td class="text-center"><?php echo $row["travel"]; ?></td>
                                                <td class="text-center"><?php echo $row["perform_bonus"]; ?></td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>0 results</td></tr>";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="Password" class="tabcontent">
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

    <!-- payroll modal -->
    <div class="modal fade" id="addpayroll" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Earnings</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="notes_file_form">
                    <input type="hidden" class="form-control" name="project_name" value="<?php echo $proId; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="basic1" class="form-label">Basic</label>
                                    <input type="text" class="form-control" id="basic1" name="basic"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity(); calculateGrossEarnings()"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="houserent1" class="form-label">House Rent</label>
                                    <input type="text" class="form-control" id="houserent1" name="houserent"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity(); calculateGrossEarnings()"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="medical1" class="form-label">Medical</label>
                                    <input type="text" class="form-control" id="medical1" name="medical"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity(); calculateGrossEarnings()"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="travel1" class="form-label">Travel</label>
                                    <input type="text" class="form-control" id="travel1" name="travel"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity(); calculateGrossEarnings()"
                                        required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="performancebonus1" class="form-label">Performance Bonus</label>
                                    <input type="text" class="form-control" id="performancebonus1"
                                        name="performancebonus"
                                        oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15); this.value = this.value.replace(/[^0-9]/g, ''); this.setCustomValidity(''); this.checkValidity(); calculateGrossEarnings()"
                                        required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="grossearnings" class="form-label">Gross Earnings</label>
                                    <input type="text" class="form-control" id="grossearnings" name="grossearnings"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_earn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['add_earn'])) {
        include "common/conn.php";
        $basic = $_POST["basic"];
        $houserent = $_POST["houserent"];
        $medical = $_POST["medical"];
        $travel = $_POST["travel"];
        $performancebonus = $_POST["performancebonus"];
        $sqlearn = "INSERT INTO earnings (emp_id, basic, house_rent, medical, travel, perform_bonus) VALUES ('$empId','$basic','$houserent','$medical', '$travel','$performancebonus')";
        if ($conn->query($sqlearn) === true) {
            $last_id = $conn->insert_id;

            $sqlearn1 = "UPDATE earnings SET status='0' WHERE emp_id = '$empId'";
            if ($conn->query($sqlearn1) === true) {

                $sqlearn2 = "UPDATE earnings SET status='1' WHERE id = '$last_id'";
                if ($conn->query($sqlearn2) === true) {
                    echo "<script>alert('Form submitted successfully');</script>";
                } else {
                    $conn->error;
                }

            } else {
                $conn->error;
            }


        } else {
            $conn->error;
        }
        $conn->close();
    }
    ?>
    <script>
        function calculateGrossEarnings() {
            // Get values from all the input fields
            let basic = parseFloat(document.getElementById('basic1').value) || 0;
            let houserent = parseFloat(document.getElementById('houserent1').value) || 0;
            let medical = parseFloat(document.getElementById('medical1').value) || 0;
            let travel = parseFloat(document.getElementById('travel1').value) || 0;
            let performancebonus = parseFloat(document.getElementById('performancebonus1').value) || 0;

            // Calculate the total gross earnings
            let grossEarnings = basic + houserent + medical + travel + performancebonus;

            // Set the result in the Gross Earnings field
            document.getElementById('grossearnings').value = grossEarnings.toFixed(2);
        }
    </script>
    <!-- modal for emp id -->
    <div class="modal fade" id="exampleModalcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Empid</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="myform" action="<?php $_SERVER['PHP_SELF']; ?>" method='post'
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputfile"></label>
                                <input type="hidden" value="<?php echo $row["em_code"]; ?>" name="id10" id="id10">
                                <div class="form-group">
                                    <label for="filename">Emp Id</label>
                                    <input type="text" value="<?php echo $row["em_code"]; ?>" class="form-control"
                                        id="empidd" name="empid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updateempid" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['updateempid'])) {
        include "common/conn.php";
        $id = $_POST["id10"];
        $empid = $_POST["empid"];

        // Check if the new emp_code already exists
        $sql10 = "SELECT * FROM employee WHERE em_code='$empid'";
        $result = $conn->query($sql10);

        if ($result->num_rows > 0) {
            echo "<script>alert('Employee code already exists');</script>";
        } else {
            $sql11 = "UPDATE employee SET em_code='$empid' WHERE em_code='$id'";
            if ($conn->query($sql11) === true) {

                $sql12 = "UPDATE address SET emp_id='$empid' WHERE emp_id='$id'";
                if ($conn->query($sql12) === true) {

                    $sql13 = "UPDATE education SET emp_id='$empid' WHERE emp_id='$id'";
                    if ($conn->query($sql13) === true) {

                        $sql14 = "UPDATE emp_experience SET emp_id='$empid' WHERE emp_id='$id'";
                        if ($conn->query($sql14) === true) {

                            $sql15 = "UPDATE bank_info SET em_id='$empid' WHERE em_id='$id'";
                            if ($conn->query($sql15) === true) {

                                $sql16 = "UPDATE employee_file SET em_id='$empid' WHERE em_id='$id'";
                                if ($conn->query($sql16) === true) {
                                    echo "<script>alert('Update successful');</script>";
                                } else {
                                    echo "<script>alert('Error updating employee_file: " . $conn->error . "');</script>";
                                }
                            } else {
                                echo "<script>alert('Error updating bank_info: " . $conn->error . "');</script>";
                            }
                        } else {
                            echo "<script>alert('Error updating emp_experience: " . $conn->error . "');</script>";
                        }
                    } else {
                        echo "<script>alert('Error updating education: " . $conn->error . "');</script>";
                    }
                } else {
                    echo "<script>alert('Error updating address: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Error updating employee: " . $conn->error . "');</script>";
            }
        }
        $conn->close();
    }
    ?>
    <!-- modal for change image -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="myform" action="<?php $_SERVER['PHP_SELF']; ?>" method='post'
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputfile"></label>
                                <input type="hidden" value="<?php echo $row["id"]; ?>" name="id7" id="id7">

                                <!-- File input for selecting image -->
                                <div class="d-flex align-items-center">
                                    <input type="file" class="form-control" id="exampleInputfile"
                                        placeholder="Recruiter's image" name="image" accept="image/*"
                                        onchange="previewImage(event)">

                                    <!-- Button to capture photo using camera -->
                                    <button type="button" class="btn btn-primary ms-2" onclick="startCamera()">Camera
                                    </button>
                                </div>
                                <!-- Image preview -->
                                <br>
                                <img id="image45" src="assets/img/noimage1.png" alt="New image" width="50"
                                    height="50" />

                                <!-- Hidden canvas element to capture and upload the image from the camera -->
                                <canvas id="canvas" style="display:none;"></canvas>

                                <!-- Video element to display live camera feed -->
                                <video id="video" width="320" height="240" autoplay style="display:none;"></video>
                                <button type="button" id="captureBtn" class="btn btn-success mt-2" style="display:none;"
                                    onclick="capturePhoto()">Take Photo</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update3" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['update3'])) {
        include "common/conn.php";

        $id = $_POST["id7"];
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];
        $file_type = pathinfo($image_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_type;

        $upload_dir = "assets/uploads/employee";

        // Check if the directory exists, and create it if not
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $target_file = $upload_dir . '/' . $new_file_name;

        // Check for file upload errors
        if ($image_error === 0) {
            if (move_uploaded_file($image_tmp, $target_file)) {
                echo "<script>alert('Image uploaded successfully');</script>";
            } else {
                echo "<script>alert('Image not uploaded');</script>";
            }

            // Update the database with the new image path
            $sql34 = "UPDATE employee SET em_image='assets/uploads/employee/$new_file_name' WHERE id='$id'";
            if ($conn->query($sql34) === true) {
                echo "<script>window.location.href='employeeDetail.php';</script>";
            } else {
                echo "<script>alert('Database update failed: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error during image upload');</script>";
        }

        $conn->close();
    }
    ?>
    <!-- update pdf -->
    <div class="modal fade" id="updatedocument" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Update Document</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id8" id="id8">
                        <div class="form-group">
                            <label for="filename">File Name</label>
                            <input type="text" class="form-control" id="filename11" name="filename" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="exampleInputtext">Upload File:
                                <span class="required"></span>
                            </label>
                            <input type="file" class="form-control" placeholder="pdf" name="file_url"
                                accept=".pdf,.docx,.doc" onchange="checkFileType(this)">
                            <span id="fileName"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updatedocument1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['updatedocument1'])) {
        include "common/conn.php";
        // Sanitize inputs
        $id = $conn->real_escape_string($_POST["id8"]);
        $name = $conn->real_escape_string($_POST["filename"]);

        // File handling - PDF/DOCX/DOC
        $allowed_file_types = ['pdf', 'docx', 'doc']; // Allowed file types
        $pdf_name = $_FILES['file_url']['name'];
        $pdf_tmp = $_FILES['file_url']['tmp_name'];
        $pdf_size = $_FILES['file_url']['size'];
        $pdf_type = strtolower(pathinfo($pdf_name, PATHINFO_EXTENSION));

        $new_pdf_name = null; // Initialize variable for new file name
        $upload_dir = "assets/uploads/employee/"; // Set upload directory
    
        // Check if a file is uploaded
        if (!empty($pdf_name)) {
            // Validate file type
            if (in_array($pdf_type, $allowed_file_types)) {
                // Validate file size (e.g., max 5MB)
                if ($pdf_size <= 5000000) {
                    // Generate a unique name for the uploaded file
                    $new_pdf_name = uniqid() . '.' . $pdf_type;

                    // Create directory if it doesn't exist
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true); // Ensure directory is writable
                    }

                    $target_pdf_file = $upload_dir . $new_pdf_name;

                    // Move uploaded file to the upload directory
                    if (move_uploaded_file($pdf_tmp, $target_pdf_file)) {
                        // File uploaded successfully
                    } else {
                        // Error in uploading file
                        echo "<script>alert('File upload failed');</script>";
                    }
                } else {
                    echo "<script>alert('File size exceeds the limit of 5MB');</script>";
                }
            } else {
                echo "<script>alert('Invalid file type. Only PDF, DOC, and DOCX files are allowed.');</script>";
            }
        }

        // Prepare SQL update query
        if (!empty($new_pdf_name)) {
            // If a new file is uploaded, update both name and file fields
            $sql = "UPDATE employee_file SET file_title='$name', file_url='$new_pdf_name' WHERE id='$id'";
        } else {
            // If no new file is uploaded, update only the name field
            $sql = "UPDATE employee_file SET file_title='$name' WHERE id='$id'";
        }

        // Execute SQL query
        if ($conn->query($sql) === true) {
            // Success message with redirect after 1 second
            echo "<script>
            $(document).ready(function(){
                toastr.success('Document updated successfully');
                setTimeout(function(){
                    window.location.href = 'employeeDetail.php';
                }, 1000); // 1000 milliseconds = 1 second
            });
        </script>";
        } else {
            // Error message if SQL query fails
            echo "Error updating record: " . $conn->error;
        }

        // Close database connection
        $conn->close();
    }
    ?>

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
    <!-- for capture photo -->
    <script>
        // Variables for video and canvas elements
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        // Function to start the camera and show video feed
        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    // Display the video stream from the camera
                    video.style.display = 'block';
                    captureBtn.style.display = 'inline-block';
                    video.srcObject = stream;
                })
                .catch(function (error) {
                    console.log("Something went wrong with accessing the camera: " + error);
                });
        }

        // Function to capture the photo from the video stream
        function capturePhoto() {
            const context = canvas.getContext('2d');
            // Set the canvas width and height to match the video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw the current frame from the video onto the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Get the image data from the canvas
            const dataUrl = canvas.toDataURL('image/png');

            // Set the image preview to the captured photo
            document.getElementById('image45').src = dataUrl;

            // Convert data URL to Blob and attach it to the file input for form submission
            canvas.toBlob(function (blob) {
                const fileInput = document.getElementById('exampleInputfile');
                const file = new File([blob], "captured-photo.png", { type: "image/png" });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
            });

            // Hide the video and capture button after taking the photo
            video.style.display = 'none';
            captureBtn.style.display = 'none';
        }

        // Function to preview image when selected via file input
        function previewImage(event) {
            const image = document.getElementById('image45');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time();?>" rel="stylesheet" />
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
            $empId = '123456';

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
                        <button class="tablinks" onclick="openDilog(event, 'Social')">Social Media</button>
                        <button class="tablinks" onclick="openDilog(event, 'Password')"> Change Password</button>
                    </div>
                    <div id="PersonalInfo" class="tabcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <!-- <center class="m-t-30"> -->
                                        <img src="assets/uploads/employee/6614b390d974e.jpg" class="img-circle"
                                            width="150">
                                        <h4 class="card-title m-t-10"><?php echo $row["full_name"]; ?></h4>
                                        <h6 class="card-subtitle">Employee Id: <?php echo $row["em_code"]; ?></h6>
                                        <!-- </center> -->
                                    </div>
                                    <div>
                                        <hr>
                                    </div>
                                    <div class="card-body"> <small class="text-muted">Email address </small>
                                        <h6><?php echo $row["em_email"]; ?></h6> <small
                                            class="text-muted p-t-30 db">Phone</small>
                                        <h6><?php echo $row["em_phone"]; ?></h6>
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
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Blood Group </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_blood_group"]; ?>
                                        </p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Gender </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_gender"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>User Type </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_role"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Status </label>
                                        <p class="form-control form-control-line"><?php echo $row["status"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Date Of Birth </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_birthday"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Whatsapp Number </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_wahtsapp"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Department</label>
                                        <p class="form-control form-control-line"><?php echo $row["dep_id"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Designation </label>
                                        <p class="form-control form-control-line"><?php echo $row["des_id"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Date Of Joining </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_joining_date"]; ?>
                                        </p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Contract End Date</label>
                                        <p class="form-control form-control-line"><?php echo $row["em_contact_end"]; ?>
                                        </p>
                                    </div>
                                    <!-- <div class="form-group col-md-4 m-t-10">
                                        <label>Email </label>
                                        <p class="form-control form-control-line">email@mail.com</p>
                                    </div> -->
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Aadher Number </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_aadher"]; ?></p>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label>PAN Number </label>
                                        <p class="form-control form-control-line"><?php echo $row["em_pan"]; ?></p>
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
                                <h4 class="test-center">Present Address</h4>
                                <p class="form-control form-control-line"><?php echo $row1["address1"]; ?></p>
                                <p class="form-control form-control-line"><?php echo $row1["address2"]; ?></p>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["city"]; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["state"]; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["country"]; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["pincode"]; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 card p-2">
                                <h4 class="test-center">Present Address</h4>
                                <p class="form-control form-control-line"><?php echo $row1["address1"]; ?></p>
                                <p class="form-control form-control-line"><?php echo $row1["address2"]; ?></p>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["city"]; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["state"]; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["country"]; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="form-control form-control-line"><?php echo $row1["pincode"]; ?></p>
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
                                        <th>Result</th>
                                        <th>Passing Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql3 = "SELECT * FROM education WHERE emp_id='$empId'";
                                    $result3 = $conn->query($sql3);                                    
                                    if ($result3->num_rows > 0) {
                                      while($row3 = $result3->fetch_assoc()) {?>
                                    <tr>
                                        <th><?php echo $row3["edu_type"]; ?></th>
                                        <th><?php echo $row3["edu_type"]; ?></th>
                                        <th><?php echo $row3["institute"]; ?></th>
                                        <th><?php echo $row3["result"]; ?></th>
                                        <th><?php echo $row3["year"]; ?></th>
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
                        <div class="card m-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="m-2">
                                        <input type="text" class="form-control form-control-line P-2"
                                            placeholder="Degree Title">
                                    </div>
                                    <div class="m-2">
                                        <input type="text" class="form-control form-control-line  P-2"
                                            placeholder="Result">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="m-2">
                                        <input type="text" class="form-control form-control-line "
                                            placeholder="Institute Name">
                                    </div>
                                    <div class="m-2">
                                        <input type="text" class="form-control form-control-line "
                                            placeholder="Passing Year">
                                    </div>
                                </div>
                                <div class="col-12 m-3">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                        Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Experience" class="tabcontent p-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID </th>
                                                <th>Company name</th>
                                                <th>Position </th>
                                                <th>Work Duration </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                    $sql4 = "SELECT * FROM emp_experience WHERE emp_id='$empId'";
                                    $result4 = $conn->query($sql4);
                                    
                                    if ($result4->num_rows > 0) {
                                      // output data of each row
                                      while($row4 = $result4->fetch_assoc()) {?>

                                            <tr>
                                                <th><?php echo $row4["exp_company"]; ?></th>
                                                <th><?php echo $row4["exp_company"]; ?></th>
                                                <th><?php echo $row4["exp_com_position"]; ?></th>
                                                <th><?php echo $row4["exp_com_address"]; ?></th>
                                                <th><?php echo $row4["exp_workduration"]; ?></th>
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
                            </div>
                        </div>
                    </div>
                    <div id="Bank" class="tabcontent">
                        <div class="card">
                            <div class="card-body">
                                <form class="row" action="Add_bank_info" method="post" enctype="multipart/form-data"
                                    novalidate="novalidate">
                                    <div class="form-group col-md-6 m-t-5">
                                        <label> Bank Holder Name</label>
                                        <p class="form-control form-control-line"><?php echo $row5["holder_name"]; ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Name</label>
                                        <p class="form-control form-control-line"><?php echo $row5["bank_name"]; ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Branch Name</label>
                                        <p class="form-control form-control-line"><?php echo $row5["branch_name"]; ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Number</label>
                                        <p class="form-control form-control-line"><?php echo $row5["account_number"]; ?>
                                    </div>
                                    <div class="form-group col-md-6 m-t-5">
                                        <label>Bank Account Type</label>
                                        <p class="form-control form-control-line"><?php echo $row5["account_type"]; ?>
                                    </div>
                                    <!-- <div class="form-actions col-md-12">
                                        <input type="hidden" name="emid" value="Soy1332">
                                        <input type="hidden" name="id" value="3">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                            Save</button>
                                    </div> -->
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
                                                <th>ID </th>
                                                <th>File Type</th>
                                                <th>Files </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    $sql6 = "SELECT * FROM employee_file WHERE em_id='$empId'";
                                    $result6 = $conn->query($sql6);
                                    
                                    if ($result6->num_rows > 0) {
                                      // output data of each row
                                      while($row6 = $result6->fetch_assoc()) {?>                                    
                                
                                    <tr>
                                        <th><?php echo $row6["file_title"]; ?></th>
                                        <th><?php echo $row6["file_title"]; ?></th>
                                        <th><?php echo $row6["file_url"]; ?></th>
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
                            </div>
                        </div>
                    </div>
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
            while($row4 = $result4->fetch_assoc()) {
                // Calculate taken leave
                $leaveType = $row4["name"];
                $sqlTakenLeave = "SELECT COUNT(*) AS taken_leave FROM emp_leave WHERE leave_type = '$leaveType' AND em_id='$empId'";
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
                    <div id="Social" class="tabcontent">
                        <h3>Tokyo</h3>
                        <p>Tokyo is the capital of Japan.</p>
                    </div>
                    <div id="Password" class="tabcontent">
                        <h3>Tokyo</h3>
                        <p>Tokyo is the capital of Japan.</p>
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
</body>

</html>
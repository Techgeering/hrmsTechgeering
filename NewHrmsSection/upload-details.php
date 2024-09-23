<?php
session_start();
include 'conn.php';
$mobileno = $_SESSION['emp_form_phone'];
if ($mobileno === NULL) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>Employee Details</title>
</head>

<body>

    <section>
        <div class="container">
            <h4 class="text-center">Add Employee Details</h4>
            <nav class="p-3">
                <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-personal-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-personal" type="button" role="tab" aria-controls="nav-personal"
                        aria-selected="true">Personal Info</button>
                    <button class="nav-link" id="nav-address-tab" data-bs-toggle="tab" data-bs-target="#nav-address"
                        type="button" role="tab" aria-controls="nav-address" aria-selected="false"
                        disabled>Address</button>

                    <button class="nav-link" id="nav-education-tab" data-bs-toggle="tab" data-bs-target="#nav-education"
                        type="button" role="tab" aria-controls="nav-education" aria-selected="false"
                        disabled>Education</button>

                    <button class="nav-link" id="nav-experience-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-experience" type="button" role="tab" aria-controls="nav-experience"
                        aria-selected="false" disabled>Experience</button>

                    <button class="nav-link" id="nav-document-tab" data-bs-toggle="tab" data-bs-target="#nav-document"
                        type="button" role="tab" aria-controls="nav-document" aria-selected="false">Document</button>
                </div>
            </nav>
            <div class="tab-content p-4" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-personal" role="tabpanel"
                    aria-labelledby="nav-personal-tab" tabindex="0">
                    <section class="container">
                        <form id="personal-info-form" method="post">
                            <div class="row">
                                <!-- Right Column: Profile Box -->
                                <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center">
                                    <div class="profile-box text-center">
                                        <!-- Start of Form -->
                                        <!-- <form id="profile-form" action="your-action-url" method="post"
                                        enctype="multipart/form-data"> -->
                                        <!-- Profile Image -->
                                        <img id="profile-image" src="https://via.placeholder.com/100"
                                            alt="Profile Picture" class="img-fluid mb-3">
                                        <!-- <input type="file" id="profile-image" name="capture_photo" class="form-control"
                                            accept="image/*"> -->
                                        <p id="image-name" class="mt-2">No image captured yet</p>
                                        <!-- Camera Control -->
                                        <video id="video" style="display: none;"></video>
                                        <button class="btn btn-primary start-btn" type="button"
                                            onclick="startCamera()">Start Camera</button>
                                        <canvas id="canvas" style="display: none;"></canvas>
                                        <button id="capture" class="btn btn-secondary capture-btn" type="button"
                                            style="display: none;" onclick="capturePhoto()">Capture</button>


                                        <input type="hidden" id="captured-photo" name="capture_photo">

                                        <!-- Upload Photo Section -->
                                        <div class="upload-photo-container mt-3">
                                            <img id="uploaded-image" class="mb-3" src="" alt="Uploaded Image"
                                                style="display: none;">
                                            <input type="file" id="upload-photo" name="profile-photo"
                                                class="form-control" accept="image/*" onchange="uploadPhoto()">
                                            <p id="upload-image-name" class="mt-2">No image uploaded yet</p>
                                        </div>
                                        <?php
                                        include "conn.php";
                                        $sql = "SELECT * FROM emp_form";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <!-- User Details -->
                                                <h5><?php echo $row["emp_form_name"] ?></h5>
                                                <p><strong>Email:</strong> <?php echo $row["emp_form_email"] ?></p>
                                                <p><strong>Phone:</strong> <?php echo $row["emp_form_phone"] ?></p>
                                            <?php }
                                        } ?>
                                        <!-- Submit Form Button -->
                                        <!-- <button type="submit" class="btn btn-success mt-3">Submit</button> -->
                                        <!-- </form> -->
                                        <!-- End of Form -->
                                    </div>
                                </div>
                                <!-- Left Column: Form -->
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="fatherName" class="form-label">Father's Name</label>
                                                <input type="text" class="form-control" name="fathername"
                                                    id="fatherName" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="motherName" class="form-label">Mother's Name</label>
                                                <input type="text" class="form-control" name="mothername"
                                                    id="motherName" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="bloodgroup" class="form-label">Blood Group</label>
                                                <select class="form-select" name="bloodgrp" id="bloodgroup" required>
                                                    <option value="" selected>Select Blood Group</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select class="form-select" name="genderr" id="gender" required>
                                                    <option value="" selected>Select gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="maritalStatus" class="form-label">Marital Status</label>
                                                <select class="form-select" name="maritalstatus" id="maritalStatus"
                                                    required>
                                                    <option value="" selected>Select marital status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="whatsappNumber" class="form-label">Whatsapp Number</label>
                                                <input type="text" class="form-control" maxlength="10" name="wpnumber"
                                                    id="whatsappNumber" required inputmode="numeric">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="aadharNumber" class="form-label">Aadhaar Number</label>
                                                <input type="text" class="form-control" maxlength="12"
                                                    name="adharnumber" id="aadharNumber" required inputmode="numeric">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="panNumber" class="form-label">PAN Number</label>
                                                <input type="text" class="form-control" maxlength="10" name="pannumber"
                                                    id="panNumber" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="emergencyContact" class="form-label">Emergency
                                                    Contact Number</label>
                                                <input type="text" class="form-control" maxlength="10"
                                                    name="emergencynumber" id="emergencyContact" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="emergencyRelation" class="form-label">Emergency Contact
                                                    Relation</label>
                                                <input type="text" class="form-control" name="emergencyrelation"
                                                    id="emergencyRelation" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Save & Next Button -->
                                    <button type="submit" name="submit" class="btn btn-primary float-end"
                                        id="save-next-btn">Save &
                                        Next</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab"
                    tabindex="0">
                    <section class="container">
                        <form id="permanent-address-form" method="post">
                            <div class="row">
                                <!-- Permanent Address Column -->
                                <div class="col-lg-6 bord">
                                    <h5>Permanent Address</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="perm-address" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="p_address"
                                                    id="perm-address" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="perm-city" class="form-label">City/Village</label>
                                                <input type="text" class="form-control" name="pcity" id="perm-city"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="perm-district" class="form-label">District</label>
                                                <input type="text" class="form-control" name="pdist" id="perm-district"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="prem-state" class="form-label">State</label>
                                                <select class="form-control" name="pstate" id="perm-state" required>
                                                    <option value="" disabled selected>Select a state</option>
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="perm-country" class="form-label">Country</label>
                                                <input type="text" class="form-control" value="India" name="pcountry"
                                                    id="perm-country" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="perm-pin" class="form-label">PIN</label>
                                                <input type="text" class="form-control" maxlength="6" name="p_pin"
                                                    id="perm-pin" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="perm-post" class="form-label">Post</label>
                                                <input type="text" class="form-control" name="p_post" id="perm-post"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="perm-police-station" class="form-label">Police
                                                    Station</label>
                                                <input type="text" class="form-control" name="p_police"
                                                    id="perm-police-station" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Present Address Column -->
                                <div class="col-lg-6">
                                    <h5>Present Address</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-address" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="preaddrs"
                                                    id="pres-address" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-city" class="form-label">City/Village</label>
                                                <input type="text" class="form-control" name="precity" id="pres-city"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-district" class="form-label">District</label>
                                                <input type="text" class="form-control" name="predist"
                                                    id="pres-district" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-state" class="form-label">State</label>
                                                <select class="form-control" name="prestate" id="pres-state" required>
                                                    <option value="" disabled selected>Select a state</option>
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-country" class="form-label">Country</label>
                                                <input type="text" class="form-control" value="India" name="precountry"
                                                    id="pres-country" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-pin" class="form-label">PIN</label>
                                                <input type="text" class="form-control" maxlength="6" name="prepin"
                                                    id="pres-pin" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-post" class="form-label">Post</label>
                                                <input type="text" class="form-control" name="prepost" id="pres-post"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="pres-police-station" class="form-label">Police
                                                    Station</label>
                                                <input type="text" class="form-control" name="prepolice"
                                                    id="pres-police-station" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="copy-address">
                                        <label class="form-check-label" for="copy-address">
                                            Same as Permanent Address
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Save & Next Button -->
                        <button type="submit" name="submit_add" class="btn btn-primary float-end"
                            id="save-next-btns">Save &
                            Next</button>

                    </section>
                </div>
                <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab"
                    tabindex="0">
                    <section class="container">
                        <h5 class="text-center mb-4">Educational Background</h5>
                        <form id="education-form" method="post">
                            <div class="row">
                                <!-- PG Section -->
                                <div class="col-md-12 col-lg-6 col-sm-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title text-center fw-bold ">Post Graduation</h4>
                                            <!-- <form id="pg-form"> -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-stream" class="form-label">Course Title</label>
                                                        <select class="form-control" name="pgcourse" id="pg-course">
                                                            <option value="" disabled selected>Select Course</option>
                                                            <option value="mca">MCA</option>
                                                            <option value="mba">MBA</option>
                                                            <option value="msc">MSC</option>
                                                            <option value="mtech">M.TECH</option>
                                                            <option value="mphil">M.PHIL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-stream" class="form-label">Stream</label>
                                                        <input type="text" class="form-control" name="pgstream"
                                                            id="pg-stream">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-year" class="form-label">Year of Pass</label>
                                                        <input type="number" class="form-control" name="pgyear"
                                                            id="pg-year">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-results" class="form-label">Results in
                                                            (%)</label>
                                                        <input type="number" class="form-control" name="pgresult"
                                                            id="pg-results" step="0.01">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-university" class="form-label">University
                                                            Name</label>
                                                        <input type="text" class="form-control" name="pguniversity"
                                                            id="pg-university">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-institute" class="form-label">Institute
                                                            Name</label>
                                                        <input type="text" class="form-control" name="pginstitute"
                                                            id="pg-institute">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label for="pg-location" class="form-label">Institute
                                                            Location</label>
                                                        <input type="text" class="form-control" name="pglocation"
                                                            id="pg-location">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </form> -->

                                        </div>
                                    </div>
                                </div>

                                <!-- Graduation Section -->
                                <div class="col-md-12 col-lg-6 col-sm-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title text-center fw-bold ">Graduation</h4>
                                            <!-- <form id="grad-form"> -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-stream" class="form-label">Course Title</label>
                                                        <select class="form-control" name="gra_course" id="pg-stream"
                                                            required>
                                                            <option value="" disabled selected>Select Course</option>
                                                            <option value="bsc">BSC</option>
                                                            <option value="bba">BBA</option>
                                                            <option value="bca">BCA</option>
                                                            <option value="btech">BTECH</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="grad-stream" class="form-label">Stream</label>
                                                        <input type="text" class="form-control" name="gra_stream"
                                                            id="grad-stream" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="grad-year" class="form-label">Year of Pass</label>
                                                        <input type="number" class="form-control" name="gra_year"
                                                            id="grad-year" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="grad-results" class="form-label">Results in
                                                            (%)</label>
                                                        <input type="number" class="form-control" name="gra_result"
                                                            id="grad-results" step="0.01" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="grad-university" class="form-label">University
                                                            Name</label>
                                                        <input type="text" class="form-control" name="gra_university"
                                                            id="grad-university" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="grad-institute" class="form-label">Institute
                                                            Name</label>
                                                        <input type="text" class="form-control" name="gra_institude"
                                                            id="grad-institute" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label for="grad-location" class="form-label">Institute
                                                            Location</label>
                                                        <input type="text" class="form-control" name="gra_location"
                                                            id="grad-location" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </form> -->

                                        </div>
                                    </div>
                                </div>

                                <!-- Diploma/+2 Section -->
                                <div class="col-md-12 col-lg-6 col-sm-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title text-center fw-bold ">Diploma / +2</h4>
                                            <!-- <form id="diploma-form"> -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="pg-stream" class="form-label">Course Title</label>
                                                        <select class="form-control" name="dip_course" id="pg-stream"
                                                            required>
                                                            <option value="" disabled selected>Select Course</option>
                                                            <option value="diploma">DIPLOMA</option>
                                                            <option value="+2">+2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="diploma-stream" class="form-label">Stream</label>
                                                        <input type="text" class="form-control" name="dip_stream"
                                                            id="diploma-stream" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="diploma-year" class="form-label">Year of
                                                            Pass</label>
                                                        <input type="number" class="form-control" name="dip_year"
                                                            id="diploma-year" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="diploma-results" class="form-label">Results in
                                                            (%)</label>
                                                        <input type="number" class="form-control" name="dip_result"
                                                            id="diploma-results" step="0.01" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="diploma-university" class="form-label">Board
                                                            Name</label>
                                                        <input type="text" class="form-control" name="dip_board"
                                                            id="diploma-university" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="diploma-institute" class="form-label">Institute
                                                            Name</label>
                                                        <input type="text" class="form-control" name="dip_institute"
                                                            id="diploma-institute" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label for="diploma-location" class="form-label">Institute
                                                            Location</label>
                                                        <input type="text" class="form-control" name="dip_location"
                                                            id="diploma-location" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </form> -->

                                        </div>
                                    </div>
                                </div>

                                <!-- 10th Section -->
                                <div class="col-md-12 col-lg-6 col-sm-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title text-center fw-bold ">10th</h4>
                                            <!-- <form id="10th-form"> -->
                                            <div class="row">
                                                <div class="mb-1">
                                                    <label for="10th-year" class="form-label">Year of Pass</label>
                                                    <input type="number" class="form-control" name="10th_pass"
                                                        id="10th-year" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="10th-results" class="form-label">Results in (%)</label>
                                                    <input type="number" class="form-control" name="10th_result"
                                                        id="10th-results" step="0.01" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="10th-university" class="form-label">Board Name</label>
                                                    <input type="text" class="form-control" name="10th_board"
                                                        id="10th-university" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="10th-institute" class="form-label">Institute
                                                        Name</label>
                                                    <input type="text" class="form-control" name="10th_institute"
                                                        id="10th-institute" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="10th-location" class="form-label">Institute
                                                        Location</label>
                                                    <input type="text" class="form-control" name="10th_location"
                                                        id="10th-location" required>
                                                </div>
                                            </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Save & Next Button -->
                        <button type="submit" name="submit_edu" class="btn btn-primary float-end"
                            id="save-next-btnss">Save &
                            Next</button>
                    </section>
                </div>
                <div class="tab-pane fade" id="nav-experience" role="tabpanel" aria-labelledby="nav-experience-tab"
                    tabindex="0">
                    <section class="container">
                        <h5 class="text-center mb-4">Work Experience</h5>
                        <div class="row">
                            <!-- Experience Section -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold text-center">Experience Details</h4>
                                        <!-- Experience Form -->
                                        <form id="experience-form" method="post">
                                            <!-- Company 1 -->
                                            <div class="mb-4">
                                                <h5 class="fw-bold text-center">Company 1</h5>
                                                <div class="mb-1">
                                                    <label for="company1-name" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" name="cmp1_name"
                                                        id="company1-name" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company1-position" class="form-label">Position</label>
                                                    <input type="text" class="form-control" name="cmp1_position"
                                                        id="company1-position" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company1-address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="cmp1_address"
                                                        id="company1-address" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <label for="company1-from" class="form-label">From</label>
                                                        <input type="date" class="form-control" name="cmp1_from"
                                                            id="company1-from" required>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <label for="company1-to" class="form-label">To</label>
                                                        <input type="date" class="form-control" name="cmp1_to"
                                                            id="company1-to" required>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company1-salary" class="form-label">Last Salary / Annual
                                                        CTC</label>
                                                    <input type="number" class="form-control" name="cmp1_salary"
                                                        id="company1-salary" step="0.01" required>
                                                </div>
                                            </div>

                                            <!-- Company 2 -->
                                            <div class="mb-4">
                                                <h5 class="fw-bold text-center">Company 2</h5>
                                                <div class="mb-1">
                                                    <label for="company2-name" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" name="cmp2_name"
                                                        id="company2-name" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company2-position" class="form-label">Position</label>
                                                    <input type="text" class="form-control" name="cmp2_position"
                                                        id="company2-position" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company2-address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="cmp2_address"
                                                        id="company2-address" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <label for="company2-from" class="form-label">From</label>
                                                        <input type="date" class="form-control" name="cmp2_from"
                                                            id="company2-from" required>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <label for="company2-to" class="form-label">To</label>
                                                        <input type="date" class="form-control" name="cmp2_to"
                                                            id="company2-to" required>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company2-salary" class="form-label">Last Salary / Annual
                                                        CTC</label>
                                                    <input type="number" class="form-control" name="cmp2_saalry"
                                                        id="company2-salary" step="0.01" required>
                                                </div>
                                            </div>

                                            <!-- Company 3 -->
                                            <div class="mb-4">
                                                <h5 class="fw-bold text-center">Company 3</h5>
                                                <div class="mb-1">
                                                    <label for="company3-name" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" name="cmp3_name"
                                                        id="company3-name" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company3-position" class="form-label">Position</label>
                                                    <input type="text" class="form-control" name="cmp3_position"
                                                        id="company3-position" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company3-address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="cmp3_address"
                                                        id="company3-address" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <label for="company3-from" class="form-label">From</label>
                                                        <input type="date" class="form-control" name="cmp3_from"
                                                            id="company3-from" required>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <label for="company3-to" class="form-label">To</label>
                                                        <input type="date" class="form-control" name="cmp3_to"
                                                            id="company3-to" required>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="company3-salary" class="form-label">Last Salary / Annual
                                                        CTC</label>
                                                    <input type="number" class="form-control" name="cmp3_salary"
                                                        id="company3-salary" step="0.01" required>
                                                </div>
                                            </div>

                                            <!-- Save & Next Button -->
                                            <button type="submit" name="submit_exp" class="btn btn-primary float-end"
                                                id="save-next-btnsss">Save &
                                                Next</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane fade" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab"
                    tabindex="0">
                    <div class="container">
                        <h5 class="text-center mb-4">Upload Documents</h5>
                        <form id="documentation-form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- PG Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Post Graduation</h4>
                                            <div id="pg-doc-form">
                                                <div class="mb-3">
                                                    <label for="pg-doc" class="form-label">Upload PG Marksheet &
                                                        Degree
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="pg_document"
                                                        id="pg-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Graduation Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Graduation</h4>
                                            <div id="grad-doc-form">
                                                <div class="mb-3">
                                                    <label for="grad-doc" class="form-label">Upload Graduation Mark
                                                        Sheet &
                                                        Degree
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="grad_document"
                                                        id="grad-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Class 12 Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Diploma/+2</h4>
                                            <div id="class12-doc-form">
                                                <div class="mb-3">
                                                    <label for="class12-doc" class="form-label">Upload Diploma/+2 Mark
                                                        Sheet
                                                        &
                                                        Degree
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="class12_document"
                                                        id="class12-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Class 10 Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Class 10</h4>
                                            <div id="class10-doc-form">
                                                <div class="mb-3">
                                                    <label for="class10-doc" class="form-label">Upload Class 10 Mark
                                                        Sheet &
                                                        Certificate
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="class10_document"
                                                        id="class10-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Aadhar Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Aadhaar</h4>
                                            <div id="aadhar-doc-form">
                                                <div class="mb-3">
                                                    <label for="aadhar-doc" class="form-label">Upload Aadhaar (Both
                                                        Front & Back)
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="aadhar_document"
                                                        id="aadhar-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PAN Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">PAN</h4>
                                            <div id="pan-doc-form">
                                                <div class="mb-3">
                                                    <label for="pan-doc" class="form-label">Upload PAN
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="pan_document"
                                                        id="pan-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Blood Group Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Blood Group</h4>
                                            <div id="blood-group-doc-form">
                                                <div class="mb-3">
                                                    <label for="blood-group-doc" class="form-label">Upload Blood Group
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="bg_document"
                                                        id="blood-group-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- EXperience Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Experience</h4>
                                            <div id="experience-doc-form">
                                                <div class="mb-3">
                                                    <label for="blood-group-doc" class="form-label">Upload Experience &
                                                        Releasing Certificate of all the companies mentioned
                                                        (PDF)</label>
                                                    <input type="file" class="form-control" name="exp_document"
                                                        id="experience-doc" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Signature Document Upload -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold">Signature</h4>
                                            <div id="experience-doc-form">
                                                <div class="mb-3">
                                                    <label for="image-sign" class="form-label">Upload Signature
                                                        (Image)</label>
                                                    <p>(Image should be 120x20 and size 20KB )</p>
                                                    <input type="file" class="form-control" name="image_sign"
                                                        id="image-sign" accept="image/*" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Save & Next Button -->
                                <button type="submit" name="submit_document"
                                    class="btn btn-primary submit-btn button-submit float-end">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="script.js?v=1.6"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
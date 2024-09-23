<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Employee Details</title>
    <style>
        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            /* Slightly white overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .lock-icon {
            font-size: 3rem;
            /* Size of the lock icon */
        }

        .d-none {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <!-- Header -->
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1>Employee Details</h1>
            </div>
        </div>

        <?php
        include "conn.php";
        $sql = "SELECT * FROM emp_form";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>


                <!-- Personal Info Section -->
                <div class="row mb-5">
                    <div class="col-12 text-center section-title">
                        <h2>Personal Info</h2>
                        <p class="fs-5">None of the file should be password protected. All files are need to be properly sized &
                            visible.</p>
                    </div>
                    <!-- First Image: Live Photo -->
                    <div class="col-md-3 img-all text-center">
                        <img src="upload/<?php echo $row['emp_form_livepic']; ?>" alt="Live Photo" class="img-fluid" />
                        <p>Live Photo</p>
                    </div>
                    <!-- Second Image: Uploaded Photo -->
                    <div class="col-md-3 img-all text-center">
                        <img src="upload/<?php echo $row['emp_form_image']; ?>" alt="Uploaded Photo" class="img-fluid" />
                        <p>Uploaded Photo</p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Personal Information
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">Name: Rock Joe</div>
                                    <div class="col-sm-12">Father's Name: <?php echo $row["emp_form_fathername"]; ?><span
                                            id="fatherNameDisplay"></span></div>
                                    <div class="col-sm-12">Mother's Name: <?php echo $row["emp_form_mothername"]; ?><span
                                            id="motherNameDisplay"></span> </div>
                                    <div class="col-sm-12">Blood Group: <?php echo $row["emp_form_bg"]; ?><span
                                            id="bloodgroupDisplay"></span> </div>
                                    <div class="col-sm-12">Gender: <?php echo $row["emp_form_gender"]; ?><span
                                            id="genderDisplay"></span> </div>
                                    <div class="col-sm-12">Marital Status: <?php echo $row["emp_form_marital"]; ?><span
                                            id="maritalStatusDisplay"></span> </div>
                                    <div class="col-sm-12">Mobile Number: +1234567890</div>
                                    <div class="col-sm-12">Whatsapp Number: <?php echo $row["emp_form_wpnum"]; ?><span
                                            id="whatsappNumberDisplay"></span> </div>
                                    <div class="col-sm-12">Aadhar Number: <?php echo $row["emp_form_adharnum"]; ?><span
                                            id="aadharNumberDisplay"></span> </div>
                                    <div class="col-sm-12">PAN Number: <?php echo $row["emp_form_pan"]; ?><span
                                            id="panNumberDisplay"></span> </div>
                                    <div class="col-sm-12">Emergency Contact Number:
                                        <?php echo $row["emp_form_emernum"]; ?><span id="emergencyContactDisplay"></span>
                                    </div>
                                    <div class="col-sm-12">Emergency Contact Relation:
                                        <?php echo $row["emp_form_emerrel"]; ?><span id="emergencyRelationDisplay"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Sections -->
                <div class="row mb-5">
                    <div class="col-12 text-center section-title">
                        <h2>Address</h2>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Permanent Address
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">Address:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_adrs"]; ?></div>
                                    <div class="col-sm-6">City/Village:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_city"]; ?></div>
                                    <div class="col-sm-6">District:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_dist"]; ?></div>
                                    <div class="col-sm-6">State:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_state"]; ?></div>
                                    <div class="col-sm-6">Country:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_country"]; ?></div>
                                    <div class="col-sm-6">PIN:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_pin"]; ?></div>
                                    <div class="col-sm-6">Post:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_post"]; ?></div>
                                    <div class="col-sm-6">Police Station:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_police"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Present Address -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Present Address
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">Address:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_preadrs"]; ?></div>
                                    <div class="col-sm-6">City/Village:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_precity"]; ?></div>
                                    <div class="col-sm-6">District:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_predist"]; ?></div>
                                    <div class="col-sm-6">State:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_prestate"]; ?></div>
                                    <div class="col-sm-6">Country:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_precountry"]; ?></div>
                                    <div class="col-sm-6">PIN:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_prepin"]; ?></div>
                                    <div class="col-sm-6">Post:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_prepost"]; ?></div>
                                    <div class="col-sm-6">Police Station:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_prepolice"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Educational Background Section -->
                <div class="row mb-5">
                    <div class="col-12 text-center section-title">
                        <h2>Educational Background</h2>
                    </div>
                    <div class="col-lg-6 col-md-12 p-3">
                        <div class="card">
                            <div class="card-header">
                                Post Graduation
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">Stream:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_pgrad_stream"]; ?></div>
                                    <div class="col-sm-6">Year of Pass:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_pgrad_yearpass"]; ?></div>
                                    <div class="col-sm-6">Results in (%):</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_pgrad_result"]; ?>%</div>
                                    <div class="col-sm-6">University Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_pgrad_univ"]; ?></div>
                                    <div class="col-sm-6">Institute Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_pgrad_insti"]; ?></div>
                                    <div class="col-sm-6">Institute Location:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_pgrad_location"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Graduation -->
                    <div class="col-lg-6 col-md-12 p-3">
                        <div class="card">
                            <div class="card-header">
                                Graduation
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">Stream:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_grad_stream"]; ?></div>
                                    <div class="col-sm-6">Year of Pass:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_grad_yearpass"]; ?></div>
                                    <div class="col-sm-6">Results in (%):</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_grad_res"]; ?>%</div>
                                    <div class="col-sm-6">University Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_grad_univ"]; ?></div>
                                    <div class="col-sm-6">Institute Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_grad_insti"]; ?></div>
                                    <div class="col-sm-6">Institute Location:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_grad_location"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Diploma/+2 -->
                    <div class="col-lg-6 col-md-12 p-3">
                        <div class="card">
                            <div class="card-header">
                                Diploma/+2
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">Stream:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c12type"]; ?></div>
                                    <div class="col-sm-6">Year of Pass:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c12yearpass"]; ?></div>
                                    <div class="col-sm-6">Results in (%):</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c12result"]; ?>%</div>
                                    <div class="col-sm-6">Board Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c12board"]; ?></div>
                                    <div class="col-sm-6">Institute Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c12school"]; ?></div>
                                    <div class="col-sm-6">Institute Location:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c12location"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 10th -->
                    <div class="col-lg-6 col-md-12 p-3">
                        <div class="card">
                            <div class="card-header">
                                10th
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">Year of Pass:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c10yearpass"]; ?></div>
                                    <div class="col-sm-6">Results in (%):</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c10result"]; ?>%</div>
                                    <div class="col-sm-6">Board Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c10board"]; ?></div>
                                    <div class="col-sm-6">Institute Name:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c10school"]; ?></div>
                                    <div class="col-sm-6">Institute Location:</div>
                                    <div class="col-sm-6"><?php echo $row["emp_form_c10location"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Uploaded Documents Section -->
                <div class="row mb-5">
                    <div class="col-12 text-center section-title">
                        <h2>Uploaded Documents</h2>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">Post Graduation:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_pgrad_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                            <div class="col-sm-6">Graduation:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_grad_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                            <div class="col-sm-6">Diploma/+2:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_c12_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                            <div class="col-sm-6">Class 10:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_c10_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                            <div class="col-sm-6">Aadhar:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_adhar_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                            <div class="col-sm-6">PAN:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_pan_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                            <div class="col-sm-6">Blood Group:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_bg_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                            <div class="col-sm-6">Experience:</div>
                                            <div class="col-sm-6"><a href="<?php echo $row['emp_form_other_doc']; ?>"
                                                    class="document-link">View Document</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-5">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="termsCheckbox">
                            <label class="form-check-label" for="termsCheckbox">
                                I, [<?php echo $row["emp_form_name"]; ?>] declare that all the data & documents submitted
                                for my employment purpose with
                                TECHGEERING SOLUTIONS PVT. LTD. is true & authenticate. If required I'll produce the original
                                with any other supporting documents as & when required. I also accept <a href="">terms of
                                    employment</a> of the company.
                            </label>
                        </div>
                    </div>


                    <!-- Date Section -->
                    <div class="col-4 mt-4">
                        <div class="mb-3">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="dateField" readonly>
                        </div>
                    </div>

                    <!-- Date Section -->
                    <div class="col-4 mt-4">
                        <div class="mb-3">
                            <label for="text" class="form-label">IP Address:</label>
                            <input type="text" name="ipAddressInput" id="ipAddressInput" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Signature Upload Section -->
                    <div class="col-4 mt-4">
                        <div class="mb-3">
                            <label for="signature" class="form-label">Uploaded Signature:</label>
                            <img id="signature-image" src="upload/<?php echo $row['emp_form_sign']; ?>" alt="Uploaded Signature"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                <?php }
        } ?>
            <!-- Edit Button -->
            <div class="col-6">
                <button type="button" class="btn btn-secondary w-100 mb-2" id="editButton">Edit</button>
            </div>

            <!-- Submit Button -->
            <div class="col-6">
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop" id="submitButton">Submit</button>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Conformation Alert !!!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do You Want To Submit ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" id="toaster" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toaster -->
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toastSuccess" class="toast align-items-center text-white bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex" style="height: 9vh !important;">
                    <div class="toast-body">
                        Thank You ! Your documents are uploaded for authentication...
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay and Lock Icon -->
    <div id="overlay" class="overlay d-none">
        <div class="lock-icon text-center">
            <i class="fas fa-lock"></i> <!-- Font Awesome lock icon -->
            <h4 class="fw-bold">Your Documents Are Uploaded Successfully For Authentication</h4>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="script.js"></script>



    <script>

        window.onload = function () {
            const imageData = localStorage.getItem('uploadedSignature');

            if (imageData) {
                const imgElement = document.getElementById('signature-image');
                imgElement.src = imageData;
            }
        };

        document.addEventListener("DOMContentLoaded", function () {
            const editButton = document.getElementById('editButton');
            const submitButton = document.getElementById('submitButton');
            const termsCheckbox = document.getElementById('termsCheckbox');
            const dateField = document.getElementById('dateField');
            const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));

            // When the edit button is clicked, go back to the previous page
            editButton.addEventListener('click', function () {
                history.back(); // This takes the user back to the previous page
            });

            function toggleSubmitButton() {
                submitButton.disabled = !termsCheckbox.checked;
            }

            // Set the current date in YYYY-MM-DD format
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const day = String(now.getDate()).padStart(2, '0');
            const dateString = `${year}-${month}-${day}`;
            dateField.value = dateString;

            // Initialize the button state
            toggleSubmitButton();

            // Event listener for checkbox
            termsCheckbox.addEventListener('change', toggleSubmitButton);

            // Handle form submission with modal
            submitButton.addEventListener('click', function () {
                modal.show(); // Show the modal
            });

            // Handle "Yes" button in the modal
            document.getElementById('toaster').addEventListener('click', function () {
                // Perform form submission or additional actions here
                modal.hide(); // Close the modal
                // You can handle form submission here if needed
                // Example: document.querySelector('form').submit();
            });

            // Ensure both "No" button and close (×) button close the modal
            const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    modal.hide(); // Close the modal
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Initialize toast
            var toastEl = document.getElementById('toastSuccess');
            var toast = new bootstrap.Toast(toastEl);

            // Add event listener to the Yes button in the modal
            document.querySelector('.modal-footer .btn-primary').addEventListener('click', function () {
                // Show the toast
                toast.show();

                // Hide the modal
                var modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                modal.hide();

                // Disable all buttons and prevent navigation after 5 seconds
                setTimeout(function () {
                    // Disable all buttons
                    document.querySelectorAll('button').forEach(button => button.disabled = true);

                    // Prevent page back navigation
                    window.history.pushState(null, '', window.location.href);
                    window.addEventListener('popstate', function () {
                        window.history.pushState(null, '', window.location.href);
                    });

                    // Optionally, you can show the overlay and lock icon here if needed
                    document.getElementById('overlay').classList.remove('d-none');
                }, 1000); // 5 seconds delay
            });
        });


        fetch('https://api.ipify.org?format=json')
            .then(response => response.json())
            .then(data => {
                const ipAddress = data.ip;
                const ipAddressInput = document.getElementById('ipAddressInput');
                ipAddressInput.value = ipAddress; // Set the value of the input field

                // Send IP address to PHP script
                const formData = new FormData();
                formData.append('ipAddress', ipAddress);

                fetch('insert_ip.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(result => {
                        console.log(result); // Log the result from PHP script
                    })
                    .catch(error => {
                        console.error('Error inserting IP address:', error);
                    });
            })
            .catch(error => {
                console.error('Error fetching IP address:', error);
            });



    </script>
</body>

</html>
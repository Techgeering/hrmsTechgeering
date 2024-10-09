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
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
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
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Certificate</th>
                                        <th>View Details</th>
                                        <th>Application Document</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "common/conn.php";
                                    $sql = "SELECT * FROM internship ORDER BY id DESC";
                                    $result = $conn->query($sql);
                                    $slno = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $intern_id = base64_encode($row['id']);
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
                                                <td><?php echo $row["start_date"]; ?></td>
                                                <td>
                                                    <p class="edit">
                                                        <?php echo !empty($row["end_date"]) ? $row["end_date"] : "N/A"; ?>
                                                    </p>
                                                    <input type="date" class='txtedit' value='<?php echo $row["end_date"]; ?>'
                                                        id='end_date-<?php echo $row["id"]; ?>-internship'
                                                        style="display:none;"></input>
                                                </td>
                                                <td>
                                                    <?php if (!empty($row["end_date"])): ?>
                                                        <i class="fa-solid fa-certificate"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#paragraphmodal_<?php echo $id; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if (!empty($row['intern_doc'])): ?>
                                                        <a href="internpdf.php?id=<?php echo $intern_id; ?>" target="_blank">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                    <?php endif; ?>
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
                                                                <div
                                                                    class="col-md-6 d-flex justify-content-between align-items-center">
                                                                    <strong>Valid Govt. Id No.:</strong>
                                                                    <?php echo $row["valid_govt_no"]; ?>
                                                                    <?php if (!empty($row['intern_doc'])): ?>
                                                                        <a href="assets/uploads/intern/<?php echo $row['intern_doc']; ?>"
                                                                            target="_blank">
                                                                            <i class="fa-solid fa-file-pdf"></i>
                                                                        </a>
                                                                    <?php endif; ?>
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
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Certificate</th>
                                        <th>View Details</th>
                                        <th>Application Document</th>
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
    <script src="assets/js/scripts.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // When the '.edit' class (paragraph) is clicked
            $(document).on('click', '.edit', function () {
                var txtEdit = $(this).next('.txtedit'); // Get the associated input field
                var editText = $(this); // Store the paragraph element being clicked

                editText.hide(); // Hide the paragraph text
                txtEdit.show().focus(); // Show the input field and focus on it

                // Attach the focusout event after the input field is focused
                txtEdit.one('focusout', function () {
                    var field_name = txtEdit.attr('id').split("-")[0]; // Get field name ('end_date')
                    var edit_id = txtEdit.attr('id').split("-")[1]; // Get the ID
                    var table_name = txtEdit.attr('id').split("-")[2]; // Get the table name
                    var value = txtEdit.val(); // Get the new date value

                    console.log("Field:", field_name, "ID:", edit_id, "Table:", table_name, "Value:", value);

                    // Validate the input value
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

                    // Show the new date in the paragraph
                    editText.show();
                    editText.text(value || "N/A"); // Fallback to "N/A" if empty
                    txtEdit.hide();

                    // AJAX call to save the new date to the database
                    $.ajax({
                        url: 'insert_internenddate.php',
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
                                console.log('Saved Successfully');
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

</body>

</html>
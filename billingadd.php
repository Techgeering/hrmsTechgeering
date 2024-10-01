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
                        <h1 class="my-2">Add Bill</h1>
                        <a href="billing.php" type="button" class="btn btn-primary">
                            Bill List
                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" id="datee" name="date1">
                                    </div>
                                    <div class="col-3">
                                        <label for="gst">GST(%)</label>
                                        <select class="form-control" id="gst" name="gst1">
                                            <option value="5">5%</option>
                                            <option value="12">12%</option>
                                            <option value="18" selected>18%</option>
                                            <option value="28">28%</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="projectInput">Project Name:</label>
                                        <input type="text" id="projectInput" class="form-control"
                                            placeholder="Enter project name" autocomplete="off">

                                        <div id="projectSuggestions" class="dropdown-menu"
                                            style="display: none; max-height: 200px; overflow-y: auto; border: 1px solid #ccc; position: absolute; z-index: 1000;">
                                        </div>

                                        <!-- Hidden input to store project ID -->
                                        <input type="hidden" id="projectId" name="pro_value">
                                    </div>
                                </div>

                                <div id="form-container">
                                    <!-- Product Group - First Group to Clone -->
                                    <div class="product-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label>Description</label>
                                                <input type="text" class="form-control" id="dess" name="des1[]">
                                            </div>
                                            <div class="col-2">
                                                <label>Service</label>
                                                <input type="text" class="form-control" placeholder="Enter service name"
                                                    name="service[]" oninput="showSuggestions(this.value, this)">
                                                <div class="suggestion-dropdown" style="display:none;"></div>
                                            </div>
                                            <div class="col-2">
                                                <label>HSN</label>
                                                <input type="text" class="form-control" name="hsn1[]" readonly>
                                            </div>
                                            <div class="col-2">
                                                <label>Total Amount</label>
                                                <input type="text" class="form-control" name="totalamount1[]">
                                            </div>
                                            <div class="col-2 mt-4">
                                                <button type="button" class="btn btn-danger remove-product">-</button>
                                                <button type="button" class="btn btn-success add-product">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- End of product-group -->
                                <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'common/copyrightfooter.php' ?>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        include "common/conn.php";
        $date1 = $_POST["date1"];
        $gst1 = $_POST["gst1"];
        $pro_value = $_POST["pro_value"];
        // $invoicccc = $_POST["invoicccc"];
        $descriptions = $_POST["des1"];
        $services = $_POST["service"];
        $hsns = $_POST["hsn1"];
        $totalamounts = $_POST["totalamount1"];

        $sql = "INSERT INTO project_invoice (date, pro_gst, project_id) VALUES ('$date1','$gst1','$pro_value')";
        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            $monthNumber = date('m');
            $year = date('Y');
            $invoicccc = $year . $monthNumber . $last_id;

            $sql2 = "UPDATE project_invoice SET invoice_number='$invoicccc'  WHERE id = '$last_id'";
            if ($conn->query($sql2) === true) {

                foreach ($descriptions as $index => $description) {
                    $invoice = $invoicccc;
                    $service = mysqli_real_escape_string($conn, $services[$index]);
                    $hsn = mysqli_real_escape_string($conn, $hsns[$index]);
                    $totalamount = mysqli_real_escape_string($conn, $totalamounts[$index]);
                    // Insert product data into the database
                    $sql1 = "INSERT INTO invoice_details 
                (invoice_number, description, service, hsn_num, total_amount) VALUES ('$invoice', '$description', '$service', '$hsn', '$totalamount')";

                    if ($conn->query($sql1) !== true) {
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }
                echo "<script>window.location.href='billing.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <!-- for project name suggetions -->
    <script>
        document.getElementById('projectInput').addEventListener('input', function () {
            const selectedProject = this.value;
            const suggestionsContainer = document.getElementById('projectSuggestions');
            if (selectedProject) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'get_projects.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    if (this.status === 200) {
                        const projects = JSON.parse(this.responseText);
                        suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                        if (projects.length > 0) {
                            projects.forEach(project => {
                                // Create a suggestion item
                                const suggestionItem = document.createElement('div');
                                suggestionItem.textContent = project.pro_name; // Adjust this according to your data
                                suggestionItem.className = 'dropdown-item';
                                suggestionItem.style.cursor = 'pointer';

                                // When a suggestion is clicked
                                suggestionItem.addEventListener('click', function () {
                                    document.getElementById('projectInput').value = project.pro_name;
                                    document.getElementById('projectId').value = project.id; // Store the project ID
                                    suggestionsContainer.style.display = 'none'; // Hide suggestions
                                });

                                suggestionsContainer.appendChild(suggestionItem);
                            });
                            suggestionsContainer.style.display = 'block'; // Show suggestions
                        } else {
                            suggestionsContainer.style.display = 'none'; // Hide if no suggestions
                        }
                    }
                };
                xhr.send('pro_name=' + encodeURIComponent(selectedProject));
            } else {
                suggestionsContainer.style.display = 'none'; // Hide if input is empty
            }
        });
        // Hide suggestions when clicking outside
        document.addEventListener('click', function (e) {
            if (!document.getElementById('projectInput').contains(e.target)) {
                document.getElementById('projectSuggestions').style.display = 'none';
            }
        });
    </script>
    <!-- for service name and it's hsn number -->
    <script>
        function showSuggestions(value, inputElement) {
            const suggestions = inputElement.parentElement.querySelector(".suggestion-dropdown");
            suggestions.innerHTML = ""; // Clear previous suggestions

            if (value.length > 0) {
                // Make AJAX call to fetch services
                const xhr = new XMLHttpRequest();
                xhr.open("GET", `get_service.php?term=${encodeURIComponent(value)}`, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const services = JSON.parse(xhr.responseText);
                        services.forEach(service => {
                            const suggestionDiv = document.createElement("div");
                            suggestionDiv.textContent = service.service_name;
                            suggestionDiv.onclick = () => selectService(service, inputElement);
                            suggestions.appendChild(suggestionDiv);
                        });

                        if (services.length > 0) {
                            suggestions.style.display = "block"; // Show dropdown
                        } else {
                            suggestions.style.display = "none"; // Hide dropdown if no matches
                        }
                    } else {
                        console.error("Error fetching services: " + xhr.statusText);
                    }
                };
                xhr.send();
            } else {
                suggestions.style.display = "none"; // Hide dropdown if input is empty
            }
        }

        function selectService(service, inputElement) {
            const hsnInput = inputElement.parentElement.nextElementSibling.querySelector("input");
            inputElement.value = service.service_name;
            hsnInput.value = service.hsn_num; // Use the correct property for HSN
            inputElement.parentElement.querySelector(".suggestion-dropdown").style.display = "none"; // Hide dropdown after selection
        }

        $(document).ready(function () {
            // Clone product form group
            $(document).on('click', '.add-product', function () {
                console.log('Add button clicked'); // Debugging message
                var productGroup = $('.product-group').first().clone(); // Clone the first group
                productGroup.find('input').val(''); // Clear input values in the cloned group
                productGroup.find('.suggestion-dropdown').hide(); // Hide suggestions dropdown in the cloned group
                $('#form-container').append(productGroup); // Append cloned group to the form container
                console.log('Product group added'); // Debugging message
            });

            // Remove product form group
            $(document).on('click', '.remove-product', function () {
                if ($('.product-group').length > 1) {
                    $(this).closest('.product-group').remove(); // Remove the closest product group
                    console.log('Product group removed'); // Debugging message
                } else {
                    alert('At least one product must remain.');
                }
            });
        });
    </script>
</body>

</html>
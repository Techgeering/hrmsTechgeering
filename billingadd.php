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
                                        <label for="subcategoryDropdown">Project Name:</label>
                                        <select class="form-control" name="pro_value" required>
                                            <option value="">Select Project</option>
                                            <?php
                                            $sql2 = "SELECT * FROM project";
                                            $result2 = $conn->query($sql2);
                                            while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row2["id"]; ?>">
                                                    <?php echo $row2["pro_name"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-3">
                                        <label>Invoice Number</label>
                                        <input type="text" class="form-control" id="invoicee" name="invoicccc">
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
                                                <input type="text" class="form-control" id="service" name="service[]">
                                            </div>
                                            <div class="col-2">
                                                <label>HSN</label>
                                                <input type="text" class="form-control" id="hsn" name="hsn1[]">
                                            </div>
                                            <div class="col-2">
                                                <label>Total Amount</label>
                                                <input type="text" class="form-control" id="totalamount"
                                                    name="totalamount1[]">
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
        $invoicccc = $_POST["invoicccc"];
        $descriptions = $_POST["des1"];
        $services = $_POST["service"];
        $hsns = $_POST["hsn1"];
        $totalamounts = $_POST["totalamount1"];

        $sql = "INSERT INTO project_invoice (date, pro_gst, project_id, invoice_number) VALUES ('$date1','$gst1','$pro_value','$invoicccc')";
        if ($conn->query($sql) === true) {

            foreach ($descriptions as $index => $description) {
                $invoice = $invoicccc;
                $service = mysqli_real_escape_string($conn, $services[$index]);
                $hsn = mysqli_real_escape_string($conn, $hsns[$index]);
                $totalamount = mysqli_real_escape_string($conn, $totalamounts[$index]);
                // Insert product data into the database
                $sql = "INSERT INTO invoice_details 
                (invoice_number, description, service, hsn_num, total_amount) VALUES ('$invoice', '$description', '$service', '$hsn', '$totalamount')";

                if ($conn->query($sql) !== true) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            echo "<script>window.location.href='billing.php';</script>";
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
    <script>
        $(document).ready(function () {
            // Clone product form group
            $(document).on('click', '.add-product', function () {
                console.log('Add button clicked'); // Debugging message
                var productGroup = $('.product-group').first().clone(); // Clone the first group
                productGroup.find('input').val(''); // Clear input values in the cloned group
                productGroup.find('select').prop('selectedIndex', 0); // Reset dropdowns
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
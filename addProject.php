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
    <link href="css/styles.css" rel="stylesheet" />
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
                    <h1 class="my-2">Add Project</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Project Name</label>
                                        <input class="form-control" type="text" name="projectname">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Domain Name</label>
                                        <input class="form-control" type="text" name="domainname">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Mobile No.</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Email Id</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">GST No.</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">State</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name">Start Date</label>
                                        <p class="form-control">Company name</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name">End Date</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name">Delivery Date</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name">Renual Date</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">Rate</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">Discount</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">Price</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">GST</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">Grand Total</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">3rd Party Charges</label>
                                        <p class="form-control">gdcjas</p>
                                    </div>
                                </div>
                                <div class="col-6">

                                    <h6>Contact Persons</h6>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Designation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>adfas</th>
                                                <th>dadf</th>
                                                <th>dafs</th>
                                                <th>asdf</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <h6>Instalment type</h6>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>%</th>
                                                <th>Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>adfas</th>
                                                <th>adfas</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <h6>Payments</h6>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                                <th>Send Invoice</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>adfas</th>
                                                <th>adfas</th>
                                                <th>adfas</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">MOU</label>
                                        <img src="user.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name">Proposal</label>
                                        <img src="user.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'common/copyrightfooter.php' ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
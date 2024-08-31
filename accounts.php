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
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="my-2">Accounts</h1>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Project Name</th>
                                        <th>Domain Name</th>
                                        <th>Project cost</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>status</th>
                                        <th>ADD</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Project Name</th>
                                        <th>Domain Name</th>
                                        <th>Project cost</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>status</th>
                                        <th>ADD</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <th>ddddd</th>
                                        <th>sdafdsf</th>
                                        <th>adfds</th>
                                        <th>adfds</th>
                                        <th>adfsdasf</th>
                                        <th>sdafdsf</th>
                                        <th>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addDept">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </th>
                                        <th>
                                            <a href="projectDetails.php"><i
                                                    class="fa-solid fa-eye text-success"></i></a>
                                            <i class="fa-solid fa-pen-to-square me-2 ms-2 text-primary"></i>
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'common/copyrightfooter.php' ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addDept" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeptLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <input type="tel" value="1" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="projectName">Project Name</label>
                            <input type="text" class="form-control" id="projectName">
                        </div>
                        <div class="form-group">
                            <label for="Amount">Amount</label>
                            <input type="text" class="form-control" id="Amount">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">submit</button>
                    </div>
                </form>
            </div>
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
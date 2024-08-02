<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Techgeering</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <!-- <form method="post" action="insert.php"> -->
                                    <form method="post" action="<?php //echo $_SERVER['PHP_SELF']; 
                                    ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="text"
                                                placeholder="User Id" />
                                            <label for="inputEmail">User Id</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword"
                                                type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <div class="small">
                                                <input class="form-check-input" id="inputRememberPassword"
                                                    type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember
                                                    Password</label>
                                            </div>
                                            <input type="submit" class="btn btn-primary" name="login" value="Login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <?php include 'common/copyrightfooter.php' ?>
        </div>
    </div>
    <?php
    if (isset($_POST['login'])) {
        include "common/conn.php";
        $username = $_POST["email"];
        $userpassword = $_POST["password"];
        $sql = "SELECT * FROM users WHERE username='$username' and password='$userpassword'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row > 0) {
            $desigantion = $row['designation'];
            echo "<script>alert('$desigantion');</script>";
            session_start();
            $_SESSION["username"] = "$username";
            header("location:index.php");
            echo "found";
        } else {
            echo "not found";
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
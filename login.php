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
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];
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
        $password = $_POST["password"];
        $sql = "SELECT * FROM employee WHERE em_email = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['em_password'];
            if (password_verify($password, $hashedPassword)) {
                $user_id = $row['id'];
                $emp_id = $row['emp_id'];
                $em_role = $row['em_role'];
                // Store the user ID in the session
                session_start();
                $_SESSION["username"] = "$user_id";
                $_SESSION["em_role"] = "$em_role";
                $_SESSION["emp_id"] = "$emp_id";
                // Redirect the user to index.php after successful sign-in
                echo "<script>window.location.href='index.php';</script>";
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "User not found. Please register if you don't have an account.";
        }
        $conn->close();

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
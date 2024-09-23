<?php
session_start();
if (isset($_SESSION['emp_form_phone'])) {
  if ($_SESSION['emp_form_phone'] != null) {
    header("Location: upload-details.php");
    exit();
  } else {
    header("Location: index.php");
    exit();
  }
}
$mobilenoError = '';
$dobError = '';
if (isset($_POST['signin'])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conn.php';
    $mobileno = $_POST['phonenumber'];
    $dob = $_POST['dateofbirth'];

    // Fetch the user details by username
    $sql = "SELECT * FROM emp_form WHERE emp_form_phone = '$mobileno' AND emp_form_dob = '$dob'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $mobileno = $row['emp_form_phone'];
      $_SESSION['emp_form_phone'] = $mobileno;

      echo "<script>window.location.href='upload-details.php';</script>";
    } else {
      $passwordError = "Invalid password. Please try again.";
    }
  } else {
    $usernameError = "User not found. Please register if you don't have an account.";
  }
  $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TECHGEERING | LOGIN PAGE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #eceffc;
    }

    .btn {
      padding: 8px 20px;
      border-radius: 0;
      overflow: hidden;
    }

    .btn::before {
      position: absolute;
      content: "";
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(120deg, transparent, var(--primary-color), transparent);
      transform: translateX(-100%);
      transition: 0.6s;
    }

    .btn:hover {
      background: transparent;
      box-shadow: 0 0 20px 10px rgba(51, 152, 219, 0.5);
    }

    .btn:hover::before {
      transform: translateX(100%);
    }

    .form-input-material {
      --input-default-border-color: white;
      --input-border-bottom-color: white;
    }

    .form-input-material input {
      color: white;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 50px 40px;
      color: white;
      background: rgba(0, 0, 0, 0.8);
      border-radius: 10px;
      box-shadow: 0 0.4px 0.4px rgba(128, 128, 128, 0.109), 0 1px 1px rgba(128, 128, 128, 0.155), 0 2.1px 2.1px rgba(128, 128, 128, 0.195), 0 4.4px 4.4px rgba(128, 128, 128, 0.241), 0 12px 12px rgba(128, 128, 128, 0.35);
    }

    .login-form h1 {
      margin: 0 0 24px 0;
    }

    .login-form .form-input-material {
      margin: 12px 0;
    }

    .login-form .btn {
      width: 100%;
      margin: 18px 0 9px 0;
    }

    .log-btn {
      text-decoration: none;
      color: white;
    }
  </style>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/alphardex/aqua.css@master/dist/aqua.min.css'>
  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h1>Login</h1>
    <div class="form-input-material">
      <input type="text" name="phonenumber" id="phonenumber" placeholder=" " autocomplete="off"
        class="form-control-material" required />
      <label for="number">Phone Number</label>
    </div>
    <div class="form-input-material">
      <input type="text" name="dateofbirth" id="dateofbirth" placeholder=" " autocomplete="off"
        class="form-control-material" required />
      <label for="dateofbirth">Date of Birth</label>
    </div>
    <button type="submit" name="signin" class="btn btn-primary btn-ghost">Login</button>
  </form>
  <!-- partial -->

</body>

</html>
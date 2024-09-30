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
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function () {
         // Fetch the public IP using the ipify API
         $.get('https://api.ipify.org?format=json', function (data) {
            // Append the IP address to a hidden input field
            $('#client_ip').val(data.ip);
         });
      });
   </script>
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
                           <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                              <input type="hidden" id="client_ip" name="client_ip" value="">
                              <div class="form-floating mb-3">
                                 <input class="form-control" id="inputEmail" name="email" type="text"
                                    placeholder="User Id" />
                                 <label for="inputEmail">User Id</label>
                              </div>
                              <div class="form-floating mb-3 position-relative">
                                 <input class="form-control" name="password" id="inputPassword" type="password"
                                    placeholder="Password" />
                                 <label for="inputPassword">Password</label>
                                 <button type="button" class="btn btn-light position-absolute"
                                    style="right: 10px; top: 50%; transform: translateY(-50%);"
                                    onclick="togglePassword()">
                                    <i id="eyeIcon" class="fa fa-eye"></i>
                                 </button>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                 <div class="small">
                                    <input class="form-check-input" id="inputRememberPassword" name="rememberme"
                                       type="checkbox" <?php if (isset($_COOKIE['remember_username']))
                                          echo 'checked'; ?> />
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
         <?php include 'common/copyrightfooter.php'; ?>
      </div>
   </div>
   <?php
   if (isset($_POST['login'])) {
      include "common/conn.php";
      $username = $_POST["email"];
      $password = $_POST["password"];
      $client_ip = $_POST["client_ip"];

      // Prepare the SQL statement
      $sql = "SELECT * FROM employee WHERE prof_email = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
         $row = $result->fetch_assoc();
         $hashedPassword = $row['em_password'];

         if (password_verify($password, $hashedPassword)) {
            $emp_tbl_id = $row['id'];
            $emp_id = $row['em_code'];
            $em_role = $row['em_role'];

            // Store the user ID in the session
            session_start();
            $_SESSION["username"] = "$emp_tbl_id";
            $_SESSION["em_role"] = "$em_role";
            $_SESSION["emp_id"] = "$emp_id";



            if (isset($_POST['rememberme'])) {
               // Set cookie for persistent login
               setcookie('remember_username', $emp_tbl_id, time() + (86400 * 30), "/"); // 30 days expiration
               setcookie('em_role', $em_role, time() + (86400 * 30), "/");
               setcookie('emp_id', $emp_id, time() + (86400 * 30), "/");

               // Set session storage for current session
               echo "<script>sessionStorage.setItem('remember_username', '$emp_tbl_id');</script>";
               echo "<script>sessionStorage.setItem('em_role', '$em_role');</script>";
               echo "<script>sessionStorage.setItem('emp_id', '$emp_id');</script>";
            } else {
               // Set session storage for current session only
               echo "<script>sessionStorage.setItem('remember_username', '$emp_tbl_id');</script>";
               echo "<script>sessionStorage.setItem('em_role', '$em_role');</script>";
               echo "<script>sessionStorage.setItem('emp_id', '$emp_id');</script>";
            }


            // Fetch the IP addresses
            $ip_v6_address = $_SERVER['REMOTE_ADDR'];
            $ip_v4_address = $client_ip;

            // Determine the logged-in device (Mobile or Laptop)
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $loggedin_device = (preg_match('/mobile/i', $user_agent)) ? 'Mobile' : 'Laptop';

            // Fetch location details
            $location_details = fetchLocationDetails($ip_v4_address);

            // Set timezone to Asia/Kolkata in PHP and get the current login time
            date_default_timezone_set('Asia/Kolkata');
            $login_time = date("Y-m-d H:i:s");

            // Insert login details into login_history table
            $insert_history_sql = "INSERT INTO login_history (emp_id, emp_tbl_id, ip_v6_address, ip_v4_address, loggedin_device, location_details, login_time)
                                            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_history_sql);
            $stmt->bind_param("sisssss", $emp_id, $emp_tbl_id, $ip_v6_address, $ip_v4_address, $loggedin_device, $location_details, $login_time);
            $stmt->execute();

            // Get the last inserted ID
            $login_history_id = $stmt->insert_id;

            // Store the login history ID in the session
            $_SESSION["login_history_id"] = $login_history_id;

            // Redirect the user to index.php
            echo "<script>window.location.href='index.php';</script>";
         } else {
            echo "Invalid password. Please try again.";
         }
      } else {
         echo "User not found. Please register if you don't have an account.";
      }

      $stmt->close();
      $conn->close();
   }

   /**
    * Fetch location details (city, region, country, lat, long) based on IP address using ip-api.com API.
    * @param string $ip
    * @return string Location details
    */
   function fetchLocationDetails($ip)
   {
      $api_url = "http://ip-api.com/json/$ip";
      $response = file_get_contents($api_url);
      $data = json_decode($response, true);

      if ($data && $data['status'] == 'success') {
         $city = $data['city'];
         $region = $data['regionName'];
         $country = $data['country'];
         $lat = $data['lat'];
         $lon = $data['lon'];

         return "City: $city, Region: $region, Country: $country, Lat: $lat, Lon: $lon";
      } else {
         return "Location details not available";
      }
   }
   ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"></script>
   <script src="assets/js/scripts.js"></script>
   <!-- for password hide and show -->
   <script>
      function togglePassword() {
         const passwordInput = document.getElementById('inputPassword');
         const eyeIcon = document.getElementById('eyeIcon');

         if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
         } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
         }
      }
   </script>
</body>

</html>
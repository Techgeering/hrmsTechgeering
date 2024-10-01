<?php
include 'common/conn.php'; // Ensure this path is correct
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the time zone to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');

// Capture the current time for logout
$logout_time = date("Y-m-d H:i:s");
unset($_SESSION["username"]);
unset($_SESSION["em_role"]);
unset($_SESSION["emp_id"]);

// Clear cookies
setcookie('remember_username', '', time() - 3600, "/");
setcookie('em_role', '', time() - 3600, "/");
setcookie('emp_id', '', time() - 3600, "/");
// Ensure the login history ID is available in the session
if (!isset($_SESSION['login_history_id'])) {
    die('Login history ID not set in session.');
}

// Get the login history ID
$login_history_id = $_SESSION['login_history_id'];

// Fetch the login_time from the login_history table
$select_sql = "SELECT login_time FROM login_history WHERE id = ?";
$stmt = $conn->prepare($select_sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $login_history_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $login_time = $row['login_time'];

    // Calculate the session duration
    $login_timestamp = strtotime($login_time);
    $logout_timestamp = strtotime($logout_time);
    $duration_seconds = $logout_timestamp - $login_timestamp;

    // Format duration in hours, minutes, and seconds
    $duration_hours = floor($duration_seconds / 3600);
    $duration_minutes = floor(($duration_seconds % 3600) / 60);
    $duration_seconds = $duration_seconds % 60; // Get the remaining seconds
    $session_duration = sprintf('%02d:%02d:%02d', $duration_hours, $duration_minutes, $duration_seconds);

    // Update the logout time and session duration in the login_history table
    $update_sql = "UPDATE login_history SET logout_time = ?, session_duration = ? WHERE id = ? AND logout_time IS NULL";
    $stmt = $conn->prepare($update_sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssi", $logout_time, $session_duration, $login_history_id);

    if ($stmt->execute()) {
        // Unset the session user variable
        unset($_SESSION["username"]); // Make sure the session variable name is correct
        unset($_SESSION["login_history_id"]); // Clear the login history ID from the session

        // Redirect to login page
        echo "<script>
    localStorage.clear();
    sessionStorage.clear(); // Optional, in case you want to clear sessionStorage too
    window.location.href = 'login.php'; // Redirect to login or another page
</script>";
    } else {
        // Handle update failure
        echo 'Error updating logout time: ' . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo 'Login time not found for the given login history ID.';
}

$conn->close();
?>
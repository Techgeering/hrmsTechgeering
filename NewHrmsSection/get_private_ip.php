<?php
header('Content-Type: application/json');

// Function to get private IP address
function getPrivateIpAddress() {
    // Try to get the IP address from various sources
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // X-Forwarded-For header might contain the private IP address
        $ipArray = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipArray[0]);
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        // Client IP might be set by some proxy servers
        return $_SERVER['HTTP_CLIENT_IP'];
    } else {
        // Fallback to REMOTE_ADDR
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Get the private IP address
$privateIp = getPrivateIpAddress();

// Return the IP address as JSON
echo json_encode(['privateIp' => $privateIp]);
?>

<?php
include "common/conn.php";

if (isset($_POST['pro_name'])) {
    $pro_name = $_POST['pro_name'];

    // Sanitize input to avoid SQL injection
    $pro_name = mysqli_real_escape_string($conn, $pro_name);

    $projects = [];

    // Custom logic for "Internship" and "Loan"
    if (strcasecmp($pro_name, 'Other') === 0) {
        $projects[] = ['id' => '-0', 'pro_name' => 'Other'];
    } else {
        // Query to fetch project details using LIKE for partial matches
        $sql = "SELECT id, pro_name FROM project WHERE pro_name LIKE '%$pro_name%'";
        $result = mysqli_query($conn, $sql);

        // Fetch project data
        if ($result && mysqli_num_rows($result) > 0) {
            while ($project = mysqli_fetch_assoc($result)) {
                $projects[] = $project;
            }
        }
    }

    // Return project data in JSON format
    echo json_encode($projects);
}
?>
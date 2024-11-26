<?php
include "common/conn.php";
$dept_id = $_POST["dept_id"]; // Ensure this matches the AJAX key
$result = mysqli_query($conn, "SELECT * FROM designation WHERE dept_id = '$dept_id'");
?>
<option value="">Select Designation</option> <!-- Updated placeholder text -->
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["des_name"]; ?></option>
    <?php
}
?>
<?php
include 'conn.php';
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    unset($_SESSION["user"]);
    ?>
    <script>
        window.location.href = 'login.php';
    </script>
</body>

</html>
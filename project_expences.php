<?php
include "common/conn.php";

// Fetch form data
$project_name = $_POST['project_name'];
$Project_Details = $_POST['Project_Details'];
$taxtype = $_POST["taxtype"];
$gst = $_POST['gst'];
$assigned_users = $_POST['assigned_users'];
$Date = $_POST['Date'];
$Amount = $_POST['Amount'];
$deposit = $_POST["deposite1"];
$withdraw = $_POST["withdrawl1"];

if ($taxtype == 'GST' || $taxtype == 'NONGST') {
    $current_balance_T;
    $current_balance;
    $current_balance_WT;

    $balance_query = "SELECT balance_T FROM account WHERE balance_T!='' ORDER BY id DESC LIMIT 1";
    $balance_result = $conn->query($balance_query);
    if ($balance_result->num_rows > 0) {
        $row = $balance_result->fetch_assoc();
        $current_balance_T = $row["balance_T"];
    } else {
        $current_balance_T = 0;
    }
    $balance_query1 = "SELECT balance FROM account ORDER BY id DESC LIMIT 1";
    $balance_result1 = $conn->query($balance_query1);
    if ($balance_result1->num_rows > 0) {
        $row1 = $balance_result1->fetch_assoc();
        $current_balance = $row1["balance"];
    } else {
        $current_balance = 0;
    }
    $balance_query2 = "SELECT balance_WT FROM account WHERE balance_WT!='' ORDER BY id DESC LIMIT 1";
    $balance_result2 = $conn->query($balance_query2);
    if ($balance_result2->num_rows > 0) {
        $row2 = $balance_result2->fetch_assoc();
        $current_balance_WT = $row2["balance_WT"];
    } else {
        $current_balance_WT = 0;
    }

    if ($taxtype == 'GST') {
        if (!empty($deposit)) {
            $current_balance = (float) $current_balance + (float) $deposit;
            $current_balance_T = (float) $current_balance_T + (float) $deposit;
            $current_balance_WT = (float) $current_balance_WT;
        } elseif (!empty($withdraw)) {
            $current_balance = (float) $current_balance - (float) $withdraw;
            $current_balance_T = (float) $current_balance_T - (float) $withdraw;
            $current_balance_WT = (float) $current_balance_WT;
        }
    } else {
        if (!empty($deposit)) {
            $current_balance = (float) $current_balance + (float) $deposit;
            $current_balance_T = (float) $current_balance_T;
            $current_balance_WT = (float) $current_balance_WT + (float) $deposit;
        } elseif (!empty($withdraw)) {
            $current_balance = (float) $current_balance - (float) $withdraw;
            $current_balance_T = (float) $current_balance_T;
            $current_balance_WT = (float) $current_balance_WT - (float) $withdraw;
        }
    }
} else {
    $current_balance;
    $balance_query1 = "SELECT balance FROM pro_expenses ORDER BY id DESC LIMIT 1";
    $balance_result1 = $conn->query($balance_query1);
    if ($balance_result1->num_rows > 0) {
        $row1 = $balance_result1->fetch_assoc();
        $current_balance = $row1["balance"];
    } else {
        $current_balance = 0;
    }

    if (!empty($deposit)) {
        $current_balance = (float) $current_balance + (float) $deposit;
    } elseif (!empty($withdraw)) {
        $current_balance = (float) $current_balance - (float) $withdraw;
    }
}

if ($taxtype == 'GST') {
    $sql = "INSERT INTO account (pro_id, assign_to, particulars, tex_type, gst, deposite, withdraw, balance, balance_T, balance_WT, date) 
            VALUES ('$project_name','$assigned_users','$Project_Details', 'GST', '$gst', '$deposit', '$withdraw', '$current_balance', '$current_balance_T', '', '$Date')";
} elseif ($taxtype == 'NONGST') {
    $sql = "INSERT INTO account (pro_id, assign_to, particulars, tex_type, deposite, withdraw, balance, balance_T, balance_WT, date) 
            VALUES ('$project_name','$assigned_users','$Project_Details', 'NONGST', '$deposit', '$withdraw', '$current_balance', '', '$current_balance_WT', '$Date')";
    // } else {
//     $sql = "INSERT INTO pro_expenses (pro_id, assign_to, details, tex_type, gst, deposite, withdraw, balance, date) 
//             VALUES ('$project_name','$assigned_users','$Project_Details', 'WithoutAdding', '$gst', '$deposit', '$withdraw', '$current_balance', '$Date')";
// }
} else {
    $sql = "INSERT INTO pro_expenses (pro_id, assign_to, particulars, tex_type, gst, deposite, withdraw, balance, date) 
            VALUES ('$project_name','$assigned_users','$Project_Details', 'WithoutAdding', '$gst', '$deposit', '$withdraw', '$current_balance', '$Date')";
}
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
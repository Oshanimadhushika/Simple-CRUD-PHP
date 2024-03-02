<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

    require_once "database.php";

    $checkSql = "SELECT * FROM customers WHERE id=?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $deleteSql = "DELETE FROM customers WHERE id=?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            echo '<script>alert("Customer deleted successfully.");</script>';
        } else {
            echo '<script>alert("Error deleting record: ' . $deleteStmt->error . '");</script>';
        }

        $deleteStmt->close();
    } else {
        echo '<script>alert("Customer not found.");</script>';
    }

    $checkStmt->close();
}

header("location: customer_details.php");
exit;

?>

<?php
// get_usernames.php

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["branch"])) {
    $selectedBranch = $_GET["branch"];
    
    $usernameQuery = "SELECT user_name FROM users WHERE branch = '$selectedBranch'";
    $usernameResult = $conn->query($usernameQuery);

    $usernames = [];

    while ($row = $usernameResult->fetch_assoc()) {
        $usernames[] = $row['user_name'];
    }

    echo json_encode($usernames);
} else {
    http_response_code(400);
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>

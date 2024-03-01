<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>customer register</title>
</head>
<body>
<div class="container">
      

        <h3>Customer <span class="text-warning">Register</span></h3>

        <form action="process_customer_registration.php" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="datepicker" class="form-label">Date:</label>
                <input type="date" class="form-control" id="datepicker" name="datepicker" required>
            </div>

            <div class="mb-3">
                <label for="registerNo" class="form-label">Register No:</label>
                <input type="text" class="form-control" id="registerNo" name="registerNo" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>
        </div>
    </div>


    <div class="mb-3">
        <label for="submit" class="form-label"></label>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary">Cancel</button>
    </div>
</form>


       
        <!-- <a href="logout.php" class="btn btn-warning logout-btn">Logout</a> -->
    </div>
</body>
</html>
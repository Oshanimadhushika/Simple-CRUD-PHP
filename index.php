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
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title> Dashboard</title>


    <style>
    body{
    padding:10px;
    width: 100%;
    }
/* .container{
    max-width: 90%;
    margin:0 auto;
    padding:20px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
} */
.form-group{
    margin-bottom:30px;
}  
    .custom-link {
        text-decoration: none;
        color: #d4a017; 
        font-weight: bold;
        transition: color 0.3s;
        padding-right: 5%;
    }

    .custom-link:hover {
        color: #007bff; 
    }

    
</style>
</head>
<body>
<div class="container-dash" style="width: 95%;">
<div class="row">
            <div class="col-md-5">
                <h1>Welcome to the <span class="text-warning">Dashboard</span></h1>
                <div id="content-container"></div>
            </div>
            <div class="col-md-7 d-flex justify-content-end">
                <a  href="customer_register.php"  class="custom-link">Customer Register</a>
                <a class="custom-link">Details</a>

                <a class="custom-link">Item Master</a>
                <a href="logout.php" class="btn btn-warning font-weight-bold px-4 py-2 ">Logout</a>

            </div>
        </div>

        <div id="customer-Register-container" style="margin-top: 20px;"></div>


    </div>

    <script>
            loadContent('customer_register.php');

            function loadContent(page) {
                var contentContainer = document.getElementById('customer-Register-container');
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        contentContainer.innerHTML = xhr.responseText;
                    }
                };

                xhr.open('GET', page, true);
                xhr.send();
            }
        </script>
</body>
</html>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-Vh+0+KTDuX6+MuOYmth1VZy7sPnN0vBLCQ/k0vl4o6NDOD0vq5C+5IExxm/pxm+UEFy9RVMTqVp1bkTfCdP6aQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" href="style.css"> -->
    <title> Dashboard</title>


    <style>
        body {
            padding: 10px;
            width: 100%;
        }

        /* .container{
    max-width: 90%;
    margin:0 auto;
    padding:20px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
} */
        .form-group {
            margin-bottom: 30px;
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

        .custom-col {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: color 0.3s;
            padding-right: 5%;
        }

        .custom-col:hover {
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
                <a href="customer_register.php" class="custom-link">Customer Register</a>
                <a class="custom-link" href="customer_details.php">Details</a>

                <a class="custom-link">Item Master</a>
                <a href="logout.php" class="btn btn-warning font-weight-bold px-4 py-2 ">Logout</a>

            </div>
        </div>

        <div class="container mx-auto text-center ml-4" style="margin-top: 30px; margin-left: 20px;">
            <div class="row gap-2 ">

                <div class="col-md-4 shadow p-3 mb-5 mr-4 bg-white rounded ">
                    <a href="itemMaster.php" class=" custom-col">
                        <h3><i class="fas fa-cogs"></i> Item Master</h3>
                    </a>
                </div>

                <div  class="col-md-4 shadow p-3 mb-5  bg-white rounded " >
                <a href="customer_register.php" class=" custom-col">

                    <h3><i class="fas fa-cogs"></i> Customer Register</h3>
                </a>
                </div>


                <div class="col-md-3 shadow p-3 mb-5 bg-white rounded" >
                    <h3><i class="fas fa-cogs"></i> Balance Bill</h3>
                </div>

            </div>


            <div class="row gap-2 ">
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Good Received</h3>
                </div>
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Prescription Invoice</h3>
                </div>


                <div class="col-md-3 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Other Sales</h3>
                </div>

            </div>


            <div class="row gap-2">
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Visitors</h3>
                </div>
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Stock Adjust</h3>
                </div>


                <div class="col-md-3 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Expanse</h3>
                </div>

            </div>


            <div class="row gap-2 ">
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Job Status</h3>
                </div>
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Claim Bills</h3>
                </div>


                <div class="col-md-3 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Return</h3>
                </div>

            </div>


            <div class="row gap-2 ">
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> Setting</h3>
                </div>
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i>Bar Code</h3>
                </div>


                <div class="col-md-3 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i>Pen Backup </h3>
                </div>

            </div>

            <div class="row gap-2">
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i>Reports</h3>
                </div>
                <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i> LESSON Training</h3>
                </div>


                <div class="col-md-3 shadow p-3 mb-5 bg-white rounded">
                    <h3><i class="fas fa-cogs"></i>Exit</h3>
                </div>

            </div>
        </div>


    </div>

    <!-- <script>
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
        </script> -->
</body>

</html>
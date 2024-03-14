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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- <link rel="stylesheet" href="style.css"> -->
    <title> Dashboard</title>


    <style>
        body {
            padding: 10px;
            width: 100%;
        }


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

        .dashboard {
            display: flex;
            height: 100vh;
        }

        /* .sidebar {
            width: 250px;
            background-color: #1A1A1D;
            color: #D4D4D2;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            position: fixed;
            height: 100%;
        } */

        /* .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #E5E5E5;
            flex: 1;
        }

        .sidebar a {
            color: #D4D4D2;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #343537;
        } */

        .main-content {
            margin-left: 250px;
            padding: 20px;
            /* background-color: #E5E5E5; */
            flex: 1;
            position: relative;
            margin-bottom: 100px;
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            left: 0;
            top: 60px;
            height: 100%;
            overflow-y: auto;
        }

        .logout-btn {
            background-color: #DC3545;
            border: none;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #C82333;
        }

        .list-unstyled {
            padding: 10px;
            list-style-type: none;
            margin-bottom: 10px;
        }

        .list-unstyled li {
            padding: 10px 0;
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .list-unstyled li i {
            margin-right: 10px;
        }

        .list-unstyled li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: color 0.3s;
            display: block;
            /* padding: 10px; */
        }

        .list-unstyled li a:hover {
            color: #007bff;
        }

        .sub-list {
            display: none;
        }

        .sub-list.show {
            display: block;
        }

        .content-container {
            margin: 100px auto;
            padding: 20px;
            position: relative;
            background-color: red;
            width: 80%;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }


        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
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

            <!-- <div class="col-md-7 d-flex justify-content-end">
                <a href="customer_register.php" class="custom-link">Customer Register</a>
                <a class="custom-link" href="customer_details.php">Details</a>

                <a class="custom-link">Item Master</a>
                <a href="logout.php" class="btn btn-warning font-weight-bold px-4 py-2 ">Logout</a>
            </div> -->

        </div>



        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-4">
                <div class="main-content">
                    <div class="card">
                        <ul class="list-unstyled">
                            <li class="dropdown">
                                <a href="#" id="adminDropdown">
                                    <i class="fas fa-cogs"></i> Admin
                                    <i class="fas fa-chevron-down dropdown-icon"></i>
                                </a>
                                <ul class="list-unstyled sub-list">
                                    <li><a href="branch.php">Add Branch</a></li>
                                    <li><a href="registration.php">Add Users</a></li>
                                </ul>
                            </li>
                            <li><a href="customer_register.php"><i class="fas fa-cogs"></i> Customer Register</a></li>
                            <li><a href="itemMaster.php"><i class="fas fa-cogs"></i> Item Master</a></li>
                            <li><a href="balance_bill.php"><i class="fas fa-cogs"></i> Balance Bill</a></li>
                            <li><a href="good_received.php"><i class="fas fa-cogs"></i> Good Received</a></li>
                            <li><a href="prescription_invoice.php"><i class="fas fa-cogs"></i> Prescription Invoice</a>
                            </li>
                            <li><a href="other_sales.php"><i class="fas fa-cogs"></i> Other Sales</a></li>
                            <li><a href="visitors.php"><i class="fas fa-cogs"></i> Visitors</a></li>
                            <li><a href="stock_adjust.php"><i class="fas fa-cogs"></i> Stock Adjust</a></li>
                            <li><a href="expense.php"><i class="fas fa-cogs"></i> Expense</a></li>
                            <li><a href="job_status.php"><i class="fas fa-cogs"></i> Job Status</a></li>
                            <li><a href="claim_bills.php"><i class="fas fa-cogs"></i> Claim Bills</a></li>
                            <li><a href="return.php"><i class="fas fa-cogs"></i> Return</a></li>
                            <li><a href="setting.php"><i class="fas fa-cogs"></i> Setting</a></li>
                            <li><a href="barcode.php"><i class="fas fa-cogs"></i> Bar Code</a></li>
                            <li><a href="pen_backup.php"><i class="fas fa-cogs"></i> Pen Backup</a></li>
                            <li><a href="reports.php"><i class="fas fa-cogs"></i> Reports</a></li>
                            <li><a href="lesson_training.php"><i class="fas fa-cogs"></i> LESSON Training</a></li>
                            <li><a href="exit.php"><i class="fas fa-cogs"></i> Exit</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content Column -->
            <div class="col-md-8">
                <div class="content-container" id="content-container">
                </div>
            </div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-d7sMXVnI0PpLXRqJ4qOjxmF/j6tZ6tqWp5ysqO3F5e/ZzmI5gkd6j9YXa0FJ/7G3"
        crossorigin="anonymous"></script>

        <script>
    $(document).ready(function () {
        var adminDropdown = $('#adminDropdown');
        var subList = adminDropdown.next();
        var contentContainer = $('#content-container');

        adminDropdown.on('click', function () {
            subList.toggleClass('show');
        });

        // Load initial content
        // loadContent('customer_register.php');

        // Function to load content dynamically
        function loadContent(page) {
            $.ajax({
                url: page,
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                    contentContainer.html(data);
                },
                error: function (xhr, status, error) {
                    console.error('Error loading content:', error);
                }
            });
        }

        // Handle sidebar item clicks
        $('.list-unstyled li a').on('click', function (event) {
            event.preventDefault();
            var page = $(this).attr('href');
            loadContent(page);
        });
    });
</script>


</body>

</html>
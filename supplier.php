<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>supplier master</title>

    <style>
        body {
            padding: 10px;
            width: 100%;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 25px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 70%;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php

        if (isset ($_POST["submit"])) {
            $date = $_POST["date"];
            $code = $_POST["code"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            $teleMobile = $_POST["teleMobile"];
            $teleLand = $_POST["teleLand"];
            $email = $_POST["email"];
            $accNum = $_POST["accNum"];
            $refName = $_POST["refName"];
            $refMobile = $_POST["refMobile"];

            $errors = array();

            if (empty ($date) || empty ($code) || empty ($name) || empty ($address) || empty ($teleMobile || empty ($teleLand) || empty ($email) || empty ($accNum) || empty ($refName) || empty ($refMobile))) {
                array_push($errors, "All fields are required");
            }




            require_once "database.php";
            $sql = "INSERT INTO supplier (date, code, name, address, teleMobile, teleLand, email, bankAccNo,refName, refMobile) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($stmt) {
                $stmt->bind_param("ssssssssss", $date, $code, $name, $address, $teleMobile, $teleLand, $email, $accNum, $refName, $refMobile);
                if ($stmt->execute()) {
                    echo '<script>alert("Supplier added successfully.");</script>';
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }

        }







        ?>









        <div class="row mb-2">

            <div class="col-md-6">
                <h3>Supplier <span class="text-warning">Master</span></h3>
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" id="search" placeholder="Search...">
            </div>
        </div>

        <!-- ======================================================================================================== -->
        <form id="supplierMasterForm" action="supplier.php" method="post">
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code:</label>
                        <input type="text" class="form-control" id="code" name="code">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>



            </div>



            <div class="row mt-2">


                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input class="form-control" id="address" name="address"></input>

                    </div>
                </div>

            </div>

            <div class="row mt-2">


                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="teleMobile" class="form-label">Telephone (Mobile):</label>
                        <input type="tel" class="form-control" id="teleMobile" name="teleMobile">
                    </div>

                </div>

                <!-- ======================================================== -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="teleLand" class="form-label">Telephone (Land):</label>
                        <input type="tel" class="form-control" id="teleLand" name="teleLand">
                    </div>

                </div>

                <!-- ================================================================== -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>

                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="accNum" class="form-label">Bank Account No:</label>
                        <input type="text" class="form-control" id="accNum" name="accNum">
                    </div>


                </div>

            </div>

            <div class="row mt-2">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="refName" class="form-label">Ref Name:</label>
                        <input type="text" class="form-control" id="refName" name="refName">
                    </div>



                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="refMobile" class="form-label">Ref Phone No:</label>
                        <input type="text" class="form-control" id="refMobile" name="refMobile">
                    </div>


                </div>


            </div>




            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="mb-3 d-flex justify-content-end gap-3">
                        <label for="submit" class="form-label"></label>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="clearForm()">Cancel</button>

                        <a href="index.php" class="btn btn-warning font-weight-bold px-4 py-2 ">Back</a>

                    </div>
                </div>
            </div>
        </form>
        <!-- ======================================================================================================== -->






























    </div>

    <script>
        function clearForm() {
            document.getElementById("customerRegistrationForm").reset();
        }
    </script>

</body>

</html>
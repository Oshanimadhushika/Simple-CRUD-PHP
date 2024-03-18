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
    <title>item master</title>

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

        if (isset($_POST["submit"])) {
            $itemCode = $_POST["itemCode"];
            $barcode = $_POST["barcode"];
            $description = $_POST["description"];
            $department = $_POST["department"];
            $category = $_POST["category"];
            $supplier = $_POST["supplier"];
            $cost = $_POST["cost"];
            $profit = $_POST["profit"];
            $salesPrice = $_POST["salesPrice"];
            $discountRs = $_POST["discountRs"];
            $wholesale = $_POST["wholesale"];
            $location = $_POST["location"];
            $maxStockQty = $_POST["maxStockQty"];
            $minStockQty = $_POST["minStockQty"];

            $errors = array();

            if (empty($itemCode) || empty($description) || empty($department) || empty($cost) || empty($salesPrice)) {
                array_push($errors, "All fields are required");
            }




            require_once "database.php";
            $sql = "INSERT INTO item (item_code, barcode, description, department, category, supplier, cost, profit, sale_price, discount, wholesale, location, max_qty, min_qty) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($stmt) {
                $stmt->bind_param("ssssssssssssss", $itemCode, $barcode, $description, $department, $category, $supplier, $cost, $profit, $salesPrice, $discountRs, $wholesale, $location, $maxStockQty, $minStockQty);
                if ($stmt->execute()) {
                    echo '<script>alert("Item added successfully.");</script>';
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }

        }





        require_once "database.php";

        $sql_department = "SELECT description FROM department";
        $result_department = mysqli_query($conn, $sql_department);
        $departments = mysqli_fetch_all($result_department, MYSQLI_ASSOC);

        $sql_category = "SELECT description FROM category";
        $result_category = mysqli_query($conn, $sql_category);
        $categories = mysqli_fetch_all($result_category, MYSQLI_ASSOC);

        $sql_supplier = "SELECT name FROM supplier";
        $result_supplier = mysqli_query($conn, $sql_supplier);
        $suppliers = mysqli_fetch_all($result_supplier, MYSQLI_ASSOC);

        mysqli_close($conn);

        ?>









        <div class="row mb-2">

            <div class="col-md-6">
                <h3>Item <span class="text-warning">Master</span></h3>
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" id="search" placeholder="Search...">
            </div>
        </div>

        <!-- ======================================================================================================== -->
        <form id="itemMasterForm" action="itemMaster.php" method="post">
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="itemCode" class="form-label">Item Code:</label>
                        <input type="text" class="form-control" id="itemCode" name="itemCode" required>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="barcode" class="form-label">Barcode:</label>
                        <input type="text" class="form-control" id="barcode" name="barcode">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                </div>



            </div>

            <div class="row mt-2">

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="department" class="form-label">Department:</label>
                        <select class="form-select" id="department" name="department">
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= $department['description'] ?>">
                                    <?= $department['description'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>



                <div class="col-md-4">



                    <div class="mb-3">
                        <label for="category" class="form-label">Category:</label>
                        <select class="form-select" id="category" name="category">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['description'] ?>">
                                    <?= $category['description'] ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>






                </div>

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier:</label>
                        <select class="form-select" id="supplier" name="supplier">
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?= $supplier['name'] ?>">
                                    <?= $supplier['name'] ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                </div>


            </div>

            <div class="row mt-2">





                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cost" class="form-label">Cost:</label>
                        <input type="number" class="form-control" id="cost" name="cost">
                    </div>



                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="profit" class="form-label">Profit:</label>
                        <input type="number" class="form-control" id="profit" name="profit">
                    </div>

                </div>

                <!-- ======================================================== -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="salesPrice" class="form-label">Sales Price (Cash):</label>
                        <input type="text" class="form-control" id="salesPrice" name="salesPrice">
                    </div>

                </div>

                <!-- ================================================================== -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="discountRs" class="form-label">Discount Rs:</label>
                        <input type="text" class="form-control" id="discountRs" name="discountRs">
                    </div>

                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="wholesale" class="form-label">Wholesale:</label>
                        <input type="text" class="form-control" id="wholesale" name="wholesale">
                    </div>


                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="location" class="form-label">Location:</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>



                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="maxStockQty" class="form-label">Maximum Stock Quantity:</label>
                        <input type="text" class="form-control" id="maxStockQty" name="maxStockQty">
                    </div>


                </div>

                <div class="col-md-3">

                    <div class="mb-3">
                        <label for="minStockQty" class="form-label">Minimum Stock Quantity:</label>
                        <input type="text" class="form-control" id="minStockQty" name="minStockQty">
                    </div>
                </div>
            </div>




            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="mb-3 d-flex justify-content-end gap-3">
                        <label for="submit" class="form-label"></label>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="clearForm()">Cancel</button>
                        <a href="customer_details.php" class="btn btn-danger font-weight-bold px-4 py-2 ">Details</a>

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
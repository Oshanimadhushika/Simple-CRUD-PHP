<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Category master</title>

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
            $categoryCode = $_POST["categoryCode"];
            $category = $_POST["category"];

            $errors = array();

            if (empty ($categoryCode) || empty ($category)) {
                array_push($errors, "All fields are required");
            }



            require_once "database.php";
            $sql = "INSERT INTO category (code, description) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($stmt) {
                $stmt->bind_param("ss", $categoryCode, $category);
                if ($stmt->execute()) {
                    echo '<script>alert("Category added successfully.");</script>';
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }

        }

        require_once "database.php";

        $sql_select = "SELECT * FROM category";
        $result = mysqli_query($conn, $sql_select);




        ?>






        <div class="row mb-2">

            <div class="col-md-6">
                <h3>Category <span class="text-warning">Master</span></h3>
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" id="search" placeholder="Search...">
            </div>
        </div>

        <!-- ======================================================================================================== -->
        <form id="categoryForm" action="category.php" method="post">
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="categoryCode" class="form-label"> Code:</label>
                        <input type="text" class="form-control" id="categoryCode" name="categoryCode" required>
                    </div>
                </div>







            </div>

            <div class="row mt-2">

                <div class="col-md-4">

                    <div class="mb-3">
                    <label for="category" class="form-label"> Category:</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                

                        </select>
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



        <table class="table table-bordered custom-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Category</th>

                    <!-- <th>Update</th>
                    <th>Delete</th> -->
                </tr>
            </thead>
            <tbody>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["code"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No categories found</td></tr>";
                }
                ?>
            </tbody>
        </table>









    </div>

    <script>
        function clearForm() {
            document.getElementById("customerRegistrationForm").reset();
        }
    </script>

</body>

</html>
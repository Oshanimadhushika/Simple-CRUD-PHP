
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- <style>
        body{
            position:absolute;
            text:cen
        }
    </style> -->
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $branch_name = $_POST["branch_name"];
            $branch_code = $_POST["branch_code"];
            $errors = array();

            if (empty($branch_name) or empty($branch_code)) {
                array_push($errors, "All fields are required");
            }

            require_once "database.php";

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {

                $sql = "INSERT INTO branch ( branch_code,name) VALUES ( ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $branch_code, $branch_name);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Branch Added successfully.</div>";
                } else {
                    die("Something went wrong");
                }
            }


        }
        ?>

        <div class="form-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="image-column">
                        <img src="asserts/loginImg2.jpg" alt="Image" style="width: 100%;">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-column">
                        <form action="branch.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="branch_code" placeholder="Branch Code:">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="branch_name" placeholder="Branch Name:">
                            </div>

                            <div class="form-btn">
                                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                            </div>
                        </form>
                        <!-- <div class="mt-3">
                            <p>Not registered yet <a href="registration.php" class="text-purple mt-2">Register Here</a>
                            </p>
                        </div> -->
                    </div>


                </div>
            </div>
        </div>



























    </div>
</body>

</html>
<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $user_name = $_POST["user_name"];
            $branch = $_POST["branch"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($user_name) or empty($branch) or empty($password) or empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            //    if (!filter_var($branch, FILTER_VALIDATE_EMAIL)) {
            //     array_push($errors, "Branch is not valid");
            //    }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 charactes long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match");
            }
            require_once "database.php";
            //    $sql = "SELECT * FROM users WHERE branch = '$branch'";
            //    $result = mysqli_query($conn, $sql);
            //    $rowCount = mysqli_num_rows($result);
            //    if ($rowCount>0) {
            //     array_push($errors,"Branch already exists!");
            //    }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {

                $sql = "INSERT INTO users (user_name, branch, password) VALUES ( ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $user_name, $branch, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
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

                    <div class="d-flex justify-content-end align-items-end mt-1">
                        <a href="branch.php" class=""><i class="fas fa-plus"></i> Add Branch</a>
                    </div>

                    <div class="form-column mt-3">
                        <form action="registration.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_name" placeholder="User Name:">
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch:</label>
                                <select class="form-control" name="branch" id="branch">
                                    <?php
                                    require_once "database.php";
                                    $sql = "SELECT name FROM branch";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                    }

                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password:">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="repeat_password"
                                    placeholder="Repeat Password:">
                            </div>
                            <div class="form-btn">
                                <input type="submit" class="btn btn-primary" value="Register" name="submit">
                            </div>
                        </form>
                        <div>
                            <div class="mt-3">
                                <p>Already Registered <a href="login.php">Login Here</a></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>



























    </div>
</body>

</html>
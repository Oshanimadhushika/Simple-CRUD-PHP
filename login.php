<?php
session_start();
require_once "database.php";

$branches = [];
$usernames = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBranch = $_POST["branch"];
    $selectedUsername = $_POST["userName"];
    $typedPassword = $_POST["password"];

    $sql = "SELECT * FROM users WHERE branch = '$selectedBranch' AND user_name = '$selectedUsername'";
    $result = $conn->query($sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($typedPassword, $user["password"])) {
            $_SESSION["user"] = "yes";
            header("Location: index.php");
            die();
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Username does not match</div>";
    }
}

$branchQuery = "SELECT DISTINCT branch FROM users";
$branchResult = $conn->query($branchQuery);

while ($row = $branchResult->fetch_assoc()) {
    $branches[] = $row['branch'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBranch = $_POST["branch"];

    $usernameQuery = "SELECT user_name FROM users WHERE branch = '$selectedBranch'";
    $usernameResult = $conn->query($usernameQuery);

    while ($row = $usernameResult->fetch_assoc()) {
        $usernames[] = $row['user_name'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $user_name = $_POST["user_name"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE user_name = '$user_name'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>User_Name does not match</div>";
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
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="branch">Select Branch:</label>
                        <select name="branch" id="branch" class="form-control">
                            <?php foreach ($branches as $branch): ?>
                                <option value="<?php echo $branch; ?>">
                                    <?php echo $branch; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="userName">Select Username:</label>
                        <select name="userName" id="userName" class="form-control">
                            <?php foreach ($usernames as $username): ?>
                                <option value="<?php echo $username; ?>">
                                    <?php echo $username; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-btn">
                        <input type="submit" value="Login" name="login" class="btn btn-primary" style="width=100%;">
                    </div>
                </form>
                <div class="mt-3">
                <p>Not registered yet <a href="registration.php" class="text-purple mt-2">Register Here</a></p>
                </div>
            </div>

           
        </div>
    </div>
</div>

    </div>

    <script>
        document.getElementById('branch').addEventListener('change', function () {
            var selectedBranch = this.value;
            var usernameDropdown = document.getElementById('userName');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var usernames = JSON.parse(xhr.responseText);
                    usernameDropdown.innerHTML = '';

                    usernames.forEach(function (username) {
                        var option = document.createElement('option');
                        option.value = username;
                        option.text = username;
                        usernameDropdown.appendChild(option);
                    });
                }
            };

            xhr.open('GET', 'get_usernames.php?branch=' + selectedBranch, true);
            xhr.send();
        });

    </script>
</body>

</html>

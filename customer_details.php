<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <style>
        .container{
            margin-top: 40px;
            margin-left: 30px;
        }
    .custom-table {
        margin-top: 20px; 
        /* margin-left: 10px; */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
</head>

<body>
    <div class="container">

    


    <div class="row">
            <div class="col-md-5">
                <h3>Customer <span class="text-warning">Details</span></h3>
                <div id="content-container"></div>
            </div>
            <div class="col-md-7 d-flex justify-content-end">
                
                <a href="index.php" class="btn btn-warning font-weight-bold px-4 py-2 ">Back</a>

            </div>
        </div>

        <table class="table table-bordered custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Register No</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Loyalty Barcode</th>
                    <th>Telephone (Mobile)</th>
                    <th>Telephone (Land)</th>
                    <th>NIC</th>
                    <th>DOB</th>
                    <th>Age</th>
                    <th>Occupation</th>
                    <th>Area</th>
                    <!-- <th>Family Details</th>
                    <th>Notes</th> -->
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "database.php";

                $sql = "SELECT * FROM customers";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["registerNo"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["address1"] . "</td>";
                        echo "<td>" . $row["loyaltyBarcode"] . "</td>";
                        echo "<td>" . $row["teleMobile"] . "</td>";
                        echo "<td>" . $row["teleLand"] . "</td>";
                        echo "<td>" . $row["nic"] . "</td>";
                        echo "<td>" . $row["dob"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>" . $row["occupation"] . "</td>";
                        echo "<td>" . $row["area"] . "</td>";
                        
                        echo "<td><a href='update_customer.php?id=" . $row["id"] . "' class='btn btn-primary'>Update</a></td>";
                        echo "<td><a href='delete_customer.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this customer?\");'>Delete</a></td>";
                       
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='17'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
       
    </div>
</body>

</html>

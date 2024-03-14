<?php
require_once "database.php";

if (isset($_POST['update'])) {
    $customer_id = $_POST['customer_id']; 

    $updatedDate = $_POST['datepicker'];
    $updatedRegisterNo = $_POST['registerNo'];
    $updatedName = $_POST['name'];
    $updatedLocation = $_POST['location'];
    $updatedAddress = $_POST['address'];
    $updatedLoyaltyBarcode = $_POST['loyaltyBarcode'];
    $updatedTeleMobile = $_POST['teleMobile'];
    $updatedTeleLand = $_POST['teleLand'];
    $updatedNIC = $_POST['nic'];
    $updatedDOB = $_POST['dob'];
    $updatedAge = $_POST['age'];
    $updatedOccupation = $_POST['occupation'];
    $updatedArea = $_POST['area'];
    $updatedFamilyDetails = $_POST['familyDetails'];
    $updatedNotes = $_POST['notes'];

    $updateSql = "UPDATE customers SET date=?, registerNo=?, name=?, location=?, address=?, loyaltyBarcode=?, teleMobile=?, teleLand=?, nic=?, dob=?, age=?, occupation=?, area=?, familyDetails=?, notes=? WHERE id=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssssssssssssii", $updatedDate, $updatedRegisterNo, $updatedName, $updatedLocation, $updatedAddress, $updatedLoyaltyBarcode, $updatedTeleMobile, $updatedTeleLand, $updatedNIC, $updatedDOB, $updatedAge, $updatedOccupation, $updatedArea, $updatedFamilyDetails, $updatedNotes, $customer_id);

    if ($updateStmt->execute()) {
        echo '<script>alert("Customer Detail Update successfully.");</script>';
        header("Location:customer_details.php");
        exit();
    } else {
        echo "Error updating record: " . $updateStmt->error;
    }

    $updateStmt->close();
} elseif (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid customer ID";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h3>Update <span class="text-warning">Customer</span></h3>

        <form action="update_customer.php" method="post">
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="datepicker" class="form-label">Date:</label>
                        <input type="date" class="form-control" id="datepicker" name="datepicker" value="<?php echo isset($customer['date']) ? $customer['date'] : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="loyaltyBarcode" class="form-label">Loyalty Barcode:</label>
                        <input type="text" class="form-control" id="loyaltyBarcode" name="loyaltyBarcode" value="<?php echo isset($customer['loyaltyBarcode']) ? $customer['loyaltyBarcode'] : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="registerNo" class="form-label">Register No:</label>
                        <input type="text" class="form-control" id="registerNo" name="registerNo" value="<?php echo isset($customer['registerNo']) ? $customer['registerNo'] : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($customer['name']) ? $customer['name'] : ''; ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="location" class="form-label">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo isset($customer['location']) ? $customer['location'] : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required><?php echo isset($customer['address']) ? $customer['address'] : ''; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="teleMobile" class="form-label">Telephone (Mobile):</label>
                        <input type="tel" class="form-control" id="teleMobile" name="teleMobile" value="<?php echo isset($customer['teleMobile']) ? $customer['teleMobile'] : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="teleLand" class="form-label">Telephone (Land):</label>
                        <input type="tel" class="form-control" id="teleLand" name="teleLand" value="<?php echo isset($customer['teleLand']) ? $customer['teleLand'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="nic" class="form-label">NIC:</label>
                        <input type="text" class="form-control" id="nic" name="nic" value="<?php echo isset($customer['nic']) ? $customer['nic'] : ''; ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="dob" class="form-label">DOB:</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo isset($customer['dob']) ? $customer['dob'] : ''; ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="age" class="form-label">Age (Years):</label>
                        <input type="text" class="form-control" id="age" name="age" value="<?php echo isset($customer['age']) ? $customer['age'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="occupation" class="form-label">Occupation:</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo isset($customer['occupation']) ? $customer['occupation'] : ''; ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="area" class="form-label">Area:</label>
                        <select class="form-control" id="area" name="area">
                            <option <?php echo (isset($customer['area']) && $customer['area'] == 'Main Street') ? 'selected' : ''; ?>>Main Street</option>
                            <option <?php echo (isset($customer['area']) && $customer['area'] == 'City Center') ? 'selected' : ''; ?>>City Center</option>
                            <option <?php echo (isset($customer['area']) && $customer['area'] == 'Suburban Area') ? 'selected' : ''; ?>>Suburban Area</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="familyDetails" class="form-label">Family Details:</label>
                        <textarea class="form-control" id="familyDetails" name="familyDetails" rows="3"><?php echo isset($customer['familyDetails']) ? $customer['familyDetails'] : ''; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes:</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo isset($customer['notes']) ? $customer['notes'] : ''; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3 d-flex justify-content-end gap-3">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                        <a href="customer_details.php" class="btn btn-warning font-weight-bold px-4 py-2">Back</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

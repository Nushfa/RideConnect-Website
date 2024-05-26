<?php
include 'connect.php';
include 'nav.php';
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to be logged in to view this page!');location.href='login.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "rideconnect");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute INSERT query for post_ads table
    $sql = "INSERT INTO post_ads (vehicle_type, `condition`, brand, model, `manufactured_year`, price, leasing, fuel_type, engine_capacity, mileage, ac, power_steering, power_mirror, power_window, specific_info) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssisssiiiis", $vehicleType, $condition, $brand, $model, $year, $price, $leasing, $fuelType, $engineCapacity, $mileage, $ac, $powerSteering, $powerMirror, $powerWindow, $specificInfo);

    // Retrieve form data
    $vehicleType = $_POST["vehicleType"] ?? '';
    $condition = $_POST["condition"] ?? '';
    $brand = $_POST["brand"] ?? '';
    $model = $_POST["model"] ?? '';
    $year = $_POST["year"] ?? '';
    $price = $_POST["price"] ?? '';
    $leasing = isset($_POST["leasing"]) ? 1 : 0;
    $fuelType = $_POST["fuelType"] ?? '';
    $engineCapacity = $_POST["engineCapacity"] ?? '';
    $mileage = $_POST["mileage"] ?? '';
    $ac = isset($_POST["ac"]) ? 1 : 0;
    $powerSteering = isset($_POST["powerSteering"]) ? 1 : 0;
    $powerMirror = isset($_POST["powerMirror"]) ? 1 : 0;
    $powerWindow = isset($_POST["powerWindow"]) ? 1 : 0;
    $specificInfo = $_POST["specificInfo"] ?? '';

    // Execute the statement
    if ($stmt->execute()) {
        $lastInsertedId = $conn->insert_id;

        // Move uploaded images to the uploads directory and update the database with their paths
        $uploadDir = "uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Iterate over each uploaded file
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $targetFile = $uploadDir . uniqid() . "_" . basename($_FILES['images']['name'][$key]);
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
                $sql = "INSERT INTO postads_img (adId, image_path) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $lastInsertedId, $targetFile);
                $stmt->execute();
            } else {
                echo "Error uploading file: " . $_FILES['images']['name'][$key];
            }
        }

        // Close the statement
        $stmt->close();
        
        // Close database connection
        $conn->close();?>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Vehicle Added Successfully!',
                        text: 'You will be redirected to the cart page.!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'Cart.php';
                        }
                    });
                });
                </script>
                 <?php
            } else {
                ?>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'here was an error adding the product. Please try again.!',
                        confirmButtonText: 'OK'
                    });
                });
                </script>
                <?php
            }
        }
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/reg.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Add Product</title>
</head>

<body style="background-image: url(images/bg1.jpg);">
     <!-- Add Product Section -->
     <div class="container" style="width: fit-content;text-align: center;margin-top:120px;margin-bottom:120px;height:fit-content;background-color:white;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);border-radius:5px;">
        <!-- Add Product Card Section -->
        <div class="card">
            <form action="" method="POST" enctype="multipart/form-data" class="">
                <h3>Post Your Vehicle Ad</h3>
                <div class="form-group">
                    <input type="hidden" id="adId" name="adId">
                    <label style="font-weight:bold;" for="vehicleType">Vehicle Type:</label>
                    <input type="text" id="vehicleType" name="vehicleType" class="box" required>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="condition">Condition:</label>
                    <select id="condition" name="condition" class="box" required>
                        <option value="" disabled selected>Select Condition</option>
                        <option value="new">New</option>
                        <option value="used">Used</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="brand">Brand:</label>
                    <input type="text" id="brand" name="brand" class="box" required>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="model">Model:</label>
                    <input type="text" id="model" name="model" class="box" required>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="year">Manufactured Year:</label>
                    <input type="number" id="year" name="year" class="box" min="1900" max="9999" required>
                </div>
        
                <div class="form-group">
                    <label  style="font-weight:bold;"for="price">Price:</label>
                    <input type="number" id="price" name="price" class="box" min="0" required>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="leasing">Leasing Option:</label>
                    <input type="checkbox" id="leasing" name="leasing">
                </div>
        
                <div class="form-group">
                    <label  style="font-weight:bold;"for="fuelType">Fuel Type:</label>
                    <select id="fuelType" name="fuelType" class="box" required>
                        <option value="" disabled selected>Select Fuel Type</option>
                        <option value="petrol">Petrol</option>
                        <option value="diesel">Diesel</option>
                        <option value="electric">Electric</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="engineCapacity">Engine Capacity:</label>
                    <input type="text" id="engineCapacity" name="engineCapacity" class="box">
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="mileage">Mileage:</label>
                    <input type="number" id="mileage" name="mileage" class="box">
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;">Options:</label><br>
                    <input type="checkbox" id="ac" name="ac">
                    <label for="ac">AC</label><br>
                    <input type="checkbox" id="powerSteering" name="powerSteering">
                    <label for="powerSteering">Power Steering</label><br>
                    <input type="checkbox" id="powerMirror" name="powerMirror">
                    <label for="powerMirror">Power Mirror</label><br>
                    <input type="checkbox" id="powerWindow" name="powerWindow">
                    <label for="powerWindow">Power Window</label>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="specificInfo">Specific Info:</label><br>
                    <textarea id="specificInfo" name="specificInfo" class="box" rows="4" cols="50"></textarea>
                </div>
        
                <div class="form-group">
                    <label style="font-weight:bold;" for="image">Upload Image:</label><br>
                    <input type="file" name="images[]" multiple accept="image/*">
                </div>
        
                <div class="form-group">
                    <input type="submit" value="Add Vehicle" class="btn">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>

<?php
include 'footer.php'; // Include your footer file
?>

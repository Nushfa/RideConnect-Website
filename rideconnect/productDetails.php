<?php

// Include necessary files
include 'connect.php';
include 'nav.php';
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set timezone
date_default_timezone_set("Asia/Colombo");
$time = date("d/m/y h:i:sa");

// Check if the product ID is set
if (!isset($_GET['_id'])) {
    echo "Product ID is not set.";
    exit();
}

// Get the product ID
$id = $_GET['_id'];

// SQL query to select the product details
$sql = "SELECT post_ads.*, postads_img.image_path 
        FROM post_ads 
        INNER JOIN postads_img 
        ON post_ads.id = postads_img.adId 
        WHERE post_ads.id = ?";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query executed successfully and fetch the row
if ($result && $row = $result->fetch_assoc()) {
    // Check if the form is submitted
    if (isset($_POST['submit_vehicle'])) {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo "<script>alert('Please login first');location.href='login.php';</script>";
            exit();
        } else {
            // Get user information from session
            $uId = $_SESSION['user_id'];
            $uEmail = $_SESSION['user_email'];
            $uPhone = $_SESSION['user_phone'];
            $carName = $row['vehicle_type'];
            $carPrice = $row['price'];

            // Insert order into order_vehicles table
            $sqlInsert = "INSERT INTO order_vehicles (user_id, email, phone, vehicle_id, vehicle_name, vehicle_price, time) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("ississs", $uId, $uEmail, $uPhone, $id, $carName, $carPrice, $time);
            $resultIns = $stmtInsert->execute();

            // Check if insertion was successful
            if ($resultIns) {
                // If insertion is successful, hide the records from both tables
                $sqlHidePostAds = "UPDATE post_ads SET hidden = 1 WHERE id = ?";
                $stmtHidePostAds = $conn->prepare($sqlHidePostAds);
                $stmtHidePostAds->bind_param("i", $id);
                $resultHidePostAds = $stmtHidePostAds->execute();

                $sqlHidePostadsImg = "UPDATE postads_img SET hidden = 1 WHERE adId = ?";
                $stmtHidePostadsImg = $conn->prepare($sqlHidePostadsImg);
                $stmtHidePostadsImg->bind_param("i", $id);
                $resultHidePostadsImg = $stmtHidePostadsImg->execute();

                // Check if hiding was successful
                if ($resultHidePostAds && $resultHidePostadsImg) {
                    ?>
                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Order Placed Successfully!',
                            text: 'The vehicle has been removed from the listing. We will contact you soon!',
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
                            title: 'Failed to Remove Vehicle!',
                            text: 'Failed to remove the vehicle from listing!',
                            confirmButtonText: 'OK'
                        });
                    });
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Place Order!',
                        text: 'Failed to place order! MySQL Error: <?php echo $conn->error; ?>',
                        confirmButtonText: 'OK'
                    });
                });
                </script>
                <?php
            }
        }
    }
} else {
    echo "Error fetching product details: " . $conn->error;
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

    <title>Login</title>
</head>

<body>

    <div class="container" style="margin-top: 80px;margin-bottom:80px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);border-radius:5px;">
        <div  id="vehicleCard" class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <img class="card-img" src="<?php echo $row['image_path'] ?>" alt="Card image" style="padding-left:10px;padding-right:10px;" height="430px">

                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align: center;"><?php echo $row['vehicle_type'] ?></h3>
                        <ul class="list-group list-group-flush" style="margin-top: 30px;">
                            <li class="list-group-item d-inline-flex">
                                <p class="card-text" style="font-size:20px;font-weight:bolder;margin-right:50px;">Brand:</p>
                                <p class="card-text" style="font-size:20px;"><?php echo $row['brand'] ?></p>
                            </li>
                            <li class="list-group-item d-inline-flex">
                                <p class="card-text" style="font-size:20px;font-weight:bolder;margin-right:46px;">Model:</p>
                                <p class="card-text" style="font-size:20px;"><?php echo $row['model'] ?></p>
                            </li>
                            <li class="list-group-item d-inline-flex">
                                <p class="card-text" style="font-size:20px;font-weight:bolder;margin-right:66px;">Year:</p>
                                <p class="card-text" style="font-size:20px;"><?php echo $row['manufactured_year'] ?></p>
                            </li>

                            <li class="list-group-item d-inline-flex">
                                <p class="card-text" style="font-size:20px;font-weight:bolder;margin-right:60px;">Price:</p>
                                <p class="card-text" style="font-size:20px;font-weight: bold;color:red;"><?php echo $row['price'] ?> Rs</p>   
                            </li>
                        </ul>



                        <form action="" method="POST" class="">
                            <div class="input-group d-flex justify-content-center" style="margin-top: 30px;">
                                <button name="submit_vehicle" class="btn btn-primary btn-lg" style="width: 390px;">Buy Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="text-align: center;font-size:20px;font-weight:bold;">
                About This Vehicle
            </div>
            <ul class="list-group list-group-flush" style="font-size:20px;">
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 178px;font-weight:bolder;">Leasing</label>
                    <p><?php echo $row['leasing'] ?></p>

                </li>
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 101px;font-weight:bolder;">Engine Capacity:</label>
                    <p><?php echo $row['engine_capacity'] ?></p>

                </li>
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 158px;font-weight:bolder;">Condition:</label>
                    <p><?php echo $row['condition'] ?></p>

                </li>
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 168px;font-weight:bolder;">Fuel Type</label>
                    <p><?php echo $row['fuel_type'] ?></p>

                </li>
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 173px;font-weight:bolder;">Mileage</label>
                    <p><?php echo $row['mileage'] ?></p>

                </li>
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 124px;font-weight:bolder;">Power Mirror</label>
                    <p><?php echo $row['power_mirror'] ?></p>

                </li>
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 107px;font-weight:bolder;">Power Steering</label>
                    <p><?php echo $row['power_steering'] ?></p>

                </li>
                <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 108px;font-weight:bolder;">Power Window</label>
                    <p><?php echo $row['power_window'] ?></p>

                </li>

                 <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 125px;font-weight:bolder;">Air Condition</label>
                    <p><?php echo $row['ac'] ?></p>

                </li>

                 <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 66px;font-weight:bolder;">Specific Information</label>
                    <p><?php echo $row['specific_info'] ?></p>

                </li>
                 <li class="list-group-item d-inline-flex" style="text-align: center;">

                    <label style="margin-right: 160px;font-weight:bolder;">Posted On</label>
                    <p><?php echo $row['created_at'] ?></p>

                </li>
            </ul>
        </div>

        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

 

</body>
</html>

<?php
include 'footer.php';?>
<?php
include 'connect.php';
include 'nav.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve order details from order_vehicles table
    $sqlSelectOrder = "SELECT * FROM order_vehicles WHERE id = '$order_id'";
    $resultOrder = mysqli_query($conn, $sqlSelectOrder);
    $order = mysqli_fetch_array($resultOrder);

    if ($order) {
        $vehicle_id = $order['vehicle_id'];
        $vehicle_name = $order['vehicle_name'];
        $vehicle_price = $order['vehicle_price'];
        $time = $order['time'];

        // Insert the vehicle back to the post_ads table
        $sqlUnHidePostAds = "UPDATE post_ads SET hidden = 0 WHERE id = '$id'";
        $resultInsertVehicle = mysqli_query($conn, $sqlUnHidePostAds);
        
        $sqlUnHidePostadsImg = "UPDATE postads_img SET hidden = 0 WHERE adId = '$id'";
        $resultInsertVehicleImg = mysqli_query($conn, $sqlUnHidePostadsImg);

        if ($resultInsertVehicle && $resultInsertVehicleImg) {
            // Delete the order from the order_vehicles table
            $sqlDeleteOrder = "DELETE FROM order_vehicles WHERE id = '$order_id'";
            $resultDeleteOrder = mysqli_query($conn, $sqlDeleteOrder);

            if ($resultDeleteOrder) {
                // Redirect to orders page
                echo "cancelled";
                header("Location: Cart.php");
                exit();
            } else {
                echo "Failed to delete order";
            }
        } else {
            echo "Failed to reinsert vehicle";
        }
    } else {
        echo "Order not found";
    }
}
?>

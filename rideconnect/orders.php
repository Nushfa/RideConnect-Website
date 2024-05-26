<!-- orders.php -->
<?php
include 'connect.php';
include 'nav.php';


if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first');location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM order_vehicles WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
</head>

<body>
    <div class="container">
        <h2>Your Orders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Vehicle Name</th>
                    <th>Price</th>
                    <th>Order Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $row['vehicle_name']; ?></td>
                    <td><?php echo $row['vehicle_price']; ?> Rs</td>
                    <td><?php echo $row['time']; ?></td>
                    <td>
                        <a href="cancel_order.php?order_id=<?php echo $row['id']; ?>" class="btn btn-danger">Cancel</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
include 'footer.php';
?>

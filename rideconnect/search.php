<?php
include 'nav.php';
include 'connect.php';
$text =  $_SESSION['_search'];
// Define your search condition (example condition, modify as needed)
//$search_value = 'va'; // Example search value
//$search_condition = "post_ads.vehicle_type LIKE '%" . $conn->real_escape_string($search_value) . "%'";

// SQL query
$sql0 = "SELECT post_ads.*, postads_img.image_path 
        FROM post_ads 
        LEFT JOIN postads_img ON post_ads.id = postads_img.adId 
        WHERE post_Ads.vehicle_type like '%$text%'";
        $result0 = mysqli_query($conn, $sql0);
$count = $result0->num_rows;




$n = 1;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/searchstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">



    <title>Search</title>
</head>

<body>
    <!-- Search Section -->
    <section class="container">
        <p class="mt-5" style="font-size: 20px;font-weight:bold;text-align: center;color:red;">There is <?php echo $count ?> results of your search</p>

        <div style="margin-top:100px ;" class="row">
            <!-- Search for all model car section -->

            <?php
// Define your search condition (example condition, modify as needed)
//$search_value = 'va'; // Example search value
//$search_condition = "post_ads.vehicle_type LIKE '%" . $conn->real_escape_string($search_value) . "%'";

// SQL query
$sql = "SELECT post_ads.*, postads_img.image_path 
        FROM post_ads 
        LEFT JOIN postads_img ON post_ads.id = postads_img.adId 
        WHERE post_Ads.vehicle_type like '%$text%'";
$result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {


            ?>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">

                    <form action="productDetails.php" method="GET">

                        <div class="card " style="width: 18rem;margin:auto;">
                            <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="..." height="200px">
                            <div class="card-body mt-5">
                                <h5 class="card-title"><?php echo $row['vehicle_type']; ?></h5>
                                <p class="card-text" style="font-weight: bold;">Price : <b>  Rs. </b> <?php echo $row['price']; ?>

                                </p>


                                <button type="submit" class="btnn2" name="enter_search" style="width: 100%;">Details</button>
                                <input type="hidden" name="_id" value="<?php echo $row['id']; ?>">
                            </div>
                        </div>


                    </form>

                </div>


            <?php



            }

            ?>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>
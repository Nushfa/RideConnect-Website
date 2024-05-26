<?php
include 'connect.php';
include 'nav.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    $sql = "SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // Start output buffering
    ob_start();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if (!$result->num_rows > 0) {
            $sql = "INSERT INTO login (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Completed',
                    text: 'Please log in to continue.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                });
            <?php } else { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: 'Something went wrong. Please try again.',
                    confirmButtonText: 'OK'
                });
            <?php }
        } else { ?>
            Swal.fire({
                icon: 'warning',
                title: 'Email Already Exists',
                text: 'Please log in with your email and password.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php';
                }
            });
        <?php } ?>
    });
    </script>

    <?php
    // Output the buffer content
    echo ob_get_clean();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/reg.css">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background-image: url(images/bg1.jpg);">
    <!-- Register Section -->
    <div class="container" style="width: 450px;text-align: center;margin-top:120px;margin-bottom:120px;height:570px;background-color:white;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);border-radius:5px;">
        <!-- Register Card Section -->
        <div class="card">
        <form action="" method="POST" class="">
    <p class="login-text" style="font-size: 2rem; font-weight: 800;margin-top:20px;margin-bottom:55px;">Register</p>
    <div class="input-group" style="margin-bottom: 40px;">
        <label style="margin-right: 76px;margin-left:20px;font-size:20px;font-weight:bold;">Username</label>
        <input style="border-radius: 5px;font-size:15px;font-weight:bold;" type="text" placeholder="Username" name="username" required>
    </div>
    <div class="input-group" style="margin-bottom: 40px;">
        <label style="margin-right: 118px;margin-left:20px;font-size:20px;font-weight:bold;">Email</label>
        <input style="border-radius: 5px;font-size:15px;font-weight:bold;" type="email" placeholder="Email" name="email" required>
    </div>
    <div class="input-group" style="margin-bottom: 40px;">
        <label style="margin-right: 110px;margin-left:20px;font-size:20px;font-weight:bold;">Phone</label>
        <input style="border-radius: 5px;font-size:15px;font-weight:bold;" type="text" placeholder="Phone" name="phone" required>
    </div>
    <div class="input-group" style="margin-bottom: 40px;">
    <label style="margin-right: 81px;margin-left:20px;font-size:20px;font-weight:bold;">Password</label>
    <input style="border-radius: 5px;font-size:15px;font-weight:bold;" type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Password must contain at least 8 characters, including uppercase, lowercase, number, and symbol" required>
</div>

    <div class="input-group d-flex justify-content-center" style="margin-top: 55px;">
        <button name="submit" class="btn btn-success btn-lg" style="width: 400px;">Register</button>
    </div>
    <div class="login" style="margin-top: 20px;font-size:large;font-weight:bold;">
        <label>Already have an account?</label>
        <a class="" href="login.php">Log in</a>
    </div>
</form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>

<!-- Footer Section -->
<?php include 'footer.php'; ?>

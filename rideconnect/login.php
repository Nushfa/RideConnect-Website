<?php
include 'connect.php';
include 'nav.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    $sql = "SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // Start output buffering
    ob_start();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if ($result->num_rows > 0) {
            $sql = "SELECT * FROM login WHERE email='$email' AND password = '$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            if ($result->num_rows > 0) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_phone'] = $row['phone'];
                ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: 'You will be redirected to the homepage.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
            <?php } else { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Password',
                    text: 'The password you entered is incorrect. Please try again.',
                    confirmButtonText: 'OK'
                });
            <?php }
        } else { ?>
            Swal.fire({
                icon: 'error',
                title: 'Email Not Found',
                text: 'The email does not exist. Please register.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'register.php';
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
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background-image: url(images/bg1.jpg);">
    <div class="container" style="width: 450px;text-align: center;margin-top:170px;margin-bottom:170px;height:470px;background-color:white;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);border-radius:5px;">
        <div class="card">
            <form action="" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 800;margin-top:20px;margin-bottom:60px;">Log in</p>
                <div class="input-group" style="margin-bottom: 45px;">
                    <label style="margin-right: 118px;margin-left:20px;font-size:20px;font-weight:bold;">Email</label>
                    <input style="border-radius: 5px;font-size:15px;font-weight:bold;" type="email" placeholder="Email" name="email" value="" required>
                </div>
                <div class="input-group" style="margin-bottom: 40px;">
                    <label style="margin-right: 82px;margin-left:20px;font-size:20px;font-weight:bold;">Password</label>
                    <input style="border-radius: 5px;font-size:15px;font-weight:bold;" type="password" placeholder="Password" name="password" value="" required>
                </div>
                <div class="input-group d-flex justify-content-center" style="margin-top: 60px;">
                    <button name="submit" class="btn btn-success btn-lg" style="width: 390px;">Login</button>
                </div>
                <div class="register" style="margin-top: 30px;font-size:large;font-weight:bold;">
                    <p class="login-register-text">Don't have an account? <br><a href="register.php">Register Here</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>
<!-- Footer Section -->
<?php
include 'footer.php';
?>

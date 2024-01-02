<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smartBallot</title>

    <link rel="shortcut icon" href="./public/icons/school-logo.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="./public/styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/styles/css/main.css">
    <!-- END CSS -->
</head>

<body class="bg-main fs-PS2P">
    <!-- LOGIN PAGE -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; width: 30%;">
        <div class="row border border-2 border-light rounded">
            <img src="./public/icons/school-logo.png" alt="" srcset="" class="d-block mx-auto mt-1"
                style="width:75px;">
            <form action="" method="post">
                <h3 class="text-center text-white mt-3 mb-3">Login</h3>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control line-bottom" id="floatingInput" placeholder="Username"
                        name="username">
                    <label for="floatingInput" class="text-secondary">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control line-bottom" id="floatingPassword" placeholder="Password"
                        name="password">
                    <label for="floatingPassword" class="text-secondary">Password</label>
                </div>

                <button type="submit" class="btn text-light rounded w-100 mt-2 mb-4" name="login"
                    style="background: #C4794B;">SUBMIT</button>
            </form>

        </div>
    </div>
    <!-- END PAGE -->



    <!-- SCRIPT -->
    <script src="./public/styles/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- END SCRIPT -->

    <!-- PHP -->
    <?php
    session_start();
    require './public/functions/function.php';
    
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
    
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['role'] = $row['role'];
    
                echo '
                    <script>
                        Swal.fire({
                            title: "Login Success!",
                            text: "Success!",
                            icon: "success",
                            willClose: function () {
                                ';
    
                if ($row['role'] == 'adminAccount') {
                    echo 'window.location.href = "./public/admin/index.php";';
                } else {
                    echo 'window.location.href = "vote.php";';
                }
    
                echo '
                                }
                            });
                    </script>';
            } else {
                echo '
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Wrong Password!",
                        });
                    </script>
                    ';
            }
        } else {
            echo '
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Login Fail!",
                    });
                    // document.location.href = "index.php";
                </script>
                ';
        }
    }
    
    ?>
    <!-- END PHP -->

</body>

</html>

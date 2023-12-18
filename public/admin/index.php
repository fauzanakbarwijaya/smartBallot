<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smartBallot</title>
    <link rel="shortcut icon" href="../icons/school-logo.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/css/main.css">
    <!-- END CSS -->
</head>

<body class="bg-light fs-ubuntu">

    <!-- ADMIN PAGE -->
    <div class="container-fluid">
        <div class="row" style="height:100vh;">
            <div class="col-xl-3" style="background:#788895;">
                <div class="avatar">
                    <a href="http://zan.epizy.com/" target="_blank">
                        <img src="../images/zan.jpg" alt=""
                            class="mt-3 d-block mx-auto rounded-circle shadow-sm" style="width:6rem;">
                    </a>
                </div>
                <?php
                include './layouts/sidebar.php';
                ?>
            </div>
            <div class="col-xl-9">
                <div class="mt-3">
                    <h3>Welcome Admin!</h3>
                </div>
                <h3 class="text-center mb-3" style="margin-top:12%;">Leader This Year</h3>
                <div class="leader-this-year shadow-lg rounded row">
                    <div class="col-md-6">
                        <img src="../images/candidates/candidate.png" style="width:16rem;" alt=""
                            srcset="">
                    </div>
                    <div class="col-md-6">
                        <div class="mt-md-5">
                            <p class="fw-bold">Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : Zack
                                Murkeberg</p>
                            <p class="fw-bold">total votes &nbsp; &nbsp; &nbsp; : 260</p>
                            <p class="fw-bold">service period : 2023</p>
                        </div>
                    </div>
                </div>

                <?php
                    include 'layouts/footer.php';
                ?>
            </div>
        </div>
    </div>
    <!-- END PAGE -->


    <!-- SCRIPT -->
    <script src="../public/styles/js/bootstrap.bundle.min.js"></script>
    <!-- END SCRIPT -->

</body>

</html>

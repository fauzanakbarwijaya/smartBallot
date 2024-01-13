<?php 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Ballot</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/css/main.css">
</head>
<body class="bg-main">
    <h1 class="text-center mt-5 pt-5 text-white mb-2">Thank you for your Vote!</h1>

    <img src="../images/giphy.webp" alt="" class="img-fluid d-block mx-auto" style="width: 300px;">

    <footer class="">
        <div class="container-fluid d-flex align-items-center ">
            <div class="mx-auto mt-5">
                <p class="text-white text-center">Created by ZAN | 2024</p>
            </div>
        </div>
    </footer>

    <section style="height: 100vh;" class="d-flex justify-content-center align-items-center">
        <!-- <div class="loader"></div> -->
        <script>
            setInterval( () => {
            window.location.href = '../../vote.php';
            }, 3500);
        </script>

        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" >
            <circle class="checkmark__circle" cx="26" cy="26" r="25"  fill="none"/>
            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
    </section>

</body>
</html>
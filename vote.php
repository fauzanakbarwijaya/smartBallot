<!-- PHP -->
<?php
session_start();
require './public/functions/function.php';

if (!isset($_SESSION['login'])) {
    echo '<script>
                alert("anda belum login");
                document.location.href = "index.php";
            </script>';
}

$yearNow = date("Y");
$query = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_term = '$yearNow' ");
$no = 1;

if (isset($_POST['candidate1'])) {
    global $conn;
    mysqli_query($conn, 'INSERT INTO ballot_data(candidate1) VALUES(1)');
    header('location: public/pages/loading.php');
} elseif (isset($_POST['candidate2'])) {
    global $conn;
    mysqli_query($conn, 'INSERT INTO ballot_data(candidate2) VALUES(1)');
    header('location: public/pages/loading.php');
} elseif (isset($_POST['candidate3'])) {
    global $conn;
    mysqli_query($conn, 'INSERT INTO ballot_data(candidate3) VALUES(1)');
    header('location: public/pages/loading.php');
}

?>
<!-- END PHP -->

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
    <!-- VOTE PAGE -->
    <div class="container" style="height: 80vh;">
        <div class="row mt-3 mb-5">
            <img src="./public/icons/school-logo.png" alt="" srcset="" class="d-block mx-auto" style="width:100px;">

            <form action="" method="post">
                <h3 class="text-center text-white mt-2 mb-5">Choose Your Leader</h3>
                <div class="row">
                    <?php foreach ($query as $data) : ?>
                        <div class="col col-xl-4 col-md-4">
                            <div class="card text-white" style="width: 20rem; background:transparent; height:20rem; border: 2px solid #C4794B;">
                                <img src="./public/images/candidates/<?= $data['candidate_images'] ?>" class="card-img-top" alt="candidate">
                                <div class="card-body">
                                    <h5 class="card-title mb-3 text-center"><?= $data['candidate_name'] ?></h5>
                                    <button type="submit" name="<?=$data['role']?>" class="btn text-light w-100 mb-3" onclick="return confirm('CLICK OK IF YOU ARE SURE')" style="background: #C4794B;">VOTE</button>
                                    <button type="button" class="btn btn-outline-light w-100" data-bs-toggle="modal" data-bs-target="#visionmision<?= $data['candidate_id'] ?>">Vision & Mision</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>

        <!-- VISION & MISION MODALS -->

        <?php foreach ($query as $data) : ?>
            <div class="modal modal-lg fade" id="visionmision<?= $data['candidate_id'] ?>" tabindex="-1" aria-labelledby="visionmision<?= $data['candidate_id'] ?>Label" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header shadow-sm" style="background-color:#C4794B;;">
                            <h1 class="modal-title fs-5" id="titlemodal1"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row text-center">
                                    <div class="col-12">
                                        <h3 style="font-family: 'GangOfThree', cursive;color:#C4794B;;">Vision</h3>
                                        <p class="fw-bold mt-2" style="font-family: 'Times New Roman', Times, serif;">
                                            <?= $data['vision'] ?>
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <h3 style="font-family: 'GangOfThree', cursive; color: #C4794B;">Mision</h3>
                                        <?php
                                        $paragraphs = explode(".", $data['mision']);
                                        ?>
                                        <ol class="p-3 m-2 lh-lg text-start">
                                            <?php foreach ($paragraphs as $paragraph) : ?>
                                                <li style="font-family: 'Times New Roman', Times, serif;" class="fw-bold">
                                                    <?= trim($paragraph) ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- END MODALS -->
    </div>
    <!-- END PAGE -->



    <!-- SCRIPT -->
    <script src="./public/styles/js/bootstrap.bundle.min.js"></script>
</body>

</html>
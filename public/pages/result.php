<?php
session_start();
require '../functions/function.php';

$hostname = 'localhost';
$username = 'root';
$password = '';
$nama_db = 'smartballot';

if (!isset($_SESSION['login'])) {
    echo '<script>
            alert("anda belum login");
            document.location.href = "index.php";
        </script>';
}

// mysqli_fetch_row gunanya untuk mengubah data yang diambil menjadi array
$conn = mysqli_connect($hostname, $username, $password, $nama_db);
$yearNow = date("Y");
$result1 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(candidate1) FROM ballot_data WHERE YEAR(created_at) = '$yearNow' "));
$result2 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(candidate2) FROM ballot_data WHERE YEAR(created_at) = '$yearNow' "));
$result3 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(candidate3) FROM ballot_data WHERE YEAR(created_at) = '$yearNow' "));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Results</title>
    <!-- CSS -->
    <link rel="icon" type="image/x-icon" href="../images/Logo.png">
    <link rel="stylesheet" href="../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/css/main.css">

    <style>
        .container.d-flex.h-100 {
            transform: scale(0.8);
            margin-top: -5% !important;
        }
    </style>
</head>

<body style="overflow: hidden;" class="bg-main" id="myResult">
    <button class="btn btn-secondary" onclick="closeFullscreen()">Close Full screen[]</button>
    <div class="container d-flex h-100">
        <div class="row justify-content-center align-self-center w-100">
            <div class="col-md-12 bg-secondary bg-opacity-25 text-center py-3 ">
                <h2 class="text-white">Voting Results</h2>
            </div>
            <?php
            $candidate = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_term = '$yearNow' ");
            foreach ($candidate as $data) :
            ?>
                <div class="col-md-4 text-center">
                    <img src="../images/candidates/<?= $data['candidate_images'] ?>" alt="<?= $data['candidate_images'] ?>" width="150" height="150" style="border-radius: 50%;">
                    <h4 class="text-white"><?= $data['candidate_name'] ?></h4>
                </div>
            <?php endforeach; ?>

            <div class="col-md-12 bg-secondary bg-opacity-25">
                <div style="max-width: 100%; margin: auto;">
                    <canvas id="voteChart"></canvas>
                </div>
            </div>
        </div>

    </div>
    <script src="../styles/js/Chart.js"></script>
    <script>
        window.setTimeout(function() {
            window.location.reload();
        }, 60000);

        var result1 = <?php echo $result1[0]; ?>;
        var result2 = <?php echo $result2[0]; ?>;
        var result3 = <?php echo $result3[0]; ?>;

        var labels = [result1, result2, result3];
        var data = [result1, result2, result3];

        var ctx = document.getElementById('voteChart').getContext('2d');
        var voteChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    data: data,
                    backgroundColor: ['red', 'blue', 'green'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 800,
                        },

                    }]
                }
            }
        });
    </script>
    <script src="../styles/js/bootstrap.bundle.min.js"></script>
    <script>

        function closeFullscreen() {
            document.location.href = '../admin/ballot.php';
        }
    </script>


</html>
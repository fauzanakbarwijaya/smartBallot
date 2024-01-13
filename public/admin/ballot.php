<?php
session_start();

require '../functions/function.php';

if (isset($_POST['add'])) {
    if (addCandidate($_POST) > 0) {
        echo "<script>
       alert('Adding candidate success!');
       </script>";
    }
}

$no = 1;
$query = mysqli_query($conn, 'SELECT * FROM candidates');

if (isset($_POST['year'])) {
    $year = $_POST['year'];

    $query = "SELECT SUM(candidate1), SUM(candidate2), SUM(candidate3) FROM ballot_data WHERE YEAR(created_at) = $year";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_row($result);
        $results1 = $row[0];
        $results2 = $row[1];
        $results3 = $row[2];
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}


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
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- END CSS -->
</head>

<body class="bg-light fs-ubuntu">

    <!-- ADMIN PAGE -->
    <div class="container-fluid">
        <div class="row" style="height:100vh;">
            <div class="col-xl-3" style="background:#788895;">
                <div class="avatar">
                    <a href="http://zan.epizy.com/" target="_blank">
                        <img src="../images/zan.jpg" alt="" class="mt-3 d-block mx-auto rounded-circle shadow-sm" style="width:6rem;">
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
                <div class="mt-5 mb-3">
                    <h4 class="">Ballot Data</h4>
                </div>

                <div class="ballot-data mb-3">
                    <div class="ratio ratio ratio-4x3">
                        <iframe src="../pages/result.php" style="height:25rem;" id="myResult"></iframe>
                    </div>
                    <button type="button" onclick="openfullScreen()" class="btn btn-secondary position-absolute" style="top: 20%;">See Full Screen []</button>
                </div>

                <div class="position-absolute" style="top: 90%;">
                    <form action="" method="POST" class="mb-3 d-flex me-auto">
                        <select name="year" id="year" class="form-select" style="width:100px;">
                            <option value="#" selected disabled></option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                        <button type="submit" class="btn btn-secondary ms-3">Search</button>
                    </form>
    
                    <div class="table-responsive">
                        <table class="table table-light table-bordered table-hover">
                            <tr>
                                <th>No</th>
                                <th>Candidate 1</th>
                                <th>Candidate 2</th>
                                <th>Candidate 3</th>
                                <th>year</th>
                            </tr>
    
                            <?php
                            if (isset($_POST['year'])) {
                                foreach ($result as $data) :
                                    $winVote1 = $results1 > $results2 && $results1 > $results3;
                                    $winVote2 = $results2 > $results1 && $results2 > $results3;
                                    $winVote3 = $results3 > $results1 && $results3 > $results2;
    
                                    if (!$winVote1 && !$winVote2 && !$winVote3) {
                                        echo '';
                                    }
    
    
                            ?>
                                    <tr>
                                        <td>1</td>
                                        <td <?php if ($winVote1) echo 'class="text-success fw-bold"'; ?>><?= $results1; ?></td>
                                        <td <?php if ($winVote2) echo 'class="text-success fw-bold"'; ?>><?= $results2; ?></td>
                                        <td <?php if ($winVote3) echo 'class="text-success fw-bold"'; ?>><?= $results3; ?></td>
                                        <td><?= $year; ?></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
    
                        </table>
    
                        <button class="btn btn-success d-block ms-auto" id="download-excel">Donwload Excel</button>
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
    <script src="../styles/js/bootstrap.bundle.min.js"></script>

    <!-- Datatable -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#candidatesTable');
    </script>
    <!-- end datatable -->
    <!-- END SCRIPT -->
    <script>
        var elem = document.getElementById("myResult");

        function openfullScreen() {
            document.location.href = '../pages/result.php';
        }

        document.getElementById('download-excel').addEventListener('click', function() {
            var table = document.querySelector('.table');

            var excel = new Blob([table.outerHTML], {
                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            });

            var url = URL.createObjectURL(excel);

            var a = document.createElement('a');
            a.href = url;
            a.download = 'data_excel.xls';

            a.click();

            // Hapus URL objek Excel yang dibuat sebelumnya
            URL.revokeObjectURL(url);
        });
    </script>
</body>

</html>
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
                <div class="d-flex mt-5 justify-content-between mb-3">
                    <h4 class="">Candidates Data</h4>
                    <button type="button" class="btn text-light" style="background:#788895;" data-bs-toggle="modal"
                        data-bs-target="#addCandidate">
                        Add Candidate
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-light table-hover" id="candidatesTable">
                        <thead>
                            <tr>
                                <th class="bg-dark bg-opacity-75 text-white">No</th>
                                <th class="bg-dark bg-opacity-75 text-white">Student Name</th>
                                <th class="bg-dark bg-opacity-75 text-white">Student ID</th>
                                <th class="bg-dark bg-opacity-75 text-white">Class</th>
                                <th class="bg-dark bg-opacity-75 text-white">Role</th>
                                <th class="bg-dark bg-opacity-75 text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td> <img src="../images/candidates/candidate.png" class="rounded-circle"
                                        style="width:2rem; height:2rem;" alt="" srcset="">Zack Murkeberg
                                </td>
                                <td>11224</td>
                                <td>1st'A</td>
                                <td>Candidate 1</td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-warning">Edit</button>
                                        <button class="btn btn-danger ms-3">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                include 'layouts/footer.php';
                ?>
            </div>
        </div>

        <!-- add candidate Modal -->
        <div class="modal fade" id="addCandidate" tabindex="-1" aria-labelledby="addCandidateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addCandidateLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="modal-body">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="number" name="student_id" id="student_id" class="form-control">
                            <!-- <input type="number" min="1900" max="2099" step="1" value="2016" /> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->
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

</body>

</html>

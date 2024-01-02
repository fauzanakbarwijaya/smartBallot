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
                                <th class="bg-dark bg-opacity-75 text-white">Term</th>
                                <th class="bg-dark bg-opacity-75 text-white">Action</th>
                            </tr>
                        </thead>
                        <?php foreach ($query as $data) : ?>
                        <tbody>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td> <img src="../images/candidates/<?= $data['candidate_images'] ?>"
                                        class="rounded-circle" style="width:2rem; height:2rem;" alt=""
                                        srcset=""><?= $data['candidate_name'] ?>
                                </td>
                                <td><?= $data['student_id'] ?></td>
                                <td><?= $data['class'] ?></td>
                                <td><?= $data['role'] ?></td>
                                <td><?= $data['candidate_term'] ?></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-warning"><i
                                                class="bi bi-pen-fill text-light"></i></button>
                                        <a class="btn btn-danger ms-3"
                                            href="../functions/delete.php?id=<?= $data['candidate_id'] ?>">
                                            <i class="bi bi-trash-fill text-light"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>

                <?php
                include 'layouts/footer.php';
                ?>
            </div>
        </div>

        <!-- add candidate Modal -->
        <div class="modal fade modal-lg" id="addCandidate" tabindex="-1" aria-labelledby="addCandidateLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background:#788895;">
                        <h1 class="modal-title text-white fs-5" id="addCandidateLabel">Add Candidate</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="modal-body row">
                            <div class="col-md-6">
                                <label for="student_id" class="form-label">Student ID</label>
                                <input type="number" name="student_id" id="student_id" placeholder="1124"
                                    class="form-control mb-3" required>
                                <label for="candidate_name" class="form-label">Candidate Name</label>
                                <input type="text" name="candidate_name" id="candidate_name"
                                    placeholder="Zack Murkeberg" class="form-control mb-3" required>
                                <label for="class" class="form-label">Class</label>
                                <input type="text" name="class" id="class" placeholder="1st A"
                                    class="form-control mb-3" required>
                                <label for="vision" class="form-label">Vision</label>
                                <textarea name="vision" id="vision" class="form-control mb-3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="mision" class="form-label">Mision</label>
                                <textarea name="mision" id="mision" class="form-control mb-3"></textarea>
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select mb-3" required>
                                    <option value="#" selected disabled></option>
                                    <option value="candidate1">Candidate 1</option>
                                    <option value="candidate3">Candidate 2</option>
                                    <option value="candidate2">Candidate 3</option>
                                </select>
                                <label for="term" class="form-label">Term</label>
                                <input type="number" class="form-control mb-3" name="term" min="1900"
                                    max="2099" step="1" value="2023" required />
                                <label for="candidate_images" class="form-label">Candidate Images</label>
                                <input type="file" class="form-control mb-3" name="candidate_images"
                                    accept="image/*" required />
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add" class="btn btn-secondary">Add</button>
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

<?php
session_start();

require '../functions/function.php';

if (isset($_POST['add'])) {
    if (editCandidate($_POST) > 0) {
        echo "<script>
       alert('Editing candidate success!');
       </script>";
    }
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_id = '$id' ");
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
                include '../admin/layouts/sidebar.php';
                ?>
            </div>
            <div class="col-xl-9">
                <div class="mt-3 mb-3">
                    <h3>Welcome Admin!</h3>
                </div>
                <form action="" enctype="multipart/form-data" method="post">
                    <?php foreach ($query as $data) : ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="number" name="student_id" id="student_id" value="<?= $data['student_id'] ?>"
                                class="form-control mb-3" required>
                            <label for="candidate_name" class="form-label">Candidate Name</label>
                            <input type="text" name="candidate_name" id="candidate_name"
                                value="<?= $data['candidate_name'] ?>" class="form-control mb-3" required>
                            <label for="class" class="form-label">Class</label>
                            <input type="text" name="class" id="class" value="<?= $data['class'] ?>"
                                class="form-control mb-3" required>
                            <label for="vision" class="form-label">Vision</label>
                            <textarea name="vision" id="vision" class="form-control mb-3"><?= $data['vision'] ?>
                            </textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="mision" class="form-label">Mision</label>
                            <textarea name="mision" id="mision" class="form-control mb-3" placeholder="mision one. mision two. mision tree"><?= $data['mision'] ?></textarea>
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select mb-3" required>
                                <?php
                                    $roles = ['candidate1', 'candidate2', 'candidate3'];

                                    $selected = '';
                                    foreach ($roles as $role) {
                                        ${'selected' . substr($role, -1)} = ($data['role'] == $role) ? 'selected' : '';
                                    }
                                ?>
                                <option value="#" <?= $selected ?> disabled></option>
                                <option value="candidate1" <?= $selected1 ?>>Candidate 1</option>
                                <option value="candidate2" <?= $selected2 ?>>Candidate 2</option>
                                <option value="candidate3" <?= $selected3 ?>>Candidate 3</option>
                            </select>
                            <label for="term" class="form-label">Term</label>
                            <input type="number" class="form-control mb-3" name="term" min="1900" max="2099"
                                step="1" value="<?= $data['candidate_term'] ?>" required />
                            <label for="candidate_images" class="form-label">New Images</label>
                            <input type="file"  class="form-control mb-3" name="candidate_images" accept="image/*"/>
                            
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <button type="submit" name="add" class="btn btn-secondary w-100">Edit</button>
                </form>


                <?php
                include '../admin/layouts/footer.php';
                ?>
            </div>
        </div>


    </div>
    <!-- END PAGE -->


    <!-- SCRIPT -->
    <script src="../styles/js/bootstrap.bundle.min.js"></script>


    <!-- end datatable -->
    <!-- END SCRIPT -->

</body>

</html>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'smartballot');

function uploadImage()
{
    $fileName = $_FILES['candidate_images']['name'];
    $tmpName = $_FILES['candidate_images']['tmp_name'];

    $ekstensiImage = explode('.', $fileName);
    $ekstensiImage = strtolower(end($ekstensiImage));

    $newName = uniqid();
    $newName .= '.';
    $newName .= $ekstensiImage;

    move_uploaded_file($tmpName, '../images/candidates/' . $newName);
    return $newName;
}

function addCandidate($data)
{
    global $conn;

    $student_id = $data['student_id'];
    $candidate_name = $data['candidate_name'];
    $class = $data['class'];
    $vision = $data['vision'];
    $mision = $data['mision'];
    $role = $data['role'];
    $candidate_term = $data['term'];
    $Image = uploadImage();

    mysqli_query($conn, "INSERT INTO candidates VALUES(NULL, '$student_id', '$candidate_name', '$class', '$vision', '$mision', '$role', '$Image', '$candidate_term', NOW())");
    if (mysqli_affected_rows($conn) > 0) {
        echo '
                <script>
                    alert("Add Candidate Success!");
                </script>
            ';
    } else {
        echo '
                <script>
                    alert("Add Candidate Failed!");
                </script>
            ';
    }
}

function editCandidate($data)
{
    global $conn;

    $id = $_GET['id'];
    $student_id = $data['student_id'];
    $candidate_name = $data['candidate_name'];
    $class = $data['class'];
    $vision = $data['vision'];
    $mision = $data['mision'];
    $role = $data['role'];
    $candidate_term = $data['term'];
    $image = uploadImage();
    
    $imageCheck = mysqli_query($conn, "SELECT candidate_images FROM candidates WHERE candidate_id = '$id'");
    foreach ($imageCheck as $data) {
        $imageNew = $data['candidate_images'];

    }

    if (!empty($_FILES['candidate_images']['name'])) {
        $existingImage = mysqli_query($conn, "SELECT candidate_images FROM candidates WHERE candidate_id = '$id'")->fetch_assoc()['candidate_images'];
        $image = !empty($image) ? $image : $existingImage;
    }else {
        $image = $imageNew;
    }

    mysqli_query($conn, "UPDATE candidates SET
        student_id = '$student_id',
        candidate_name = '$candidate_name',
        class = '$class',
        vision = '$vision',
        mision = '$mision',
        role = '$role',
        candidate_images = '$image',
        candidate_term = '$candidate_term',
        created_at = NOW()
        WHERE candidate_id = '$id' ");

    if (mysqli_affected_rows($conn) > 0) {
        echo '
                <script>
                    alert("Edit Candidate Success!");
                    document.location.href = "http://localhost/my_projek/smartBallot/public/admin/candidates.php";
                </script>
            ';
    } else {
        echo '
                <script>
                    alert("Edit Candidate Failed!");
                </script>
            ';
    }
}

?>

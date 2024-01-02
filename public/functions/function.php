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

    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $tlp = $data['tlp'];

    $query = mysqli_query($conn, "UPDATE tb_member SET nama = '$nama', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', tlp = '$tlp' WHERE id_member = '$id'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = '../customer.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal mengedit data');
                document.location.href = '../customer.php';
            </script>
        ";
    }
}
?>

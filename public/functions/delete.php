<?php
    $conn = mysqli_connect("localhost", "root", "", "smartballot");

    $id = $_GET['id'];

    $query = mysqli_query($conn, "DELETE FROM candidates WHERE candidate_id = '$id' ");

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Success!');
                document.location.href = '../admin/candidates.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Failed!');
                document.location.href = '../admin/candidates.php';
            </script>
        ";
    }
?>
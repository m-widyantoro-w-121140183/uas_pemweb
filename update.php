<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailToUpdate = isset($_POST['email']) ? $_POST['email'] : '';
    $newName = isset($_POST['name']) ? $_POST['name'] : '';
    $newStatus = isset($_POST['status']) ? $_POST['status'] : '';
    $newGender = isset($_POST['gender']) ? $_POST['gender'] : '';

    $db = new Database("localhost", "root", "", "uaspemweb");

    $updateResult = $db->updateByEmail($emailToUpdate, $newName, $newStatus, $newGender);

    if ($updateResult) {
        echo "<script>alert('Update berhasil!')</script>";
    } else {
        echo "<script>alert('Update gagal. N\Mohon periksa kembali!')</script>";
    }

    $db->closeConnection();
}
?>

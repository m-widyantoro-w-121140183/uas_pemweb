<?php
session_start(); 

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    $_SESSION['user'] = [
        'name' => $name,
        'email' => $email,
        'status' => $status,
        'gender' => $gender
    ];

    $response = ['success' => true, 'message' => 'Data berhasil diterima di PHP.'];
    echo json_encode($response);

    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    $db = new Data("localhost", "root", "", "uaspemweb");

    $saveResult = $db->push($name, $email, $status, $gender, $browser, $ip_address);

    $db->closeConnection();
} else {
    $response = ['success' => false, 'message' => 'Metode permintaan tidak valid.'];
    echo json_encode($response);
}
?>

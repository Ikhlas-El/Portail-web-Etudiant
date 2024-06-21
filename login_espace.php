<?php
@include 'Config.php';

header('Content-Type: application/json'); // Ensure the response is JSON

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['email'])) {
    echo json_encode(['status' => 'failure', 'error' => 'Invalid input']);
    exit();
}

$email = mysqli_real_escape_string($conn, $data['email']);
// Logging the email to ensure it is received correctly
error_log("Received email: " . $email);

$query = "SELECT * FROM etudiant WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['status' => 'failure', 'error' => 'Query failed']);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'failure', 'error' => 'User not found']);
}
?>

<?php
@include 'Config.php';
session_start();

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SESSION['student_id'])) {
        throw new Exception("User not logged in");
    }

    $yearId = $data['year'];
    $semesterId = $data['semester'];
    $studentId = $_SESSION['student_id'];

    $query = "SELECT DISTINCT m.titre AS module, 
                    MAX(CASE WHEN n.controle_num = 1 THEN n.valeur END) AS premierControle,
                    MAX(CASE WHEN n.controle_num = 2 THEN n.valeur END) AS deuxiemeControle,
                    MAX(CASE WHEN n.controle_num = 3 THEN n.valeur END) AS troisiemeControle
            FROM note n 
            JOIN modules m ON n.moduleId = m.id 
            WHERE n.etudiantId = ? AND n.anneeId = ? AND n.semestreId = ?
            GROUP BY m.titre";

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        throw new Exception("SQL prepare statement error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "iii", $studentId, $yearId, $semesterId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $notes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $notes[] = $row;
    }

    echo json_encode($notes);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>

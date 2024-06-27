<?php
// Start session and include configuration
session_start();
@include 'Config.php';

// Check if the user is an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: Connecter.php");
    exit;
}

// Initialize variables
$action = $_POST['action'] ?? '';
$cne = $_POST['cne'] ?? '';
$year = $_POST['year'] ?? '';
$semester = $_POST['semester'] ?? '';
$note1 = $_POST['note1'] ?? '';
$note2 = $_POST['note2'] ?? '';
$note3 = $_POST['note3'] ?? '';
$moduleId = $_POST['module_id'] ?? '';

// Perform CRUD operations based on action
if ($action === 'create' || $action === 'update') {
    $etudiantIdQuery = "SELECT id FROM etudiant WHERE cne = ?";
    $stmt = mysqli_prepare($conn, $etudiantIdQuery);
    mysqli_stmt_bind_param($stmt, "s", $cne);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $etudiantId = $row['id'];

        // Insert or update notes
        for ($i = 1; $i <= 3; $i++) {
            $note = ${"note$i"};
            if ($note !== '') {
                if ($action === 'create') {
                    $query = "INSERT INTO note (valeur, controle_num, etudiantId, moduleId, anneeId, semestreId) VALUES (?, ?, ?, ?, ?, ?)";
                } else {
                    $query = "UPDATE note SET valeur = ? WHERE controle_num = ? AND etudiantId = ? AND moduleId = ? AND anneeId = ? AND semestreId = ?";
                }
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "diiiii", $note, $i, $etudiantId, $moduleId, $year, $semester);
                mysqli_stmt_execute($stmt);
            }
        }
    }
} elseif ($action === 'delete') {
    $etudiantIdQuery = "SELECT id FROM etudiant WHERE cne = ?";
    $stmt = mysqli_prepare($conn, $etudiantIdQuery);
    mysqli_stmt_bind_param($stmt, "s", $cne);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $etudiantId = $row['id'];
        $query = "DELETE FROM note WHERE etudiantId = ? AND moduleId = ? AND anneeId = ? AND semestreId = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iiii", $etudiantId, $moduleId, $year, $semester);
        mysqli_stmt_execute($stmt);
    }
}
?>

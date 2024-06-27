<?php
@include 'Config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'] ?? '';
    $matiere_id = $_POST['matiere_id'] ?? '';

    if ($exam_id && $matiere_id) {
        $sql = "DELETE FROM matiere WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $matiere_id);
        $stmt->execute();

        $sql = "DELETE FROM examen WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $exam_id);
        $stmt->execute();

        echo "Examen supprimé avec succès.";
    } else {
        echo "Erreur de suppression.";
    }

    $stmt->close();
    $conn->close();
}
?>

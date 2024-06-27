<?php
@include 'Config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_title = $_POST['exam_title'] ?? '';
    $subject_title = $_POST['subject_title'] ?? '';
    $filiere_id = $_POST['filiere_id'] ?? '';
    $annee = $_POST['annee'] ?? '';
    $pdf_path = 'uploads/' . basename($_FILES['pdf_path']['name'] ?? '');

    if ($exam_title && $subject_title && $filiere_id && $annee && $pdf_path) {
        if (move_uploaded_file($_FILES['pdf_path']['tmp_name'], $pdf_path)) {
            $sql = "INSERT INTO examen (titre, filiere_id, annee) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sis', $exam_title, $filiere_id, $annee);
            $stmt->execute();
            $exam_id = $stmt->insert_id;

            $sql = "INSERT INTO matiere (exam_id, matiere_title, pdf_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iss', $exam_id, $subject_title, $pdf_path);
            $stmt->execute();

            echo "Examen ajouté avec succès.";
        } else {
            echo "Erreur lors du téléchargement du fichier PDF.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }

    $stmt->close();
    $conn->close();
}
?>

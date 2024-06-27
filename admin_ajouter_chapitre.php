<?php
// Include configuration file for database connection
@include 'Config.php';

// Check if there is a connection error
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Activate error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $chapter_title = $_POST['chapter_title'] ?? '';
    $module_id = $_POST['module_id'] ?? '';
    $pdf_path = 'uploads/' . basename($_FILES['pdf_path']['name'] ?? '');

    // Validate that all required fields are present and not empty
    if ($chapter_title && $module_id && $pdf_path) {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['pdf_path']['tmp_name'], $pdf_path)) {
            // Log successful file upload
            error_log("Fichier téléchargé avec succès vers : $pdf_path");

            // Prepare SQL statement with a prepared statement
            $stmt = $conn->prepare("INSERT INTO chapitres (titre, pdf_path, module_id) VALUES (?, ?, ?)");
            if ($stmt) {
                // Bind parameters to the prepared statement
                $stmt->bind_param("ssi", $chapter_title, $pdf_path, $module_id);

                // Execute the statement
                if ($stmt->execute()) {
                    // If insertion is successful, display success message
                    echo "Nouveau chapitre ajouté avec succès";

                    // Redirect to cours.php after successful operation
                    header('Location: cours.php');
                    exit(); // Ensure script stops execution after redirection
                } else {
                    // If execution fails, display error message
                    echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                // If preparing the statement fails, display error message
                echo "Erreur lors de la préparation de la requête : " . $conn->error;
            }
        } else {
            // If file upload fails, display error message
            echo "Erreur lors du téléchargement du fichier : " . $_FILES['pdf_path']['error'];
        }
    } else {
        // If required form data is missing, display error message
        echo "Données du formulaire manquantes";
    }
} else {
    // If request method is not POST, display error message
    echo "Méthode de requête invalide";
}

// Close the database connection
$conn->close();
?>

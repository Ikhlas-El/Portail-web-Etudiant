<?php
@include 'Config.php';

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$module_title = $_POST['module_title'];
$filiere = $_POST['filiere'];
$annee = $_POST['annee'];

// Fetch filiere_id from filiere table
$filiere_query = "SELECT id FROM filiere WHERE nom = '$filiere'";
$filiere_result = $conn->query($filiere_query);

if ($filiere_result->num_rows > 0) {
    $filiere_row = $filiere_result->fetch_assoc();
    $filiere_id = $filiere_row['id'];

    $sql = "INSERT INTO modules (titre, filiere_id, annee) VALUES ('$module_title', $filiere_id, $annee)";
    if ($conn->query($sql) === TRUE) {
        echo "Nouveau module ajouté avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Erreur : Filière non trouvée.";
}

$conn->close();
header('Location: cours.php');
?>

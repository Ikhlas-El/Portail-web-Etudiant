<?php
@include 'Config.php';

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$module_id = $_POST['module_id'];

$sql = "DELETE FROM modules WHERE id = $module_id";
if ($conn->query($sql) === TRUE) {
    echo "Module supprimé avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: cours.php');
?>

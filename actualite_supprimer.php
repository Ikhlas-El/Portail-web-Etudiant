<?php
include 'Config.php';
$id = $_GET['id'];

$sql = "DELETE FROM actualite WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Enregistrement supprimé avec succès";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
header('Location: actualite.php');
?>

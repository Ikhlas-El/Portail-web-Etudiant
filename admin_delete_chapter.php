<?php

@include 'Config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$chapter_id = $_POST['chapter_id'];

$sql = "DELETE FROM chapitres WHERE id = $chapter_id";
if ($conn->query($sql) === TRUE) {
    echo "Chapitre supprimé avec succèsi";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: cours.php');
?>
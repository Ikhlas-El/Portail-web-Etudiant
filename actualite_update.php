<?php
include 'Config.php';

$id = $_GET['id'];
$title = $_POST['title'];
$pdf = $_FILES['pdf']['name'];
$image = $_FILES['image']['name'];

$set_image = '';
$set_pdf = '';

// Check if image file is uploaded
if (!empty($image)) {
    $image_target = "images/" . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_target)) {
        $set_image = ", image_path='$image_target'";
    } else {
        echo "Failed to upload image.";
        exit;
    }
}

// Check if PDF file is uploaded
if (!empty($pdf)) {
    $pdf_target = "pdfs/" . basename($pdf);
    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_target)) {
        $set_pdf = ", pdf_path='$pdf_target'"; // Corrected to use 'pdf_path'
    } else {
        echo "Failed to upload PDF.";
        exit;
    }
}

// Update SQL query
$sql = "UPDATE actualite SET title='$title' $set_image $set_pdf WHERE id=$id";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
header('Location: actualite.php'); // Redirect back to the actualite.php page
?>

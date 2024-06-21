<?php
include 'Config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store inputs
    $title = mysqli_real_escape_string($conn, $_POST['title']);

    // File paths for image and PDF uploads
    $image = $_FILES['image']['name'];
    $pdf = $_FILES['pdf']['name'];

    // Define the target directories for image and PDF uploads
    $target_dir = "images/";  // Relative path for image uploads
    $pdf_dir = "pdfs/";       // Relative path for PDF uploads

    $target_file_image = $target_dir . basename($image);
    $target_file_pdf = $pdf_dir . basename($pdf);

    // Upload image
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_image) &&
        move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file_pdf)) {

        // Insert data into database
        $sql = "INSERT INTO actualite (title, image_path, pdf_path) VALUES ('$title', '$target_file_image', '$target_file_pdf')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {
        echo "Sorry, there was an error uploading your files.";
    }
}

$conn->close();
header('Location: actualite.php'); // Redirect after processing
?>

<?php
@include 'Config.php';

$sql = "SELECT id, titre FROM modules";
$result = $conn->query($sql);

$modules = array();
while ($row = $result->fetch_assoc()) {
    $modules[] = array('id' => $row['id'], 'title' => $row['titre']);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($modules);
?>

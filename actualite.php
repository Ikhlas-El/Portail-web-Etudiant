<?php
@include 'Config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTS Lissane Edinne Ibn Al-khatib Laayoune</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" 
    rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="BTS.CSS?v=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <script src="BTS.JS"></script>
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"/>
</head>
<body>
<nav class="custom-nav">
  <div class="header-logo">
    <i class="bx bx-menu menu-icon"></i>
    <span class="logo-name">BTS LAAYOUNE</span>
  </div>
  <div class="sidebar">
    <div class="header-logo">
      <i class="bx bx-menu menu-icon"></i>
      <span class="logo-name">BTS LAAYOUNE</span>
    </div>
    <div class="sidebar-content">
      <ul class="lists">
        <li class="list">
          <a href="Admin.php" class="nav-link">
            <i class='bx bx-user icon'></i>
            <span class="link">Étudiants</span>
          </a>
        </li>
        <li class="list">
          <a href="actualite.php" class="nav-link active">
            <i class="bx bx-home-alt icon"></i>
            <span class="link">Actualité</span>
          </a>
        </li>
        <li class="list">
          <a href="cours.php" class="nav-link">
            <i class="bx bx-folder-open icon"></i>
            <span class="link">Cours</span>
          </a>
        </li>
        <li class="list">
          <a href="examens.php" class="nav-link">
            <i class="bx bx-folder-open icon"></i>
            <span class="link">Examens</span>
          </a>
        </li>
        <li class="list">
          <a href="notes.php" class="nav-link">
            <i class='bx bx-edit icon'></i>
            <span class="link">Notes</span>
          </a>
        </li>
      </ul>
      <div class="bottom-content">
        <ul class="lists">
          <li class="list">
            <a href="logout_admin.php" class="nav-link">
              <i class="bx bx-log-out icon"></i>
              <span class="link">Se déconnecter</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<section class="custom-overlay"></section>

<section id="actui_admin">
    <h2>Ajouter actualité</h2>
    <form class="form_actua" action="actualite_ajout.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required>
        <label for="pdf">PDF:</label>
        <input type="file" name="pdf" id="pdf" required>
        <button type="submit">Ajouter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Image</th>
                <th>PDF</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
$result = $conn->query("SELECT * FROM actualite");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['title']}</td>
            <td><img src='{$row['image_path']}' alt='{$row['title']}' width='100'></td>
            <td>";
    if (isset($row['pdf_path']) && !empty($row['pdf_path'])) {
        echo "<a href='" . $row['pdf_path'] . "' target='_blank'>Voir PDF</a>";
    } else {
        echo "No PDF available";
    }
    echo "</td>
            <td>
                <a  href='actualite_modifier.php?id={$row['id']}'>Modifier</a>
                <a  href='actualite_supprimer.php?id={$row['id']}'>Supprimer</a>
            </td>
          </tr>";
}
?>

        </tbody>
    </table>
</section>
</body>
</html>

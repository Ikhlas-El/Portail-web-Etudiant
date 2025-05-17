<?php
@include 'Config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTS Lissane Edinne Ibn Al-khatib Laayoune</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="BTS2.CSS?v=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="BTS.JS"></script>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="images/favicon.png">
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
          <a href="actualite.php" class="nav-link">
            <i class="bx bx-home-alt icon"></i>
            <span class="link">Actualités</span>
          </a>
        </li>
        <li class="list">
          <a href="cours.php" class="nav-link active">
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

<h1>Gérer les Cours</h1>

<h2>Ajouter un Nouveau Module</h2>
<form id="add-module-form" method="post" action="admin_ajouter_module.php">
    <label for="module_title">Titre du Module :</label>
    <input type="text" id="module_title" name="module_title" required>
    <label for="filiere">Filière :</label>
    <select id="filiere" name="filiere" required>
        <option value="DSI">DSI</option>
        <option value="SRI">SRI</option>
    </select>
    <label for="annee">Année :</label>
    <select id="annee" name="annee" required>
        <option value="1">1ère année</option>
        <option value="2">2ème année</option>
    </select>
    <button type="submit">Ajouter</button>
</form>

<h2>Ajouter un Nouveau Chapitre</h2>
<form id="add-chapter-form" method="post" enctype="multipart/form-data" action="admin_ajouter_chapitre.php">
    <label for="chapter_title">Titre du Chapitre :</label>
    <input type="text" id="chapter_title" name="chapter_title" required>
    <label for="module_id">Module :</label>
    <select id="module_id" name="module_id" required>
        <?php
        @include 'Config.php';

        $module_query = "SELECT id, titre FROM modules";
        $module_result = $conn->query($module_query);

        while ($module_row = $module_result->fetch_assoc()) {
            echo '<option value="' . $module_row['id'] . '">' . htmlspecialchars($module_row['titre']) . '</option>';
        }

        $conn->close();
        ?>
    </select>
    <label for="pdf_path">Fichier PDF :</label>
    <input type="file" id="pdf_path" name="pdf_path" accept="application/pdf" required>
    <button type="submit">Ajouter</button>
</form>

<h2>Gérer les Modules et Chapitres</h2>
<?php
@include 'Config.php';

$sql = "SELECT modules.id AS module_id, modules.titre AS module_title, filiere.nom AS filiere_name, modules.annee, 
        chapitres.id AS chapter_id, chapitres.titre AS chapter_title, chapitres.pdf_path 
        FROM modules 
        LEFT JOIN chapitres ON modules.id = chapitres.module_id 
        LEFT JOIN filiere ON modules.filiere_id = filiere.id";
$result = $conn->query($sql);

$modules = array();
while ($row = $result->fetch_assoc()) {
    if (!isset($modules[$row['module_id']])) {
        $modules[$row['module_id']] = array(
            'title' => $row['module_title'],
            'filiere' => $row['filiere_name'],
            'annee' => $row['annee'],
            'chapters' => array()
        );
    }
    if ($row['chapter_id']) {
        $modules[$row['module_id']]['chapters'][] = array(
            'id' => $row['chapter_id'],
            'title' => $row['chapter_title'],
            'pdf' => $row['pdf_path']
        );
    }
}
$conn->close();

foreach ($modules as $module_id => $module) {
    echo '<div class="module">';
    echo '<h3>' . htmlspecialchars($module['title']) . ' (' . htmlspecialchars($module['filiere']) . ' - ' . ($module['annee'] == 1 ? '1ère année' : '2ème année') . ')</h3>';
    echo '<form action="admin_delete_module.php" method="post" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer ce module ?\');">';
    echo '<input type="hidden" name="module_id" value="' . $module_id . '">';
    echo '<button type="submit">Supprimer</button>';
    echo '</form>';
    echo '<ul>';
    foreach ($module['chapters'] as $chapter) {
        echo '<li>';
        echo htmlspecialchars($chapter['title']);
        echo ' - <a href="' . htmlspecialchars($chapter['pdf']) . '" target="_blank">Voir le PDF</a>';
        echo ' <form action="admin_delete_chapter.php" method="post" style="display:inline;" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer ce chapitre ?\');">';
        echo '<input type="hidden" name="chapter_id" value="' . $chapter['id'] . '">';
        echo '<button type="submit">Supprimer</button>';
        echo '</form>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
}
?>
</body>
</html>

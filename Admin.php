<?php

@include 'Config.php';

session_start();

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
          <a href="Admin.php" class="nav-link active">
            <i class='bx bx-user icon'></i>
            <span class="link">Étudiants</span>
          </a>
        </li>
        <li class="list">
          <a href="actualite.php" class="nav-link">
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

<!--   *** etudiants section start ***   -->

<section id="etudiants">
    <h2>Liste des étudiants</h2>
    <a class="btn-etd-ajouter" href="Admin_ajout.php" role="button">Ajouter un étudiant</a>
    <br>
    <table class="table-etd">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>CNE</th>
                <th>Début d'étude </th>
                <th>Fin d'étude</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $sql = "SELECT e.id, 
            CONCAT(e.nom, ' ', e.prenom) AS nomComplet, 
            e.email, 
            e.cne, 
            e.annee_debut,
            e.annee_fin,
            f.nom AS filiereNom 
    FROM etudiant e
    JOIN filiere f ON e.filiereId = f.id";

$result = $conn->query($sql);

if (!$result) {
die("Invalid query: " . $conn->error);
}


            // Fetch and display each row of the result set
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nomComplet']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['cne']}</td>
                        <td>{$row['annee_debut']}</td>
                        <td>{$row['annee_fin']}</td>
                        <td>{$row['filiereNom']}</td>
                        <td>
                            <a class='btn-etd-mod' href='Admin_modifier.php?id={$row['id']}'>Modifier</a>
                            <a class='btn-etd-sup' href='Admin_supprimer.php?id={$row['id']}'>Supprimer</a>
                        </td>
                    </tr>
                ";
            }
        ?>
        </tbody>
    </table>
</section>

</body>
</html>

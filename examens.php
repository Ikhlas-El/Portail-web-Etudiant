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
    <style>
    .container {
            width: 80%;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            color: #363062;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], select, input[type="file"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #363062;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #btn_ajouter{
        margin-left: 250px;
        margin-right: 250px;
        }
        button:hover {
            background-color: #363062ea;
        }
        .exam-container {
            border: 1px solid #444;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            margin-left: 50px;
            margin-right: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .exam-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .exam-actions {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .exam-actions button {
            background-color: #e11010;
        }
        .exam-actions .edit-button {
            background-color: #363062;
        }
    </style>
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
          <a href="cours.php" class="nav-link">
            <i class="bx bx-folder-open icon"></i>
            <span class="link">Cours</span>
          </a>
        </li>
        <li class="list">
          <a href="examens.php" class="nav-link active">
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

<h2>Ajouter un Nouvel Examen</h2>
<form id="add-exam-form" method="post" enctype="multipart/form-data" action="admin_ajouter_examen.php">
    <label for="exam_title">Titre de l'Examen :</label>
    <input type="text" id="exam_title" name="exam_title" required>
    
    <label for="subject_title">Matière :</label>
    <input type="text" id="subject_title" name="subject_title" required>
    
    <label for="filiere_id">Filière :</label>
    <select id="filiere_id" name="filiere_id" required>
        <option value="1">DSI</option>
        <option value="2">SRI</option>
    </select>
    
    <label for="annee">Année :</label>
    <select id="annee" name="annee" required>
        <option value="2">2ème année</option>
    </select>
    
    <label for="pdf_path">Fichier PDF :</label>
    <input type="file" id="pdf_path" name="pdf_path" accept="application/pdf" required>
    
    <button id="btn_ajouter" type="submit">Ajouter</button>
</form>
<h2>Gérer Les Examens</h2>
        <div id="exam-list">
            <?php
            @include 'Config.php';

            $sql = "SELECT examen.id AS exam_id, examen.titre, examen.filiere_id, examen.annee, matiere.id AS matiere_id, matiere.matiere_title, matiere.pdf_path 
                    FROM examen 
                    JOIN matiere ON examen.id = matiere.exam_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="exam-container">';
                    echo '<div class="exam-info">';
                    echo '<strong>' . htmlspecialchars($row['titre']) . ' (' . htmlspecialchars($row['annee']) . ' - ' . htmlspecialchars($row['filiere_id']) . ')</strong>';
                    echo '<span>' . htmlspecialchars($row['matiere_title']) . ' <a href="' . htmlspecialchars($row['pdf_path']) . '" target="_blank">Voir Le PDF</a></span>';
                    echo '</div>';
                    echo '<div class="exam-actions">';
                    echo '<button onclick="deleteExam(' . $row['exam_id'] . ', ' . $row['matiere_id'] . ')">Supprimer</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'Aucun examen trouvé.';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function deleteExam(examId, matiereId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet examen ?')) {
                const formData = new FormData();
                formData.append('exam_id', examId);
                formData.append('matiere_id', matiereId);

                fetch('admin_delete_examen.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => console.error('Erreur:', error));
            }
        }
    </script>
</body>
</html>
<?php
// Start session and include configuration
session_start();
@include 'Config.php';

// Initialize variables
$modules = [];
$notes = [];

// Fetch all filieres for the dropdown
$filiereResult = mysqli_query($conn, "SELECT * FROM filiere");

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $cne = $_POST['cne'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $module_id = $_POST['module_id'];
        $note1 = $_POST['note1'];
        $note2 = $_POST['note2'];
        $note3 = $_POST['note3'];

        // Get student ID by CNE
        $studentResult = mysqli_query($conn, "SELECT id, annee_debut FROM etudiant WHERE cne = '$cne'");
        if (!$studentResult) {
            die('Query Error: ' . mysqli_error($conn));
        }
        $student = mysqli_fetch_assoc($studentResult);
        if (!$student) {
            die('No student found for CNE: ' . $cne);
        }
        $etudiantId = $student['id'];
        $annee_debut = $student['annee_debut'];

        // Validate if the semester exists in the database for the selected year
        $validateSemestreQuery = mysqli_query($conn, "SELECT id FROM semestre WHERE semestre = '$semester' AND anneeId = (SELECT id FROM annee WHERE annee = '$year')");
        if (!$validateSemestreQuery) {
            die('Error checking semester: ' . mysqli_error($conn));
        }
        $semestreRow = mysqli_fetch_assoc($validateSemestreQuery);
        if (!$semestreRow) {
            // Semester does not exist, attempt to insert it
            $insertSemesterQuery = mysqli_query($conn, "INSERT INTO semestre (semestre, anneeId) VALUES ('$semester', (SELECT id FROM annee WHERE annee = '$year'))");
            if (!$insertSemesterQuery) {
                die('Error inserting semester: ' . mysqli_error($conn));
            }
            $semestreId = mysqli_insert_id($conn); // Get the inserted semester ID
        } else {
            $semestreId = $semestreRow['id'];
        }

        // Insert new notes
        $insertNote1 = mysqli_query($conn, "INSERT INTO note (valeur, controle_num, etudiantId, moduleId, anneeId, semestreId) VALUES ('$note1', 1, '$etudiantId', '$module_id', (SELECT id FROM annee WHERE annee = '$year'), '$semestreId')");
        $insertNote2 = mysqli_query($conn, "INSERT INTO note (valeur, controle_num, etudiantId, moduleId, anneeId, semestreId) VALUES ('$note2', 2, '$etudiantId', '$module_id', (SELECT id FROM annee WHERE annee = '$year'), '$semestreId')");
        $insertNote3 = mysqli_query($conn, "INSERT INTO note (valeur, controle_num, etudiantId, moduleId, anneeId, semestreId) VALUES ('$note3', 3, '$etudiantId', '$module_id', (SELECT id FROM annee WHERE annee = '$year'), '$semestreId')");

        if (!$insertNote1 || !$insertNote2 || !$insertNote3) {
            die('Error inserting notes: ' . mysqli_error($conn));
        }

        // Optionally, you can redirect or perform other actions after successful insertion
        // header('Location: success.php');
        // exit();
    }
}

// Fetch the notes to display in the table
$notesResult = mysqli_query($conn, "SELECT note.id, etudiant.cne, note.valeur, note.controle_num, modules.titre AS module, annee.annee, semestre.semestre FROM note JOIN etudiant ON note.etudiantId = etudiant.id JOIN modules ON note.moduleId = modules.id JOIN annee ON note.anneeId = annee.id JOIN semestre ON note.semestreId = semestre.id");
while ($row = mysqli_fetch_assoc($notesResult)) {
    $notes[] = $row;
}

// Fetch modules based on selected filiere and year of study
if (isset($_POST['filiere_id']) && isset($_POST['year'])) {
    $filiere_id = $_POST['filiere_id'];
    $year = $_POST['year'];
    $modulesResult = mysqli_query($conn, "SELECT * FROM modules WHERE filiere_id = '$filiere_id' AND annee = '$year'");
    while ($row = mysqli_fetch_assoc($modulesResult)) {
        $modules[] = $row;
    }
}
?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTS Lissane Edinne Ibn Al-khatib Laayoune</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="BTS.CSS?v=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="BTS.JS"></script>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .admin-crud {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            justify-content: center;
        }
        .form-columns {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            max-width: 800px;
        }
        .form-column {
            width: 50%;
            box-sizing: border-box;
            padding: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 1rem;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            width: 20%;
            padding: 10px;
            background-color: #363062;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-left: 240px;
        }
        button:hover {
            background-color: #403974;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #333;
        }
        table,
        th,
        td {
            border: 1px solid #ccc;
        }
        th,
        td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #363062;
            color: white;
        }
        .crud-actions {
            display: flex;
            justify-content: space-between;
        }
        .crud-actions button {
            margin: 0 5px;
            flex-grow: 1;
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
                        <a href="notes.php" class="nav-link active">
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

    <div class="admin-crud">
        <form method="POST">
            <div class="form-columns">
                <div class="form-column">
                    <div class="form-group">
                        <label for="cne">CNE:</label>
                        <input type="text" id="cne" name="cne" required>
                    </div>
                    <div class="form-group">
                    <label for="year">Année d'étude:</label>
                    <select id="year" name="year" required>
                        <option value="1">1ère année</option>
                        <option value="2">2ème année</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semestre:</label>
                        <select id="semester" name="semester" required>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="module_id">Module:</label>
                        <select id="module_id" name="module_id" required>
                            <?php foreach ($modules as $module): ?>
                                <option value="<?php echo $module['id']; ?>"><?php echo $module['titre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="note1">Note Contrôle 1:</label>
                        <input type="number" id="note1" name="note1" required>
                    </div>
                    <div class="form-group">
                        <label for="note2">Note Contrôle 2:</label>
                        <input type="number" id="note2" name="note2" required>
                    </div>
                    <div class="form-group">
                        <label for="note3">Note Contrôle 3:</label>
                        <input type="number" id="note3" name="note3" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="action" value="add">Ajouter</button>
            </div>
        </form>
    </div>

    <div class="notes-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CNE</th>
                    <th>Note</th>
                    <th>Contrôle</th>
                    <th>Module</th>
                    <th>Année</th>
                    <th>Semestre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <td><?php echo $note['id']; ?></td>
                        <td><?php echo $note['cne']; ?></td>
                        <td><?php echo $note['valeur']; ?></td>
                        <td><?php echo $note['controle_num']; ?></td>
                        <td><?php echo $note['module']; ?></td>
                        <td><?php echo $note['annee']; ?></td>
                        <td><?php echo $note['semestre']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="BTS.js"></script>

    <script>
        // JS Code for menu and other UI interactions
        document.querySelector('.menu-icon').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('open');
        });
    </script>
</body>
</html>
<?php
// Start session and include configuration
session_start();
@include 'Config.php';

// Initialize variables
$isLoggedIn = false;
$nom_complet = 'Nom Complet Non Disponible';
$notes = []; // Initialize notes as empty array

// Check if student is logged in
if (isset($_SESSION['student_id'])) {
    $studentId = $_SESSION['student_id'];

    // Fetch student's full name
    $select_student = "SELECT nom, prenom FROM etudiant WHERE id = $studentId";
    $result_student = mysqli_query($conn, $select_student);

    if ($result_student && mysqli_num_rows($result_student) > 0) {
        $row_student = mysqli_fetch_assoc($result_student);
        $nom_complet = $row_student['nom'] . ' ' . $row_student['prenom'];
    }

    $isLoggedIn = true;

    // Fetch the years and semesters for the logged-in student
    $years = mysqli_query($conn, "SELECT * FROM annee");
    $semesters = mysqli_query($conn, "SELECT * FROM semestre");
}
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
    <link rel="stylesheet" href="BTS.CSS">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <script src="BTS.JS"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
            const nomComplet = <?php echo json_encode($nom_complet); ?>;

            if (!isLoggedIn) {
                alert('Vous devez vous connecter pour accéder à l\'espace étudiants.');
                window.location.href = 'Connecter.php'; // Redirect to login page if not logged in
            } else {
                document.getElementById('username').textContent = nomComplet;

                const espaceEtudiantLink = document.getElementById('espaceEtudiantLink');
                if (espaceEtudiantLink) {
                    espaceEtudiantLink.addEventListener('click', function(event) {
                        event.preventDefault();
                        const isLoggedInNow = <?php echo json_encode($isLoggedIn); ?>;
                        if (!isLoggedInNow) {
                            alert('Vous devez vous connecter pour accéder à l\'espace étudiants.');
                            window.location.href = 'Connecter.php'; // Redirect to login page if not logged in
                        } else {
                            const email = localStorage.getItem('email');
                            if (!email) {
                                alert('Email not found in local storage.');
                                return;
                            }
                            fetch('/pfecode/pfecode/login_espace.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ email: email })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    window.location.href = 'espace.php'; // Redirect to espace.php if access granted
                                } else {
                                    alert('Désolé, cet espace est réservé aux étudiants du BTS Laayoune.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Une erreur s\'est produite. Veuillez réessayer.');
                            });
                        }
                    });
                }
            }
        });
    </script>
</head>
<body>
<div class="dashboard">
        <div class="sidebar">
            <ul class="sidebar-menu"></ul>
            <div class="logout">
                <a href="logout_admin.php" class="quit-button"><i class="fas fa-sign-out-alt"></i> Quitter</a>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <h3>Bienvenue, <span id="username"><?php echo $nom_complet; ?></span></h3>
            </div>
            <div class="filters">
                <div class="filter-group">
                    <label for="year">Année :</label>
                    <select id="year" name="year">
                        <?php while ($row = mysqli_fetch_assoc($years)) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['annee']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="semester">Semestre :</label>
                    <select id="semester" name="semester">
                        <?php while ($row = mysqli_fetch_assoc($semesters)) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['semestre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <button id="searchButton" style="background-color:#363062; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='#2A2750'" onmouseout="this.style.backgroundColor='#363062'">Rechercher</button>
                </div>
            </div>
            <table id="notesTable">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>1er Contrôle</th>
                        <th>2ème Contrôle</th>
                        <th>3ème Contrôle</th>
                    </tr>
                </thead>
                <tbody id="notesTableBody" style="color: #363062;">
                    <!-- Table rows will be dynamically filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
            const nomComplet = <?php echo json_encode($nom_complet); ?>;

            if (!isLoggedIn) {
                alert('Vous devez vous connecter pour accéder à l\'espace étudiants.');
                window.location.href = 'Connecter.php';
            } else {
                document.getElementById('username').textContent = nomComplet;
            }

            const searchButton = document.getElementById('searchButton');
            const yearInput = document.querySelector('select[name="year"]');
            const semesterInput = document.querySelector('select[name="semester"]');

            if (searchButton && yearInput && semesterInput) {
                searchButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    searchNotes(yearInput.value, semesterInput.value);
                });
            } else {
                console.error('Search button, year input, or semester input not found');
            }
        });

        function searchNotes(year, semester) {
            fetch('search_notes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ year, semester })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    populateTable(data);
                }
            })
            .catch(error => console.error('Fetch error:', error));
        }

        function populateTable(data) {
    const table = document.getElementById('notesTable');
    const tbody = table.querySelector('tbody');
    tbody.innerHTML = '';

    data.forEach(note => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${note.module}</td>
            <td>${note.premierControle || '-'}</td>
            <td>${note.deuxiemeControle || '-'}</td>
            <td>${note.troisiemeControle || '-'}</td>
        `;
        tbody.appendChild(row);
    });
}

    </script>
</body>
</html>
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
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <ul class="sidebar-menu">
            </ul>
            <div class="logout">
                <a href="BTS.HTML" class="quit-button"><i class="fas fa-sign-out-alt"></i> Quitter</a>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <h3>Bienvenue, <span id="username">Ikhlas Elissaoui</span></h3>
            </div>
            <div class="filters">
                <div class="filter-group">
                    <label for="year">Année :</label>
                    <select id="year" name="year">
                        <option value="2022/2023">2022/2023</option>
                        <option value="2023/2024">2023/2024</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="semester">Semestre :</label>
                    <select id="semester" name="semester">
                        <option value="1">Semestre 1</option>
                        <option value="2">Semestre 2</option>
                    </select>
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
                <tbody>
                    <!-- Data will be populated here -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

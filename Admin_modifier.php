<?php
@include 'Config.php';

$id = "";
$nom = "";
$prenom = "";
$email = "";
$CNE = "";
$filiere = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: Admin.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM etudiant WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: Admin.php");
        exit;
    }

    // Populate form fields with current values
    $nom = $row["nom"];
    $prenom = $row["prenom"];
    $email = $row["email"];
    $CNE = $row["CNE"];
    $filiere = $row["filiereId"]; // Assuming this is the foreign key ID
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $CNE = $_POST["CNE"];
    $filiere = $_POST["filiere"];

    do {
        if (empty($nom) || empty($prenom) || empty($email) || empty($CNE) || empty($filiere)) {
            $errorMessage = "Remplissez tous les champs.";
            break;
        }

        // Validate if $filiere exists in the filiere table
        $validateSql = "SELECT id FROM filiere WHERE id='$filiere'";
        $validateResult = $conn->query($validateSql);

        if ($validateResult->num_rows == 0) {
            $errorMessage = "La filière sélectionnée n'existe pas.";
            break;
        }

        // Update student record
        $sql = "UPDATE etudiant SET nom='$nom', prenom='$prenom', email='$email', CNE='$CNE', filiereId='$filiere' WHERE id='$id'";
        
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Étudiant mis à jour avec succès";
        } else {
            $errorMessage = "Erreur lors de la mise à jour de l'étudiant : " . $conn->error;
        }

    } while (false);
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTS Lissane Edinne Ibn Al-khatib Laayoune</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="BTS.CSS?v=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"/>
    <script src="BTS.JS"></script>
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
<div class="etd-container">
    <h2>Nouveau étudiant</h2>

    <?php 
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row-etd">
            <label class="col-etd-label">Nom</label>
            <div class="col-etd-2">
                <input type="text" class="col-etd-value" name="nom" value="<?php echo $nom ?>">
            </div>
        </div>
        <div class="row-etd">
            <label class="col-etd-label">Prenom</label>
            <div class="col-etd-2">
                <input type="text" class="col-etd-value" name="prenom" value="<?php echo $prenom ?>">
            </div>
        </div>
        <div class="row-etd">
            <label class="col-etd-label">Email</label>
            <div class="col-etd-2">
                <input type="email" class="col-etd-value" name="email" value="<?php echo $email ?>">
            </div>
        </div>
        <div class="row-etd">
            <label class="col-etd-label">CNE</label>
            <div class="col-etd-2">
                <input type="text" class="col-etd-value" name="CNE" value="<?php echo $CNE ?>">
            </div>
        </div>
        <div class="row-etd">
            <label class="col-etd-label">Filière</label>
            <div class="col-etd-2">
                <label><input type="radio" name="filiere" value="1" <?php echo ($filiere == '1') ? 'checked' : ''; ?>> DSI</label>
                <label><input type="radio" name="filiere" value="2" <?php echo ($filiere == '2') ? 'checked' : ''; ?>> SRI</label>
            </div>
        </div>

        <?php 
        if (!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='btn-etd-ajout'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>

        <div class="row-etd">
            <div class="btn-etd-ajout">
                <button type="submit" class="btn-etd-submit1">Ajouter</button>
            </div>
            <div class="btn-etd-ajout">
                <a class="btn-etd-cancel" href="Admin.php" role="button">Annuler</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>

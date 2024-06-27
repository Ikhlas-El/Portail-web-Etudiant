<?php
@include 'Config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = md5($password);

    // Check for admin
    $select_admin = "SELECT * FROM administrateur WHERE email = '$email' AND motDePasse = '$password'";
    $result_admin = mysqli_query($conn, $select_admin);

    if ($result_admin && mysqli_num_rows($result_admin) > 0) {
        $row_admin = mysqli_fetch_array($result_admin);
        $_SESSION['admin_name'] = $row_admin['nom'];
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['email'] = $row_admin['email'];
        header('Location: Admin.php');
        exit();
    } else {
        // Check for etudiant
        $select_user = "SELECT * FROM etudiant WHERE email = '$email' AND motDePasse = '$password'";
        $result_user = mysqli_query($conn, $select_user);

        if ($result_user && mysqli_num_rows($result_user) > 0) {
            $row_user = mysqli_fetch_array($result_user);
            $_SESSION['user_name'] = $row_user['nom'];
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['email'] = $row_user['email'];
            $_SESSION['student_id'] = $row_user['id'];
            echo "<script>
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('email', '{$row_user['email']}');
                </script>";
                $success_message = '<span style="color: #bba460;">Vous êtes connecté en tant qu\'étudiant! Vous pouvez accéder à votre espace étudiant.</span>';
        } else {
            // Check for utilisateur
            $select_user = "SELECT * FROM utilisateur WHERE email = '$email' AND motDePasse = '$hashed_password'";
            $result_user = mysqli_query($conn, $select_user);

            if ($result_user && mysqli_num_rows($result_user) > 0) {
                $row_user = mysqli_fetch_array($result_user);
                $_SESSION['user_name'] = $row_user['nom'];
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['email'] = $row_user['email'];
                echo "<script>
                        localStorage.setItem('isLoggedIn', 'true');
                        localStorage.setItem('email', '{$row_user['email']}');
                    </script>";
                    $success_message = '<span style="color: #bba460;">Vous êtes connecté!</span>';
            } else {
                $error[] = 'Email ou mot de passe incorrect !';
            }
        }
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" 
    rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="BTS.CSS?v=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="BTS.JS"></script>
</head>
<body>
    <div id="logo">
        <img src="images/BTS.png" alt="">
    </div>
    <nav>
        <div class="navigation">
            <ul class="nav-list">
                <li><a class="nav" href="BTS.php">Accueil</a></li>
                <li class="nav-item nav-item-dropdown">
                    <div class="dropdown">
                        <a class="nav" href="#" onclick="return false;">Cours</a>
                        <i class="fas fa-solid fa-chevron-up dropdown_arrow"></i>
                        <div class="dropdown-content">
                            <a href="CDsi.php">Dsi</a>
                            <a href="CSri.php">Sri</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-item-dropdown">
                    <div class="dropdown">
                        <a class="nav" href="#" onclick="return false;">Examens</a>
                        <i class="fas fa-solid fa-chevron-up dropdown_arrow"></i>
                        <div class="dropdown-content">
                            <a href="EDsi.php">Dsi</a>
                            <a href="ESri.php">Sri</a>
                        </div>
                    </div>
                </li>
                <li><a class="nav" href="apropos.html">A propos nous</a></li>
                <li><a class="nav" href="Contact_us.html">Contact</a></li>
                <li><a class="nav" href="Inscrire.php">S'inscrire</a></li>
                <li><a class="nav active" href="Connecter.php">Se connecter</a></li>
                <li><a class="nav" id="espaceEtudiantLink" href="#">Espace étudiant</a></li>
            </ul>
            <div class="menu-btn">
                <span></span>
            </div>
        </div>
    </nav>

    <div class="con">
        <div class="form-container">
            <form class="inscrire_form" action="Connecter.php" method="post">
                <h2>Se connecter</h2>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    }
                }
                if (isset($success_message)) {
                    echo '<span class="success-msg">' . $success_message . '</span>';
                }
                ?>
                <input type="email" name="email" required placeholder="E-mail">
                <input type="password" name="password" required placeholder="Mot de passe">
                <input type="submit" name="submit" value="Connecter" class="form-btn">
                <p>Vous n’avez pas de compte ? <a href="Inscrire.php">Inscrivez-vous</a></p>
            </form>
        </div>
    </div>
</body>
</html>
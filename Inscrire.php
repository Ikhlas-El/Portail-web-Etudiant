<?php
@include 'Config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $fname = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    $select = "SELECT * FROM utilisateur WHERE email = '$email' && motDePasse = '$pass'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'Vous avez déjà un compte !';
    } else {
        if ($pass != $cpass) {
            $error[] = 'mot de passe ne correspond pas !';
        } else {
            $insert = "INSERT INTO utilisateur(nom, prenom, email, motDePasse) VALUES('$name','$fname','$email','$pass')";
            mysqli_query($conn, $insert);
            header('location:Connecter.php');
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
            <ul  class="nav-list">
                <li><a class="nav"  href="BTS.php">Accueil</a></li>

                <!--dropdown menu 1-->


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

                <!--dropdown menu 2-->

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

                <!--dropdown menu END-->
                
                <li><a class="nav" href="apropos.html">A propos nous</a></li>
                <li><a class="nav" href="Contact_us.html">Contact</a></li>
                <li><a class="nav active" href="Inscrire.php">S'inscrire</a></li>
                <li><a class="nav" href="Connecter.php">Se connecter</a></li>
                <li><a class="nav" id="espaceEtudiantLink" href="#">Espace étudiant</a></li>
            </ul>
            <div class="menu-btn">
                <span></span>
            </div>
        </div>  
    </nav>
    

<div class="insc">
<div class="form-container">

<form class="inscrire_form" action="" method="post">
    <h2>S'inscrire</h2>
    <?php
        if(isset($error)){
        foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
        };
    };
    ?>
    <input type="text" name="name" required placeholder="Nom">
    <input type="text" name="prenom" required placeholder="Prenom">
    <input type="email" name="email" required placeholder="E-mail">
    <input type="password" name="password" required placeholder="Mot de passe">
    <input type="password" name="cpassword" required placeholder="confirmez votre mot de passe">
    <input type="submit" name="submit" value="s'inscrire" class="form-btn">
    <p>vous avez déjà un compte ? <a href="Connecter.php">connectez-vous</a></p>
</form>

</div>
</div>



</body>
</html>
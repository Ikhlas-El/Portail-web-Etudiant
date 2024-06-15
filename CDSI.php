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
    <link rel="stylesheet" href="BTS.CSS">
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
                <li><a class="nav"  href="BTS.HTML">Accueil</a></li>

                <!--dropdown menu 1-->


                <li class="nav-item nav-item-dropdown">
                    <div class="dropdown">
                        <a class="nav active disabled" href="#" onclick="return false;">Cours</a>
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
                    <a class="nav disabled" href="#" onclick="return false;">Examens</a>
                    <i class="fas fa-solid fa-chevron-up dropdown_arrow"></i>
                    <div class="dropdown-content">
                        <a href="EDsi.php">Dsi</a>
                        <a href="ESri.php">Sri</a>
                    </div>
                </div>
                </li>

                <!--dropdown menu END-->
                
                <li><a class="nav" href="apropos.html">A propos nous</a></li>
                <li><a class="nav" href="Contact.php">Contact</a></li>
                <li><a class="nav" href="Seconnecter.html">Se connecter</a></li>
                <li><a class="nav" href="Espétudiant.html">Espace étudiant</a></li>
            </ul>
            <div class="menu-btn">
                <span></span>
            </div>
        </div>  
    </nav>






</section>
</body>
</html>
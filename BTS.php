<?php

@include 'Config.php';
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="BTS.CSS">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="icon" type="image/png" href="images/favicon.png">
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
                <li><a class="nav active" href="#Accueil">Accueil</a></li>

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
                <li><a class="nav" href="Inscrire.php">S'inscrire</a></li>
                <li><a class="nav" href="Connecter.php">Se connecter</a></li>
                <li><a class="nav" id="espaceEtudiantLink" href="#">Espace étudiant</a></li>
            </ul>
            <div class="menu-btn">
                <span></span>
            </div>
        </div>
    </nav>
    <section id="Accueil"></section>
    <!--image slide -->

    <section id="actualite">
        <h2>Actualités</h2>
        <br>
        <hr>
        <div class="actualite-box">
            <?php
            include 'Config.php';
            $result = $conn->query("SELECT * FROM actualite");
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                echo '<div class="actualite" style="display: ' . ($count < 3 ? 'block' : 'none') . ';">';
                if ($row['pdf_path']) {
                    echo '<a href="' . $row['pdf_path'] . '" target="_blank">';
                    echo '<img src="' . $row['image_path'] . '" alt="' . $row['title'] . '">';
                    echo '</a>';
                } else {
                    echo '<img src="' . $row['image_path'] . '" alt="' . $row['title'] . '">';
                }
                echo '</div>';
                $count++;
            }
            $conn->close();
            ?>
        </div>
        <br>
        <button class="button-1" role="button">Voir plus</button>
        <br>
        <hr>
    </section>






    <!--features start  -->


    <section id="features">
        <h1>Centre BTS Laayoune</h1>
        <br>
        <p>Formation de deux ans visant à préparer des techniciens supérieurs.</p>
        <br>
        <div class="fea-base">
            <div class="fea-box">
                <i class="fas fa-graduation-cap"></i>
                <h3>Diplômes reconnus et valorisés</h3>
            </div>
            <div class="fea-box">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3>Encadrement personnalisé et suivi individualisé des étudiants</h3>
            </div>
            <div class="fea-box">
                <i class="fas fa-check-circle"></i>
                <h3>Formation solide et rigoureuse</h3>
            </div>
        </div>
    </section>







    <!-- review section starts -->

    <section class="review" id="review">

        <h2 class="heading">Témoignages d'anciens étudiants</h2>

        <div class="swiper review-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <p>Le programme DSI a été une véritable aventure d’apprentissage pour moi.
                        Il m’a non seulement préparée pour une licence en informatique,
                        mais m’a aussi permis de développer une solide base de compétences. Les enseignants, compétents et dévoués,
                        ont rendu l’apprentissage agréable et stimulant.</p>
                    <br>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <div class="user-info-fe">
                            <h3>ancienne Étudiante - Spécialité DSI</h3>
                        </div>
                        <div class="promotion">
                            <h3>Promotion: 2019</h3>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>Grâce au BTS j’ai pu intégrer une prestigieuse école d’ingénieur.
                        Les compétences techniques et théoriques que j’ai acquises durant
                        ma formation m’ont donné une longueur d’avance et m’ont permis de me distinguer.</p>
                    <br>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <div class="user-info">
                            <h3>ancien Étudiant - Spécialité DSI</h3>
                        </div>
                        <div class="promotion">
                            <h3>Promotion : 2018</h3>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>Le BTS SRI a été le tremplin de ma carrière en réseau.
                        L’ambiance d’apprentissage était incomparable,
                        favorisant la collaboration et l’innovation. Aujourd’hui,
                        je travaille en tant que technicien réseau et je suis reconnaissant pour la formation solide que j’ai reçue.</p>
                    <br>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <div class="user-info">
                            <h3>ancien Étudiant - Spécialité SRI</h3>
                        </div>
                        <div class="promotion">
                            <h3>Promotion: 2016</h3>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <p>La formation SRI a été une expérience transformatrice pour moi.
                        Elle m’a non seulement préparée à une carrière réussie en tant que spécialiste réseau,
                        mais elle a également élargi ma perspective sur le domaine de réseau.
                        Les enseignants dévoués et l’environnement d’apprentissage stimulant ont rendu cette expérience inoubliable.
                        Aujourd’hui, je suis fière de dire que je suis une ancienne élève de ce programme.</p>
                    <br>
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <div class="user-info-fe">
                            <h3>ancienne Étudiante - Spécialité SRI</h3>
                        </div>
                        <div class="promotion">
                            <h3>Promotion: 2020</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>



    <!--   *** Footer Section Starts ***   -->
    <section class="footer" id="footer">

        <div class="footer-contents">

            <div class="footer-col footer-col-1">
                <div class="col-contents">
                    <div class="col-title">
                        <h3>A propos de nous</h3>
                    </div>
                    <p>BTS Lissane Edinne Ibn Al-Khatib est une plateforme d'apprentissage en ligne destinée aux étudiants.</p>
                    <p>Elle leur permet d'accéder à des informations et à des ressources pour rester à jour, tout en offrant aux nouveaux étudiants un aperçu de l'établissement et du processus d'admission.</p>
                </div>
            </div>

            <div class="footer-col footer-col-2">
                <div class="col-title">
                    <h3>Contact</h3>
                </div>
                <div class="col-contents">
                    <div class="contact-row">
                        <span><i class="fas fa-map-marker-alt"></i> Address</span>
                        <span><a href="https://maps.google.com/?q=Oum+Saad,+Laayoune" target="_blank">Oum Saad, Laayoune</a></span>
                    </div>
                    <div class="contact-row">
                        <span><i class="fas fa-phone"></i> Telephone</span>
                        <span><a href="tel:+212528892338">05 28 89 23 38</a></span>
                    </div>
                    <div class="contact-row">
                        <span><i class="fas fa-fax"></i> Fax</span>
                        <span><a href="tel:+212528990024">05 28 99 00 24</a></span>
                    </div>
                    <div class="contact-row">
                        <span><i class="fas fa-envelope"></i> Email</span>
                        <span><a href="mailto:qual.lisanddine@gmail.com">qual.lisanddine@gmail.com</a></span>
                    </div>
                    <div class="contact-row">
                        <span><i class="fab fa-facebook-f"></i> Facebook</span>
                        <span><a href="https://www.facebook.com/BTSLaayoune" target="_blank">BTS Laayoune</a></span>
                    </div>
                </div>
            </div>


            <div class="footer-col footer-col-3">
                <div class="col-title">
                    <h3>Navigation</h3>
                </div>
                <div class="col-contents">
                    <a href="#Accueil">Accueil</a>
                    <a href="#actualite">Actualité</a>
                    <a href="#review">Témoignages</a>
                    <a href="Contact_us.html">Contact</a>
                    <a href="apropos.html#FAQ">FAQ</a>
                    <a href="apropos.html">A propos nous</a>
                </div>
            </div>

            <div class="copy-rights">
                <p>Created By <b>BTS Lissane Edinne Ibn Al-khatib</b> All Rights Are Reserved</p>
            </div>
        </div>
</body>

</html>
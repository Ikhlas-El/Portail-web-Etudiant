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
            <ul  class="nav-list">
                <li><a class="nav"  href="BTS.php">Accueil</a></li>

                <!--dropdown menu 1-->


                <li class="nav-item nav-item-dropdown">
                    <div class="dropdown">
                        <a class="nav active disabled" href="#" onclick="return false;">Cours</a>
                        <i class="fas fa-solid fa-chevron-up dropdown_arrow"></i>
                        <div class="dropdown-content">
                            <a href="CDSI.php">Dsi</a>
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


        <!--cours 1 are anne -->


        <section id="cours-sri1">
    <div class="box">
        <h2>Modules 1ère année - SRI</h2>
        <div class="cours-container">
            <?php
            @include 'Config.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT modules.id AS module_id, modules.titre AS module_title, chapitres.id AS chapter_id, chapitres.titre AS chapter_title, chapitres.pdf_path 
                    FROM modules 
                    LEFT JOIN chapitres ON modules.id = chapitres.module_id
                    WHERE modules.filiere_id = 2 AND modules.annee = 1";
            $result = $conn->query($sql);

            $modules = array();
            while ($row = $result->fetch_assoc()) {
                if (!isset($modules[$row['module_id']])) {
                    $modules[$row['module_id']] = array(
                        'title' => $row['module_title'],
                        'chapters' => array()
                    );
                }
                if ($row['chapter_id']) {
                    $modules[$row['module_id']]['chapters'][] = array(
                        'title' => $row['chapter_title'],
                        'pdf' => $row['pdf_path']
                    );
                }
            }

            foreach ($modules as $moduleId => $module) {
                echo '<div class="cour-container">';
                echo '<div class="cour">';
                echo '<p>' . htmlspecialchars($module['title']) . '</p>';
                echo '<button type="button" class="question-button" onclick="toggleChapitres(' . $moduleId . ')">';
                echo '<span class="show-answer"><i class="fas fa-angle-down"></i></span>';
                echo '<span class="hide-answer hidden"><i class="fas fa-angle-up"></i></span>';
                echo '</button>';
                echo '</div>';
                if (!empty($module['chapters'])) {
                    echo '<div class="chapitres" id="chapitres-' . $moduleId . '">';
                    foreach ($module['chapters'] as $chapter) {
                        echo '<li><a href="' . htmlspecialchars($chapter['pdf']) . '">' . htmlspecialchars($chapter['title']) . '</a></li>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="chapitres" id="chapitres-' . $moduleId . '"></div>';
                }
                echo '</div>';
            }

            $conn->close();
            ?>
        </div>
    </div>
</section>

<section id="cours-sri2">
    <div class="box">
        <h2>Modules 2ème année - SRI</h2>
        <div class="cours-container">
            <?php
            @include 'Config.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT modules.id AS module_id, modules.titre AS module_title, chapitres.id AS chapter_id, chapitres.titre AS chapter_title, chapitres.pdf_path 
                    FROM modules 
                    LEFT JOIN chapitres ON modules.id = chapitres.module_id
                    WHERE modules.filiere_id = 2 AND modules.annee = 2";
            $result = $conn->query($sql);

            $modules = array();
            while ($row = $result->fetch_assoc()) {
                if (!isset($modules[$row['module_id']])) {
                    $modules[$row['module_id']] = array(
                        'title' => $row['module_title'],
                        'chapters' => array()
                    );
                }
                if ($row['chapter_id']) {
                    $modules[$row['module_id']]['chapters'][] = array(
                        'title' => $row['chapter_title'],
                        'pdf' => $row['pdf_path']
                    );
                }
            }

            foreach ($modules as $moduleId => $module) {
                echo '<div class="cour-container">';
                echo '<div class="cour">';
                echo '<p>' . htmlspecialchars($module['title']) . '</p>';
                echo '<button type="button" class="question-button" onclick="toggleChapitres(' . $moduleId . ')">';
                echo '<span class="show-answer"><i class="fas fa-angle-down"></i></span>';
                echo '<span class="hide-answer hidden"><i class="fas fa-angle-up"></i></span>';
                echo '</button>';
                echo '</div>';
                if (!empty($module['chapters'])) {
                    echo '<div class="chapitres" id="chapitres-' . $moduleId . '">';
                    foreach ($module['chapters'] as $chapter) {
                        echo '<li><a href="' . htmlspecialchars($chapter['pdf']) . '">' . htmlspecialchars($chapter['title']) . '</a></li>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="chapitres" id="chapitres-' . $moduleId . '"></div>';
                }
                echo '</div>';
            }

            $conn->close();
            ?>
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
				<a href="BTS.php">Accueil</a>
				<a href="BTS.php#actualite">Actualité</a>
                <a href="BTS.php#review">Témoignages</a>
				<a href="Contact_us.html">Contact</a>
				<a href="#FAQ">FAQ</a>
                <a href="apropos.html">A propos nous</a>
			</div>
		</div>

        <div class="copy-rights">
            <p>Created By <b>BTS Lissane Edinne Ibn Al-khatib</b> All Rights Are Reserved</p>
        </div>
	</div>


</body>
</html>
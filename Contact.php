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
                        <a class="nav" href="Cours.html">Cours</a>
                        <i class="fas fa-solid fa-chevron-up dropdown_arrow"></i>
                        <div class="dropdown-content">
                            <a href="CDsi.html">Dsi</a>
                            <a href="CSri.html">Sri</a>
                        </div>
                    </div>
                    </li>

                <!--dropdown menu 2-->

                <li class="nav-item nav-item-dropdown">
                <div class="dropdown">
                    <a class="nav" href="Examens.html">Examens</a>
                    <i class="fas fa-solid fa-chevron-up dropdown_arrow"></i>
                    <div class="dropdown-content">
                        <a href="EDsi.html">Dsi</a>
                        <a href="ESri.html">Sri</a>
                    </div>
                </div>
                </li>

                <!--dropdown menu END-->
                
                <li><a class="nav" href="apropos.html">A propos nous</a></li>
                <li><a class="nav active" href="Contact.php">Contact</a></li>
                <li><a class="nav" href="Seconnecter.html">Se connecter</a></li>
                <li><a class="nav" href="inscrire.html">S'inscrire</a></li>
                <li><a class="nav" href="Espétudiant.html">Espace étudiant</a></li>
            </ul>
            <div class="menu-btn">
                <span></span>
            </div>
        </div>  
    </nav>


                <!--Form begin-->    

<section id="contact">
<div class="wrapper">
    <h2>Envoyer un Message</h2>
    <form action="#">
    <div class="dbl-field">
        <div class="field">
        <input type="text" name="name" placeholder="Nom complet">
        <i class='fas fa-user'></i>
        </div>
        <div class="field">
        <input type="text" name="email" placeholder="Email">
        <i class='fas fa-envelope'></i>
        </div>
    </div>
    <div class="dbl-field">
        <div class="field">
        <input type="text" name="phone" placeholder="Téléphone">
        <i class='fas fa-phone-alt'></i>
        </div>
    </div>
    <div class="message">
        <textarea placeholder="Message" name="message"></textarea>
        <i class="fas fa-solid fa-comment"></i>
    </div>
    <div class="button-area">
        <button type="submit">Envoyer</button>
        <span></span>
    </div>
    </form>
</div>

</section>


                <!--Form End-->  


<!--   *** Footer Section Starts ***   -->
<section class="footer" id="footer">
	
	<div class="footer-contents">
		
		<div class="footer-col footer-col-1">
			<div class="col-contents">
                <div class="col-title">
                    <h3>A propos de nous</h3>
                </div>
				<p>BTS Lissane Edinne Ibn Al-Khatib est une plateforme d’apprentissage en ligne pour les étudiants.</p>
				<p>Il offre un accès à des informations et des ressources aide les étudiants à rester à jour et donne aux nouveaux étudiants un aperçu de l’établissement et du processus d’admission.</p>
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
				<a href="BTS.HTML#Accueil">Accueil</a>
				<a href="BTS.HTML#actualite">Actualité</a>
                <a href="BTS.HTML#review">Témoignages</a>
				<a href="Contact.php">Contact</a>
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

//Contact Form in PHP
<?php
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $website = htmlspecialchars($_POST['website']);
  $message = htmlspecialchars($_POST['message']);

  if(!empty($email) && !empty($message)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $receiver = "ikhlaselissaoui6@gmail.com"; //enter that email address where you want to receive all messages
      $subject = "From: $name <$email>";
      $body = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage:\n$message\n\nRegards,\n$name";
      $sender = "From: $email";
      if(mail($receiver, $subject, $body, $sender)){
         echo "Your message has been sent";
      }else{
         echo "Sorry, failed to send your message!";
      }
    }else{
      echo "Enter a valid email address!";
    }
  }else{
    echo "Email and message field is required!";
  }
?>


window.onload = function(){
var swiper = new Swiper(".review-slider", {
  spaceBetween: 20,
  centeredSlides: true,
  grabCursor: true,
  autoplay: {
    delay: 7500,
    disableOnInteraction: false,
  },
  loop: true,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    991: {
      slidesPerView: 3,
    },
  },
});


// responsive menu burger

var menuBtn = document.querySelector('.navigation  .menu-btn');
var menuList = document.querySelector('.navigation .nav-list');
var menuListItems = document.querySelectorAll('.nav-list li a');

menuBtn.addEventListener('click', function(){
	menuBtn.classList.toggle('active');
	menuList.classList.toggle('active');
});

for(var i = 0; i < menuListItems.length; i++){
	menuListItems[i].addEventListener('click', menuItemClicked);
}
function menuItemClicked(){
	menuBtn.classList.remove('active');
	menuList.classList.remove('active');
}
}

// ajouter les actualites par 3

document.addEventListener('DOMContentLoaded', function() {
  const button = document.querySelector('.button-1');
  if (button) {
    button.addEventListener('click', toggleMoreContent);
  } else {
    console.error("not found!");
  }
});

let revealedImages = 0;

function toggleMoreContent() {
    const actualites = document.querySelectorAll('.actualites');

    revealedImages += 3;

    for (let i = 0; i < revealedImages && i < actualites.length; i++) {
        actualites[i].style.display = 'block';
    }

    if (revealedImages >= actualites.length) {
        document.querySelector('.button-1').style.display = 'none';
    }
}


// FAQ part for a propos nous

document.addEventListener('DOMContentLoaded', function () {
  const questionContainers = document.querySelectorAll('.question-container');

  questionContainers.forEach(container => {
      const question = container.querySelector('.question');
      const answer = container.querySelector('.answer');

      question.addEventListener('click', function () {
          container.classList.toggle('active');
      });
  });
});





// Contact us 
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('contactForm');
  const statusMessage = document.getElementById('statusMessage');

  form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission

      statusMessage.textContent = 'Envoi en cours...';
      statusMessage.style.color = '#BBA460';

      const formData = new FormData(form);

      fetch('Contact_us.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              statusMessage.textContent = data.message;
              statusMessage.style.color = '#363062';
              form.reset(); // Reset the form fields
          } else {
              statusMessage.textContent = data.message;
              statusMessage.style.color = 'red';
          }
      })
      .catch(error => {
          statusMessage.textContent = 'Erreur lors de l\'envoi du message';
          statusMessage.style.color = 'red';
      });
  });

  // Clear the form and status message when navigating back
  window.addEventListener('pageshow', function(event) {
      if (event.persisted) {
          form.reset();
          statusMessage.textContent = '';
      }
  });
});


 // espce etudiant login code 

document.addEventListener('DOMContentLoaded', function() {
    const espaceEtudiantLink = document.getElementById('espaceEtudiantLink');
    if (espaceEtudiantLink) {
        espaceEtudiantLink.addEventListener('click', function(event) {
            event.preventDefault();

            // Check if user is logged in
            const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
            if (!isLoggedIn) {
                alert('Vous devez vous connecter pour accéder à espace étudiants.');
                return;
            }

            // If logged in, check if user is a student of BTS Laayoune
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
            .then(response => response.text())  // Changed to .text() to inspect the actual response
            .then(text => {
                console.log('Response Text:', text); // Log the raw response
                try {
                    const data = JSON.parse(text); // Parse the JSON manually
                    if (data.status === 'success') {
                        window.location.href = 'espace.php'; // Redirect to espace.php
                    } else {
                        alert('Désolé, cet espace est réservé aux étudiants du BTS Laayoune.');
                    }
                } catch (error) {
                    console.error('Parsing error:', error);
                    alert('Une erreur s\'est produite. Veuillez réessayer.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur s\'est produite. Veuillez réessayer.');
            });
        });
    }
});




// Wait for DOM content to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
  // Select necessary DOM elements
  const navBar = document.querySelector(".custom-nav");
  const menuBtns = document.querySelectorAll(".menu-icon");
  const overlay = document.querySelector(".custom-overlay");

  // Add click event listeners to each menu icon
  menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
          // Toggle the 'open' class on navBar to show/hide the sidebar
          navBar.classList.toggle("open");
      });
  });

  // Adding click event listener to the overlay to close the sidebar
  overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
  });
});

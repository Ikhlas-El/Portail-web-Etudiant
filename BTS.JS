

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









































document.addEventListener("DOMContentLoaded", () => {
  const yearSelect = document.getElementById('year');
  const semesterSelect = document.getElementById('semester');

  yearSelect.addEventListener('change', fetchNotes);
  semesterSelect.addEventListener('change', fetchNotes);

  function fetchNotes() {
      const year = yearSelect.value;
      const semester = semesterSelect.value;

      fetch(`get_notes.php?year=${year}&semester=${semester}`)
          .then(response => response.json())
          .then(data => populateTable(data))
          .catch(error => console.error('Error:', error));
  }

  function populateTable(data) {
      const tableBody = document.querySelector('#notesTable tbody');
      tableBody.innerHTML = '';

      data.forEach(note => {
          const row = document.createElement('tr');
          row.innerHTML = `
              <td>${note.module}</td>
              <td>${note.control1}</td>
              <td>${note.control2}</td>
              <td>${note.control3}</td>
          `;
          tableBody.appendChild(row);
      });
  }

  // Initial fetch
  fetchNotes();
});

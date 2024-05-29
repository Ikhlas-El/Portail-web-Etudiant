

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






// Contact code 

const form = document.querySelector("form"),
statusTxt = form.querySelector(".button-area span");
form.onsubmit = (e)=>{
  e.preventDefault();
  statusTxt.style.color = "#0D6EFD";
  statusTxt.style.display = "block";
  statusTxt.innerText = "Sending your message...";
  form.classList.add("disabled");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "message.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState == 4 && xhr.status == 200){
      let response = xhr.response;
      if(response.indexOf("required") != -1 || response.indexOf("valid") != -1 || response.indexOf("failed") != -1){
        statusTxt.style.color = "red";
      }else{
        form.reset();
        setTimeout(()=>{
          statusTxt.style.display = "none";
        }, 3000);
      }
      statusTxt.innerText = response;
      form.classList.remove("disabled");
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
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













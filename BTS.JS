

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


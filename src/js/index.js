// navbar menu
function navBar() {
  var x = document.getElementById("category-con");
  if (x.className === "category-container") {
    x.className += " responsive";
  } else {
    x.className = "category-container";
  }
}

// scrolling top btn 
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("topbtn").style.display = "block";
  } else {
    document.getElementById("topbtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// ads carousel
const track = document.querySelector('.carousel__track-container');
const slides = Array.from(track.children);
const nextbutton = document.querySelector('.button_carousel--right');
const prevbutton = document.querySelector('.button_carousel--left');
const squareNav = document.querySelector('.carousel-nav');
const square = Array.from(squareNav.children);

const slideWidth = slides[0].getBoundingClientRect().width;


// arrange the slides next to one another
const setSlidePosition = (slide, index) => {
  slide.style.left = slideWidth * index + 'px';
}

slides.forEach(setSlidePosition);



// FUNCTION
const moveToSlide = (track, currentSlide, targetSlide) => {
  track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
  currentSlide.classList.remove('current-slide');
  targetSlide.classList.add('current-slide');
}

const updatesquare = (currentSquare, targetSquare) => {
  currentSquare.classList.remove('current-slide');
  targetSquare.classList.add('current-slide');
}

const hideShowArrows = (slide, prevbutton, nextbutton, targetIndex) => {
  if (targetIndex === 0) {
    prevbutton.classList.add('is-hidden');
    nextbutton.classList.remove('is-hidden');
  } else if (targetIndex === slides.length - 1){
    prevbutton.classList.remove('is-hidden');
    nextbutton.classList.add('is-hidden');
  } else{
    prevbutton.classList.remove('is-hidden');
    nextbutton.classList.remove('is-hidden');
  }
}

// when i click right, move slides to the right
prevbutton.addEventListener('click', e =>{
  const currentSlide = track.querySelector('.current-slide');
  track.style.transition = "transform 0.5s ease-in-out";
  const prevSlide = currentSlide.previousElementSibling;
  const currentSquare = squareNav.querySelector('.current-slide');

  // const prevSquare = currentSquare.previousElementSibling;
  moveToSlide(track, currentSlide, prevSlide);
  // updatesquare(currentSquare, prevSquare);
})

// when i click right, move slides to the left
nextbutton.addEventListener('click', e => {
  const currentSlide = track.querySelector('.current-slide');
  const nextSlide = currentSlide.nextElementSibling;
  track.style.transition = "transform 0.5s ease-in-out";
  // const currentSquare = squareNav.querySelector('.current-slide');
  // const nextSquare = currentSquare.nextElementSibling;

  moveToSlide(track, currentSlide, nextSlide);
  // updatesquare(currentSquare, nextSquare);
})

squareNav.addEventListener('click', e =>{
  const targetSquare = e.target.closest('button');
  
  if(!targetSquare) return;

  const currentSlide = track.querySelector('.current-slide');
  const currentSquare = squareNav.querySelector('.current-slide');
  const targetIndex = square.findIndex(square => square === targetSquare);
  const targetSlide = slides[targetIndex];

  moveToSlide(track, currentSlide, targetSlide);
  updatesquare(currentSquare, targetSquare);
  hideShowArrows(slide, prevbutton, nextbutton, targetIndex);
})

// ***MODALS for LOGIN***
// Get the modal
const modal = document.getElementById("modal");

// Get the button that opens the modal
const btn = document.getElementById("btnlog");
// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

 // ***MODALS for PRODUCT REVIEW***
// Get the modal
const revmodal = document.getElementById("revmodal");

// Get the button that opens the modal
const rebtn = document.getElementsByClassName("addCartBt");
// Get the <span> element that closes the modal
const respan = document.getElementsByClassName("closer")[0];
// When the user clicks the button, open the modal 

function revMdalopen(){
  revmodal.style.display = "block";
  revmodal.style.pointerEvents = "auto";
}
// When the user clicks on <span> (x), close the modal
function revMdalclose(){
  revmodal.style.display = "none";
}




// ***MODALS for SIGNUP***
// Get the modal
const modals = document.getElementById("modals");

// Get the button that opens the modal
const btns = document.getElementById("btnsign");

// Get the <span> element that closes the modal
const spans = document.getElementsByClassName("closes")[0];

// When the user clicks the button, open the modal 
btns.onclick = function() {
  modals.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spans.onclick = function() {
  modals.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == modals) {
    modals.style.display = "none";
  }
  if (event.target == revmodal) {
    revmodal.style.display = "none";
  }
}

// button for other signup
function changeValue(){
  const btnot = document.getElementById("btn-sign");
  if (btnot.value == "SIGNUP WITH PHONE"){
    btnot.value = "SIGNUP WITH EMAIL";
    document.getElementById('using-phone').style.display='block';
    document.getElementById('using-email').style.display='none';
  } else if(btnot.value == "SIGNUP WITH EMAIL"){
    btnot.value = "SIGNUP WITH PHONE";
    document.getElementById('using-phone').style.display='none';
    document.getElementById('using-email').style.display='block';
  }
}

//Item Carousel
const carouselSlide = document.querySelector('.carousel__track-containerp');
const carouselItem = document.querySelectorAll('.carousel-slidep');

const prevBtn = document.querySelector('.button_carousel--leftp');
const nextBtn = document.querySelector('.button_carousel--rightp');

let counter = 0;
const size = carouselItem[0].clientWidth;

carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';

const moveToSlidep = (carouselSlide, currentSlidep, targetSlidep) => {
  carouselSlide.style.transform = 'translateX(-' + targetSlidep.style.left + ')';
  currentSlidep.classList.remove('current-slidep');
  targetSlidep.classList.add('current-slidep');
  
}

nextBtn.addEventListener('click',() => {
    if(counter >= carouselItem.length -1) return;
    carouselSlide.style.transition = "transform 0.5s ease-in-out";
    counter++;
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
    const currentSlidep = carouselSlide.querySelector('.current-slidep');
    const nextSlidep = currentSlidep.nextElementSibling;
    moveToSlidep(carouselSlide, currentSlidep, nextSlidep);
});

prevBtn.addEventListener('click', () => {
    if(counter <= 0) return;
    carouselSlide.style.transition = "transform 0.5s ease-in-out";
    counter--;
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
    const currentSlidep = carouselSlide.querySelector('.current-slidep');
    const prevSlidep = currentSlidep.previousElementSibling;
    moveToSlidep(carouselSlide, currentSlidep, prevSlidep);
});

function revView(prodItem){
  document.getElementById('reviewProdCode').value = prodItem.proditem_code;
}



// cart see details menu

// function seeMenucart() {
//   var see = document.getElementById("seesub");
//   if (see.style.display === "none"){
//     see.style.display = "block";
//   } else{
//     see.style.display = "none";
//   }
// }


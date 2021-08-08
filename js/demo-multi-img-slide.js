const carouselSlide = document.querySelector('.carousel-slide');
const carouselImages = document.querySelectorAll('.carousel-slide img');
const carouselContainer = document.querySelector('.carousel-container');

const prevBtn = document.querySelector('#prevBtn');
const nextBtn = document.querySelector('#nextBtn');

let counter = 0;

let sliderWidth = 900;
let totalImg = $(".carousel-slide img").length;
let imgPerSlide = 5;
let maxCounter = totalImg - imgPerSlide; // sliding times
let slidingDistance = sliderWidth / imgPerSlide;

if (maxCounter <= 0) {
    prevBtn.style.visibility = 'hidden';
    nextBtn.style.visibility = 'hidden';
    maxCounter = 0;
}

if (counter == 0) {
    prevBtn.style.visibility = 'hidden';
}

nextBtn.addEventListener('click', () => {
    carouselSlide.style.transition = 'transform 0.4s ease-in-out';
    counter++;
    carouselSlide.style.transform = 'translateX(' + (-slidingDistance * counter) + 'px)';

    if (counter == 0) {
        prevBtn.style.visibility = 'hidden';
    } else prevBtn.style.visibility = 'visible';

    if (counter == maxCounter) {
        nextBtn.style.visibility = 'hidden';
    } else nextBtn.style.visibility = 'visible';
});

prevBtn.addEventListener('click', () => {
    carouselSlide.style.transition = 'transform 0.4s ease-in-out';
    counter--;
    carouselSlide.style.transform = 'translateX(' + (-slidingDistance * counter) + 'px)';

    if (counter == 0) {
        prevBtn.style.visibility = 'hidden';
    } else prevBtn.style.visibility = 'visible';

    if (counter == maxCounter) {
        nextBtn.style.visibility = 'hidden';
    } else nextBtn.style.visibility = 'visible';
});

automaticSlides();

function automaticSlides() {
    setTimeout(function() {
        carouselSlide.style.transition = 'transform 0.4s ease-in-out';
        counter++;
        carouselSlide.style.transform = 'translateX(' + (-slidingDistance * counter) + 'px)';

        if (counter <= maxCounter) {
            automaticSlides();
        }

        if (counter > maxCounter) {
            carouselSlide.style.transition = 'transform 0.4s ease-in-out';
            counter = 0;
            carouselSlide.style.transform = 'translateX(' + (-slidingDistance * 4 * counter) + 'px)';
            automaticSlides();
        }

        if (counter == 0) {
            prevBtn.style.visibility = 'hidden';
        } else prevBtn.style.visibility = 'visible';

        if (counter == maxCounter) {
            nextBtn.style.visibility = 'hidden';
        } else nextBtn.style.visibility = 'visible';
    }, 5000)
}
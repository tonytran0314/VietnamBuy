const carouselSlide = document.querySelector('.carousel-slide');
const carouselImages = document.querySelectorAll('.carousel-slide img');

const prevBtn = document.querySelector('#prevBtn');
const nextBtn = document.querySelector('#nextBtn');

let counter = 0;
const size = carouselImages[0].clientWidth;


if (counter == 0) {
    prevBtn.style.visibility = 'hidden';
}



nextBtn.addEventListener('click', () => {
    carouselSlide.style.transition = 'transform 0.4s ease-in-out';
    counter++;
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';

    if (counter == 0) {
        prevBtn.style.visibility = 'hidden';
    } else prevBtn.style.visibility = 'visible';

    if (counter == 3) {
        nextBtn.style.visibility = 'hidden';
    } else nextBtn.style.visibility = 'visible';
});

prevBtn.addEventListener('click', () => {
    carouselSlide.style.transition = 'transform 0.4s ease-in-out';
    counter--;
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';

    if (counter == 0) {
        prevBtn.style.visibility = 'hidden';
    } else prevBtn.style.visibility = 'visible';

    if (counter == 3) {
        nextBtn.style.visibility = 'hidden';
    } else nextBtn.style.visibility = 'visible';
});

automaticSlides();

function automaticSlides() {
    setTimeout(function() {
        carouselSlide.style.transition = 'transform 0.4s ease-in-out';
        counter++;
        carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';

        if (counter <= 3) {
            automaticSlides();
        }

        if (counter > 3) {
            carouselSlide.style.transition = 'transform 0.4s ease-in-out';
            counter = 0;
            carouselSlide.style.transform = 'translateX(' + (-size * 4 * counter) + 'px)';
            automaticSlides();
        }

        if (counter == 0) {
            prevBtn.style.visibility = 'hidden';
        } else prevBtn.style.visibility = 'visible';

        if (counter == 3) {
            nextBtn.style.visibility = 'hidden';
        } else nextBtn.style.visibility = 'visible';
    }, 5000)
}
let btnToTop = document.querySelector('.btn-to-top');

btnToTop.addEventListener('click', function() {
    // window.scrollTo(0, 0);

    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    })
})

window.addEventListener('scroll', () => {

    let scrollAble = document.documentElement.scrollHeight - window.innerHeight;
    let scrollDistance = window.scrollY;
    let showButtonDistance = scrollAble * 0.2;

    let scrollToTopBtn = document.querySelector('.btn-to-top');

    if (Math.ceil(scrollDistance) >= showButtonDistance) {
        scrollToTopBtn.style.visibility = 'visible';
        scrollToTopBtn.style.translate = 'scale(1)';
    } else
    if (Math.ceil(scrollDistance) < showButtonDistance) {
        scrollToTopBtn.style.visibility = 'hidden';
        scrollToTopBtn.style.translate = 'scale(0)';
    }

})
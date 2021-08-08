var ratedIndex = -1;

$(document).ready(function() {
    resetStarColors();

    $('.fa-star').on('click', function() {
        ratedIndex = parseInt($(this).data('index'));
    });

    $('.fa-star').mouseover(function() {
        resetStarColors();

        var currentIndex = parseInt($(this).data('index'));

        for (var i = 0; i <= currentIndex; i++) {
            $('.fa-star:eq(' + i + ')').css('color', 'yellow');
        }
    });

    $('.fa-star').mouseleave(function() {
        resetStarColors();

        if (ratedIndex != -1) {
            for (var i = 0; i <= ratedIndex; i++) {
                $('.fa-star:eq(' + i + ')').css('color', 'yellow');
            }
        }
    });
});

function resetStarColors() {
    $('.fa-star').css('color', 'white');
}
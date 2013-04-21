$.fn.scrollView = function (speed) {
    return this.each(function () {
        $('html, body').animate({
            scrollTop: $(this).offset().top
        }, speed);
    });
}
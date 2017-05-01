/**
 * Created by Wilco on 09/11/16.
 */
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});


window.addEventListener('load', init);


function init()
{
    getHeightOfScreen();
}

function getHeightOfScreen ()
{
    var height = window.innerHeight;

    var img = document.getElementById('showImage');
    img.style.maxHeight = height + 'px';
}



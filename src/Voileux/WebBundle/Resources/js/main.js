$(document).ready(function(){

    $('ul.slider').fullWidthSlider({
        autoplay: true
    })
});


$('.form-field input').placeholder();
$('#persons').customSelect({customClass:'niceSelect'});

$('.search-form').submit(function(e){
    var form = $(this);
    var hideErrors = function() {
        $('.form-field input').removeClass('error');
    };

    var showErrors = function(errs) {
        for (var err in errs) {
            if(errs[err] == false) {
                $('#'+err).addClass('error')
            }
        }
    }
    hideErrors();
    e.preventDefault();
    var params = $(this).serializeArray();
    var req = $.ajax({
        url: 'submit.php',
        data: params,
        type: 'POST'
    });
    $('#search-now').addClass('loading disabled');
    req.done(function(data) {
        $('#search-now').removeClass('loading disabled');
        form.hide();
        $('#submit-success').show();
        if(window._gaq) {
            _gaq.push(['_trackPageview', '/search_boat_success']);
        }

    });
    req.fail(function(xhr) {
        var data = JSON.parse(xhr.responseText);
        showErrors(data.errors);
        $('#search-now').removeClass('loading disabled');

    });


});



$('.datepicker').datepicker( {"dateFormat": 'dd/mm/yy'});

var calculatePrice = function(){
    var  p = $('#total-price');
    var dailyPrice = p.data('daily-price');
    var dateFrom = $( "#date-from" ).datepicker( "getDate" );
    var dateTo = $( "#date-to" ).datepicker( "getDate" );
    days = 1;
    if (dateFrom && dateTo) {
        var days = (dateTo.getTime() - dateFrom.getTime()) / 1000 / 3600 / 24;
        $('.per-day').hide();
    }

    var totalPrice = dailyPrice * days;

    if(totalPrice <=0 ) {
        $('.currency').hide();
        totalPrice = 'Erreur dates';
    } else {
        $('.currency').show();
    }

    p.text(totalPrice);

};

$('#detail-search-form').find('input, select').change(function(){
    calculatePrice()
});

$('.boat-details .img-and-share').hover(function(){
    $(this).find('ul.share').fadeIn(200);
}, function(){
    $(this).find('ul.share').fadeOut(200);
});
$(document).ready(function(){

    $('ul.slider').fullWidthSlider({
        autoplay: true
    });
    PlaceholderLabels();
});


$('.form-field input').placeholder();
$('#search_persons').customSelect({customClass:'niceSelect'});

function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

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
    var params = getFormData($(this));
    params = JSON.stringify(params);
    console.log(params);
    var req = $.ajax({
        url: '/search',
        data: params,
        type: 'POST'
    });
    $('#search-now').addClass('loading disabled');
    req.always(function(){
        $('#search-now').removeClass('loading disabled');
    });
    req.done(function(data) {

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
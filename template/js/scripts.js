$(document).ready(function () {
    $('.time-input').attr("maxLength", 5);
    $('.time-input').attr("placeholder", "hh:mm");

    $('.time-input').blur(function () {
        IsObjTime(this);
        return false;
    });
    $('.time-input').keyup(function () {
        TempTm(event, this);
        return false;
    });  

    $('.date-input').attr("maxLength", 10);
    $('.date-input').attr("placeholder", "dd/mm/yyyy");
    
    $('.date-input').blur(function () {
        IsObjDate(this);
        return false;
    });
    $('.date-input').keyup(function () {
        TempDt(event, this);
        return false;
    });  

    mInput('adultprice', 2);
    mInput('childprice', 2);
});

function getTheaterPrice(obj) {
    $.post("/theater/priceList/" + obj.value, {}, function(data) {
        if (!$('#adultprice').val()) $('#adultprice').val(data.adultprice);
        if (!$('#childprice').val()) $('#childprice').val(data.childprice);
    }, 'json');
    return false;
 }
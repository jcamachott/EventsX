var now   = new Date();
var thismonth = now.getMonth();
var thisyear  = now.getFullYear();
var monthEvents = {};

$(function(){
    calendar();

    $('#nextMonth').click(function(evt){
        evt.preventDefault();
        nextMonth();
        calendar();
    });

    $('#prevMonth').click(function(evt){
        evt.preventDefault();
        prevMonth();
        calendar();
    });
});

function calendar() {
    $('#calendar').html('<span class="loading">Loading</span>');
    $.getJSON('/eventsxJSON?month='+(thismonth+1)+'&year='+thisyear, function(data) {
       monthEvents = data;
        
       $('#calendar').calendarWidget({
            month: thismonth,
            year: thisyear,
            events: monthEvents
       });

       $('.hasEvents').hover(
           function(){
                $(this).find('div').show();
           },
           function(){
               $(this).find('div').hide();
           }
       );


    });
}

function prevMonth() {
    if(thismonth == 0) {
        thisyear = thisyear - 1;
        thismonth = 11;
    }
    else {
        thismonth = thismonth - 1;
    }
}

function nextMonth() {
    if(thismonth == 11) {
        thisyear = thisyear + 1;
        thismonth = 0;
    }
    else {
        thismonth = thismonth + 1;
    }
}
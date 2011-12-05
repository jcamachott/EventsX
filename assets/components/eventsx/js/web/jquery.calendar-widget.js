(function($) { 
   
	function calendarWidget(el, params) { 
		
		var now   = new Date();
		var thismonth = now.getMonth();
		var thisyear  = now.getFullYear();
		
		var opts = {
			month: thismonth,
			year: thisyear
		};


		
		$.extend(opts, params);
		
		var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
		month = i = parseInt(opts.month);
		year = parseInt(opts.year);
		var m = 0;
		var table = '';

				
        table += ('<h3 id="current-month">'+monthNames[month]+' '+year+'</h3>');
        table += ('<table class="calendar-month " ' +'id="calendar-month'+i+' " cellspacing="0">');
		
        table += '<tr>';
			
        for (d=0; d<7; d++) {
            table += '<th class="weekday">' + dayNames[d] + '</th>';
        }
			
        table += '</tr>';
		
        var days = getDaysInMonth(month,year);
        var firstDayDate=new Date(year,month,1);
        var firstDay=firstDayDate.getDay();
			
        var prev_days = getDaysInMonth(month,year);
        var firstDayDate=new Date(year,month,1);
        var firstDay=firstDayDate.getDay()-1;
			
        var prev_m = month == 0 ? 11 : month-1;
        var prev_y = prev_m == 11 ? year - 1 : year;
        var prev_days = getDaysInMonth(prev_m, prev_y);
        firstDay = (firstDay == 0 && firstDayDate) ? 7 : firstDay;

        //sunday should be day 7 (index 6)
        if(firstDay == -1) {
            firstDay = 6;
        }
	
        var i = 0;
        for (j=0;j<42;j++) {
            if ((j<firstDay)) {
                    table += ('<td class="other-month"><span class="day">'+ (prev_days-firstDay+j+1) +'</span></td>');
            } else if ((j>=firstDay+getDaysInMonth(month,year))) {
                i = i+1;
                table += ('<td class="other-month"><span class="day">'+ i +'</span></td>');
            } else {
                table += ('<td class="current-month day'+(j-firstDay+1)+'">'+thisMonthDay(j-firstDay+1)+'</td>');
            }

            if (j%7==6)  table += ('</tr>');
        }

        table += ('</table>');

		el.html(table);
	}
	
	function getDaysInMonth(month,year) {
		var daysInMonth=[31,28,31,30,31,30,31,31,30,31,30,31];
		if ((month==1)&&(year%4==0)&&((year%100!=0)||(year%400==0))){
		  return 29;
		}else{
		  return daysInMonth[month];
		}
	}

    //show day in this month including events
    function thisMonthDay(day) {
        if(monthEvents[day]) {
            var todayEvents = '';

            for(i=0; i < monthEvents[day].length; i++) {
                todayEvents += monthEvents[day][i].html;
            }
            
            return '<div class="day hasEvents">'+day+'<div class="events">'+todayEvents+'</div></div>';
        }
        else {
            return '<span class="day">'+day+'</span>';
        }
    }
	
	// jQuery plugin initialisation
	$.fn.calendarWidget = function(params) {    
		calendarWidget(this, params);		
		return this; 
	}; 

})(jQuery);

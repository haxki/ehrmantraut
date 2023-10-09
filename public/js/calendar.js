var calendarDate = new Date();

var calendar = $('<div>').addClass('calendar').hide();
var dateInput = $('#birthdate')
	.focus(function(){ calendar.show(); })
	.after(calendar);

var inputs = $('<div>');
var close = $('<nav>').append( 
	$('<div>').text("Close")
	.click( function(){ $(this).css('background',''); calendar.hide(); })
	.mouseover( function(){$(this).css('background','#cc0000'); } )
	.mouseout( function(){ $(this).css('background',''); } )
	);

var divMonth = $('<div>');
var labelMonth = $('<label>').text("Month");
var selectMonth = $('<select>')
	.attr('title',"Month")
	.change(refreshCells);

$.each(["January","February","March","April","May",
	"June","Jule","August","September","October","November","December"],
	function(i,val){ 
		selectMonth.append($('<option>').text(val)); 
	}
);
	
var divYear = $('<div>');
var labelYear = $('<label>').text("Year");
var selectYear = $('<select>')
	.attr('title',"Year")
	.change(refreshCells);

for (i=2022; i>1920; i--)
	selectYear.append($('<option>').text(i));
	
var cells = $('<div>');
	
$.each(["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
	function(i,day){ 
		cells.append(
			$('<div>').addClass('header').append(
				$('<h3>').text(day)
			)
		);
	});

$.each(new Array(6*7), 
	function(){
		$('<div>')
		.mouseover(function(){ 
			if($(this).attr('class')==null){ 
				$(this).css('background','#4b77c7');}
			})
		.mouseout(function(){ 
			if($(this).attr('class')==null){ 
				$(this).removeAttr('style');}
			})
		.click(function(){
			if($(this).attr('class')==null) { 
				$(this).removeAttr('style');
				d = $(this).text();
				m = (selectMonth[0].selectedIndex+1);
				if (parseInt(d/10)===0) d = "" + 0 + d;
				if (parseInt(m/10)===0) m = "" + 0 + m;
				dateInput.val(d + "." + m + "." + selectYear.val());
				calendar.hide();
			}
			
			$('#birthdate').removeAttr('style');
			if ($('#birthdate').next().next().next().attr('class') == 'err-msg') {
				$('#birthdate').next().next().next().remove();
			} else if ($('#birthdate').next().next() == 'err-msg') {
				$('#birthdate').next().next().remove();
			}
		})
		.appendTo(cells);
	});

inputs.append(
	divMonth.append(labelMonth, selectMonth), 
	divYear.append(labelYear, selectYear)
	);
calendar.append(close, inputs, cells);

refreshCells();



function refreshCells(){
	setCalendarDate();		
	var firstDay = dayWithChangedOrder();
	for(i = 7; i < 7 + firstDay; i++) 
		hideCell(i);
	for(i = 7 + firstDay; i < 7*7; i++) {
		if (monthMatchingSelect()) showCell(i); 
		else hideCell(i);
	}

	function setCalendarDate(){
		calendarDate.setDate(1);
		calendarDate.setMonth(selectMonth[0].selectedIndex);
		calendarDate.setYear(selectYear.val());	
		}
	function dayWithChangedOrder(){
		firstDay = calendarDate.getDay();
		return (firstDay==0) ? 6 : firstDay-1;
		}
	function monthMatchingSelect(){
		return calendarDate.getMonth()==selectMonth[0].selectedIndex;			
		}
	function showCell(i){
		$(cells.children()[i]).text(calendarDate.getDate()).removeAttr('class');
		calendarDate.setDate(calendarDate.getDate()+1);
		}
	function hideCell(i){
		$(cells.children()[i]).empty().addClass('empty');
		}
	}

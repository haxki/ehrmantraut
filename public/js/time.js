//ЧЧ.ММ.ГГ День недели

function currentDate() {
	var date = new Date();
	day = "";
	switch(date.getDay()){
		case 0: day = "Воскресенье"; break;
		case 1: day = "Понедельник"; break;
		case 2: day = "Вторник"; break;
		case 3: day = "Среда"; break;
		case 4: day = "Четверг"; break;
		case 5: day = "Пятница"; break;
		case 6: day = "Суббота"; break;
	}
	return date.getDate() + "." + (date.getMonth()+1) + "." + (date.getYear()+1900) + " - " + day;
}
function currentTime() {
	var time = new Date();
	h = time.getHours();
	m = time.getMinutes();
	s = time.getSeconds();
	if (parseInt(h/10)==0) h = "" + 0 + h;
	if (parseInt(m/10)==0) m = "" + 0 + m;
	if (parseInt(s/10)==0) s = "" + 0 + s;
	return  h + ":" + m + ":" + s;
}

var timeHeader = $('<h1>');
$($('nav')[0]).append(
	$('<div>').addClass('clock').append(
		$('<h1>').text("Сегодня").css('font-size','30px'),
		$('<h1>').text(currentDate()),
		timeHeader
	)
);

setInterval( 
	function(){ 
		timeHeader.text(currentTime()); 
	}, 1000
);

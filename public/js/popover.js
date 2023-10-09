var popMessages = {
	'fio': "Поле ФИО должно содержать три слова, которые разделены пробелами.",
	'gender': "Нажмите на любой радиобатн.",
	'email': "Е-mail должен содержать некоторое количество символов, собаку, точки, все дела.",
	'phone': "Телефон может начинаться только с \"+7\" или \"+3\" и содержать от 9 до 11 цифр без посторонних символов (в том числе пробелов).",
	'age': "Нужно выбрать ваш актуальный возраст. Например, были бы вы Майком, а вам в таком случае 112 лет, вам бы следовало взять вариант \"От 55\".",
	'message': "Прийдется написать сообщение.",
	'birthdate': "Нужно нажать на это поле и выбрать дату."
};
var timerId;

$('#fio, #email, #message, #phone, #birthdate, #age').mouseenter(function(){
    switch(this.id){
        case 'fio': popOver(this,popMessages.fio); break;
        case 'age': popOver(this,popMessages.age); break;
        case 'gender_male': case 'gender_female': 
            popOver(this,popMessages.gender); break;
        case 'email': popOver(this,popMessages.email); break;
        case 'message': popOver(this,popMessages.message); break;
        case 'phone': popOver(this,popMessages.phone); break;
        case 'birthdate': popOver(this,popMessages.birthdate); break;
    }
})
.mouseleave(function(){
    timerId = setTimeout(function(){ $('.popover').remove(); },1000);
});

function popOver(elem,msg){
	clearTimeout(timerId);
	$('.popover').remove();
	$(elem)
		.after(
			$('<div>')
			.attr('class','popover')
			.text(msg)
			.offset({
				top: $(elem).position().top+20,
				left: $(elem).position().left
			})
		);
}
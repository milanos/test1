$('#accordion').collapse({
	toggle: true
});
$('.mini-alerts a').popover({
	trigger: 'hover',
	html: true
});
$('#accordion').on('shown.bs.collapse', function () {
	alert('Szkoda, że zamknąłeś to okienko...');
	//jakikolwiek Twój kod
});

$('#toggleAccordion').on('click', function () {
	$('#accordion').collapse('toggle');
});
$(".success-alert").fadeTo(5000, 500).slideUp(2000, function(){
		$("#success-alert").slideUp(500);
});
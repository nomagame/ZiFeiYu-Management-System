$(function() {
	var theme = getCookie('niuxams_theme'),
		themes = $("#themes");
	if (theme && 'css/' + theme + '/ui.css' != themes.attr('href')) {
		themes.attr('href', 'css/' + theme + '/ui.css');
	}
	////////
	$( document ).tooltip({
		show: {
			delay: getCookie('niuxams_delay') ? getCookie('niuxams_delay') : 400,
			duration: 1
		},
		hide: {
			effect: "blind",
			duration: 400
		},
		track: true
	});
	////////
	$( ".menu" ).menu();
	///////
	$( ".button" ).button();
	//////
	$( ".buttonset" ).buttonset();
	//////
	$( ".accordion" ).accordion({
		collapsible: true,
		heightStyle: "content"
	});
	//////
	$( ".progressbar" ).progressbar({
		value: false
	});
});
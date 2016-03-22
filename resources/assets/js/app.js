$(document).ready(function() {
	$('select').each( function(i,v) {
    	$('#'+$(this).attr('id')).chosen({ width: '100%' });
	});
});
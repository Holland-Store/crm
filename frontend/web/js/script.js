document.getElementById('notification').onclick = () => {
	document.getElementById('notification-container').classList.toggle('hidden');
}
$(document).ready(function(){
	$('tr').on('click', function(){
		var key = $('tr').data('key');
		console.log(key); 
	});
});
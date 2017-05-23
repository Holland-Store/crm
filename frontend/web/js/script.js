document.getElementById('notification').onclick = () => {
	document.getElementById('notification-container').classList.toggle('hidden');
}
$(document).ready(function(){
	$('body').on('click', '.trTable', function(){
		var key = $(this).data('key');
		document.location.href = "http://crm/frontend/web/view/id="+key;
	});
	$('body').on('click', '#trNew', function(){
		var key = $(this).data('key');
		document.location.href = "http://crm/frontend/web/zakaz/adopted?id="+key;
	});
});

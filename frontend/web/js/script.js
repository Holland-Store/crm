// document.getElementById('notification').onclick = () => {
// 	document.getElementById('notification-container').classList.toggle('hidden');
// }
$(document).ready(function(){
//	$('body').on('click', '.trTable', function(){
//		var key = $(this).data('key');
//		document.location.href = "http://crm/frontend/web/view/"+key;
//	});
//	$('body').on('click', '#trNew', function(){
//		var key = $(this).data('key');
//		document.location.href = "http://crm/frontend/web/zakaz/adopted?id="+key;
//	});
	setInterval(function(){
		$.pjax.reload('#pjax-container')
	}, 100000);
       $('.actionCancel').click(function () {
           $('#declinedModal').modal('show')
               .find('.modalContent')
               .load($(this).attr('value'));
       });
       $('.actionApprove').click(function () {
           $('#acceptdModal').modal('show')
               .find('.modalContent')
               .load($(this).attr('value'));
       });
        $('.modalDisain').click(function () {
            $('#modalFile').modal('show')
                .find('.modalContent')
                .load($(this).attr('value'));
        });
       $("body").on("click", ".trNew", function () {
           var data = $(this).data("key");
           $.ajax({
               url: "/frontend/web/zakaz/adopted?id="+data,
               success: console.log('Успешно изменен статус')
           })
       })
       $("body").on("click", ".trNewDisain", function () {
            var data = $(this).data("key");
            $.ajax({
                url: "/frontend/web/zakaz/adopdisain?id="+data,
                success: console.log('Успешно изменен статус '+data)
            })
       })
       $("body").on("click", ".trNewMaster", function () {
            var data = $(this).data("key");
            $.ajax({
                url: "/frontend/web/zakaz/adopmaster?id="+data,
                success: console.log('Успешно изменен статус '+data)
            })
       })
});


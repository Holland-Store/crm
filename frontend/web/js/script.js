// document.getElementById('notification').onclick = () => {
// 	document.getElementById('notification-container').classList.toggle('hidden');
// }
$(document).ready(function(){
// 	setInterval(function(){
// 		$.pjax.reload('#pjax-container')
// 	}, 100000);
       $('body').on("click", ".trNew", function () {
           var data = $(this).data("key");
           $.ajax({
               url: "/zakaz/adopted?id="+data,
               success: console.log('Успешно изменен статус')
           })
       });
        $( 'body' ).on( 'click', '.commentButton', function() {
            $( ".CommentForm" ).toggleClass( "CommentForm-visible" );
        });
       $('body').on('click', '.trNewDisain', function () {
            var data = $(this).data("key");
            $.ajax({
                url: "/zakaz/adopdisain?id="+data,
                success: console.log('Успешно изменен статус '+data)
            })
       });
       $('body').on('click', '.trNewMaster', function () {
            var data = $(this).data("key");
            $.ajax({
                url: "/zakaz/adopmaster?id="+data,
                success: console.log('Успешно изменен статус '+data)
            })
       });
       $(function () {
           $('[data-toggle = "tooltip"]').tooltip();
       });
        $(function () {
            $("[data-toggle='popover']").popover();
        });
       $('body').on('change', '#zakaz-status', function () {
                $('#autsors')
                    .css({'display': ($(this).val() == 8 ? 'block' : 'none')})
                    .prop('selectedIndex', 0)
       });
    $('body').on('click', '#checkboxAppoint', function () {
        $('.form-appoint').toggleClass('visible');
    });
       $('#zakaz-status').each(function () {
            if ($(this).val() == 8){
                $('#autsors').css('display', 'block')
            } else {
                $('#autsors').css('display', 'none')
                    .prop('selectedIndex', 0);
            }
       });
       $('.startShift').click(function () {
            $('#form-startShift')[0].reset();
            $('.form-shiftStart').toggleClass('visibleForm');
       });
       $('.endShift').click(function () {
            $('#form-endShift')[0].reset();
            $('.form-shiftEnd').toggleClass('visibleForm');
       });
});


// document.getElementById('notification').onclick = () => {
// 	document.getElementById('notification-container').classList.toggle('hidden');
// }
$(document).ready(function(){
// 	setInterval(function(){
// 		$.pjax.reload('#pjax-container')
// 	}, 100000);
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
        $('.declinedHelp').click(function () {
            $('#declinedHelpModal').modal('show')
                .find('.modalContent')
                .load($(this).attr('value'));
        });
        $('.draft').click(function () {
            $('#draftModal').modal('show')
                .find('.modalContent')
                .load($(this).attr('value'));
        });
        $('body').on('click', '.createClient', function(){
            $('#modalCreateClient').modal('show')
                .find('.modalContentClient')
                .load($(this).attr('value'))
        });
        $('body').on('click', '.declinedTodoist', function () {
            $('#modalDeclinedTodoist').modal('show')
                .find('.modalContent')
                .load($(this).attr('value'));
        });
       $('body').on("click", ".trNew", function () {
           var data = $(this).data("key");
           $.ajax({
               url: "/frontend/web/zakaz/adopted?id="+data,
               success: console.log('Успешно изменен статус')
           })
       });
        $( 'body' ).on( 'click', '.commentButton', function() {
            $( ".CommentForm" ).toggleClass( "CommentForm-visible" );
        });
       $('body').on('click', '.trNewDisain', function () {
            var data = $(this).data("key");
            $.ajax({
                url: "/frontend/web/zakaz/adopdisain?id="+data,
                success: console.log('Успешно изменен статус '+data)
            })
       });
       $('body').on('click', '.trNewMaster', function () {
            var data = $(this).data("key");
            $.ajax({
                url: "/frontend/web/zakaz/adopmaster?id="+data,
                success: console.log('Успешно изменен статус '+data)
            })
       });
       $(function () {
           $('[data-toggle = "toolpit"]').tooltip();
       })
    $('body').on('change', '#zakaz-status', function () {
        var value = $(this).val();
        if (value == 8){
            $('#autsors').css('display', 'block');
        } else {
            $('#autsors').css('display', 'none')
                .prop('selectedIndex', 0);
        }
    })
});


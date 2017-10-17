$(document).ready(function() {
    modalView('.actionCancel', '#declinedModal');
    modalView('.actionApprove', '#acceptdModal');
    modalView('.modalDisain', '#modalFile');
    modalView('.declinedHelp', '#declinedHelpModal');
    modalView('.draft', '#draftModal');
    modalView('.modalShipping-button', '#modalShipping');
    modalView('.financy', '#financeModel');
    modalView('.draft', '#draftModal');
    bodyModalView('.createClient', '#modalCreateClient', '.modalContentClient');
    bodyModalView('.declinedTodoist', '#modalDeclinedTodoist', '.modalContent');

    function modalView(button, modal) {
        $(button).click(function () {
            $(modal).modal('show')
                .find('.modalContent')
                .load($(this).attr('value'));
        });
    }
    function bodyModalView(button, modal, content){
        $('body').on('click', button, function(){
            $(modal).modal('show')
                .find(content)
                .load($(this).attr('value'))
        })
    }
});
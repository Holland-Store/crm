$(document).ready(function(){
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
    $('.modalShipping-button').click(function () {
        $('#modalShipping').modal('show')
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
    $('.financy').click(function () {
        $('#financeModel').modal('show')
            .find('.modalContent')
            .load($(this).attr('value'));
    });
});
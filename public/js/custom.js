$(document).ready(function() {
    // datepicker
    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        language: "pt"
    });

    // timepicker
    $('.timepickerinput').timepicker({
        minuteStep: 5,
        showMeridian: false,
        defaultTime: false
    });
});

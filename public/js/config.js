/**
 * CSRF protection
 */
$(function () {
    $.ajaxSetup({headers:{'X-CSRF-Token': $('input[name="_token"]').val()}});
});

$(document).ready(function(){
    $( "#tabs" ).tabs();
    $('input[name=start], input[name=end]').datepicker({
        dateFormat: "yy-mm-dd"
    });
});
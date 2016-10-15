$(function() {
    $( document ).ready(function() {
        
        var loginFormObject = {
                                init : function(){
                                    if(typeof loginFormVO == "undefined" || !loginFormVO){
                                        return;
                                    }
                                    var form = $('#loginForm');
                                    form.find('input[name=account]').val(loginFormVO.account);
                                    form.find('input[name=password]').val('');
                                    form.find('.error').show();
                                }
                            };
        
        loginFormObject.init();
    });
});
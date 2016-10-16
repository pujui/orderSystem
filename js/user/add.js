$(document).ready(function(){
    
    
    function userAddForm(userAddFormVO){
        this.userAddFormVO = userAddFormVO;
    }
    
    userAddForm.prototype.init = function(){
        
        $('#userAddForm input[type=submit]').click(this.checkVariable);
        
        if(this.userAddFormVO){
            this.append();
        }
    }
    
    userAddForm.prototype.append = function(){
        if($('input[name=edit]').length() == 0){
	        $('input[name=account]').val('');
	        $('input[name=name]').val(this.userAddFormVO.name);
	        $('input[name=password]').val('');
	        $('input[name=confirmPassword]').val('');
        }
    }
    
    userAddForm.prototype.checkVariable = function(){
        var msg = [];
        if($('input[name=account]').val().trim() == ''){
            msg.push('請填入Account');
        }
        if($('input[name=name]').val().trim() == ''){
            msg.push('請填入Name');
        }
        if($('input[name=password]').val().trim() == ''){
            msg.push('請填入 Password');
        }
        if($('input[name=confirmPassword]').val().trim() == ''){
            msg.push('請填入 Confirm Password');
        }
        if($('input[name=confirmPassword]').val() != $('input[name=password]').val()){
            msg.push('Password不相同');
        }return false;
        if(msg.length == 0){
            return true;
        }else{
            alert(msg.join('\n\n'));
            return false;
        }
    }
    new userAddForm(userAddFormVO).init();
});
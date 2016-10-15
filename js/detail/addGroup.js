$(document).ready(function(){
	$('#groupSubmit').click(function(){
		if($('#title').val().trim() == ''){
			
			alert('請填寫群組名稱');
			
			return false;
		}
	});
});
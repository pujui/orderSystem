$(document).ready(function(){

	
	$('.delGroup').click(function(){
		if(confirm('確認是否刪除')){
			location.href = $(this).attr('path');
		}
	});
	
	$('.editGroupTitle').click(function(){
		location.href = $(this).attr('path');
	});
	
	$('.editGroup').click(function(){
		location.href = $(this).attr('path');
	});
});
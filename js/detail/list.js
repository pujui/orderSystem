$(document).ready(function(){

	
	function detailSearchForm(detailListSearchVO){
		this.detailListSearchVO = detailListSearchVO;
	}
	
	detailSearchForm.prototype.init = function(){
		$('input[name=start], input[name=end]').datepicker({
			dateFormat: "yy-mm-dd"
		});
		
		$('#groupTotalBtn').click(function(){
			$.blockUI({ 
				message: $('#groupTotal'),
				onOverlayClick: $.unblockUI,
				css: {
					top: '10%',
					width: 750,
					left: ($( window ).width()/2)-(750/2)
				}
			});
		});
		
		$('#yearsTotalBtn').click(function(){
			$.blockUI({ 
				message: $('#yearsTotal'),
				onOverlayClick: $.unblockUI,
				css: {
					top: '10%',
					width: 750,
					left: ($( window ).width()/2)-(750/2)
				}
			});
		});
		
		$('#monthsTotalBtn').click(function(){
			$.blockUI({ 
				message: $('#monthsTotal'),
				onOverlayClick: $.unblockUI,
				css: {
					top: '10%',
					width: 750,
					left: ($( window ).width()/2)-(750/2)
				}
			});
		});
		
		$('.delDetail').click(function(){
			return confirm('確認是否刪除');
		});
		
		if(this.detailListSearchVO){
			this.append();
		}
	}
	
	detailSearchForm.prototype.append = function(){
		$('input[name=time][value='+this.detailListSearchVO.time+']').prop('checked', true);
		$('input[name=start]').val(this.detailListSearchVO.start);
		$('input[name=end]').val(this.detailListSearchVO.end);
		$('select[name=year]').val(this.detailListSearchVO.year);
		$('select[name=month]').val(this.detailListSearchVO.month);
		$('select[name=ownerId]').val(this.detailListSearchVO.ownerId);
		$('input[name=receipt]').val(this.detailListSearchVO.receipt);
	}
	
	new detailSearchForm(detailListSearchVO).init();
});
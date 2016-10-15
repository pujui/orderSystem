$(document).ready(function(){
	
	
	function detailForm(detailVO){
		this.detailVO = detailVO;
	}
	
	detailForm.prototype.init = function(){
		
		$('input[name=receiptDate]').datepicker({
			dateFormat: "yy-mm-dd"
		});
		
		$('#detailForm input[type=submit]').click(this.checkVariable);
		
		if(this.detailVO){
			this.append();
		}
	}
	
	detailForm.prototype.append = function(){
		$('input[name=detailId]').val(this.detailVO.detailId);
		$('input[name=title]').val(this.detailVO.title);
		$('input[name=receipt]').val(this.detailVO.receipt);
		$('input[name=receiptDate]').val(this.detailVO.receiptDate);
		$('select[name=credit]').val(this.detailVO.isCredit);
		$('select[name=owner]').val(this.detailVO.owner);
		$('textarea[name=memo]').val(this.detailVO.receiptMemo);
		if(this.detailVO.isCredit == 1){
			$('input[name=money]').val(this.detailVO.credit);
		}else{
			$('input[name=money]').val(this.detailVO.debit);
		}
	}
	
	detailForm.prototype.checkVariable = function(){
		var msg = [];
		if($('input[name=title]').val().trim() == ''){
			msg.push('請填入 名稱');
		}
		if($('input[name=receiptDate]').val().trim() == ''){
			msg.push('請填入 日期');
		}
		if($('input[name=money]').val().trim() == ''){
			msg.push('請填入 金額');
		}
		if($('input[name=receipt]').val()!='' &&!/^[A-Z]{2}\-{1}[0-9]{8}$/.test($('input[name=receipt]').val())){
			msg.push('發票格是錯誤');
		}
		if(msg.length == 0){
			return true;
		}else{
			alert(msg.join('\n\n'));
			return false;
		}
	}
	new detailForm(detailVO).init();
});
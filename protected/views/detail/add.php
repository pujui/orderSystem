<h1>
	<b><?=CHtml::encode($detailGroupVO->title); ?></b>
</h1>
<form id="detailForm" method="post">
	<table style="width: 500px;">
		<tr>
			<th >名稱</th>
			<td >
				<input type="text" name="title" maxlength="40"/>
			</td>
		</tr>
		<tr>
			<th >金額</th>
			<td >
				<input type="number" name="money" min="1" />
				<select name="credit" >
					<option value="0" >出帳</option>
					<option value="1" >入帳</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>發票</th>
			<td >
				<input type="text" name="receipt" maxlength="11" />(例：XR-12345678)
			</td>
		</tr>
		<tr>
			<th>日期</th>
			<td >
				<input type="text" name="receiptDate" readonly="readonly" />
			</td>
		</tr>
		<tr>
			<th>帳務歸屬</th>
			<td>
				<select name="owner" >
					<option value="0" >無</option>
					<?php foreach ($groupMemberList as $row){ ?>
					<option value="<?=$row->userId ?>" ><?=$row->user->account ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>備註</th>
			<td>
				<textarea name="memo" rows="5" cols="30"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="hidden" name="detailId" value="" />
				<input type="hidden" name="groupId" value="<?=$detailGroupVO->groupId; ?>" />
				<input type="submit" />
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
	var detailVO = <?=json_encode($detailVO); ?>;
</script>
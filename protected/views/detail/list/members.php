<div id="groupTotal" class="hide">
	<table class="detail-list">
		<tr>
			<th>帳號</th>
			<th>入帳</th>
			<th>出帳</th>
			<th>總計</th>
		</tr>
		<?php foreach ($detailListFormVO->memberGroup as $row){ ?>
		<tr>
			<td>
			<?
			if(isset($detailListFormVO->detailGroup->members[$row->userId])){
				echo $detailListFormVO->detailGroup->members[$row->userId]->user->account;
			}else{
				echo '無';
			}
			?>
			</td>
			<td><?=$row->creditTotal ?></td>
			<td><?=$row->debitTotal ?></td>
			<td><?=$row->creditTotal-$row->debitTotal ?></td>
		</tr>
		<?php } ?>
	</table>
</div>
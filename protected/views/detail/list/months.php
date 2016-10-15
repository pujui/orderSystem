<div id="monthsTotal" class="hide" >
	<table class="detail-list">
		<tr>
			<th>月份</th>
			<th>入帳</th>
			<th>出帳</th>
			<th>總計</th>
		</tr>
		<?php $count = 0; ?>
		<?php foreach ($detailListFormVO->months as $key=>$row){ ?>
		<tr <? if($count%2 == 1){ ?>class="odd-row" <? } ?> >
			<td>
			<?=$key ?>
			</td>
			<td><?=$row->creditTotal ?></td>
			<td><?=$row->debitTotal ?></td>
			<td><?=$row->creditTotal-$row->debitTotal ?></td>
		</tr>
			<?php $count++; ?>
		<?php } ?>
	</table>
</div>
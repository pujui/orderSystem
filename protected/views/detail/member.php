<h1><?=CHtml::encode($detailGroupVO->title) ?></h1>
<form id="groupMemberForm" method="post" >
	<ul>
		<li class="title">
			新增成員帳號：
			<input type="text" name="member" id="member" maxlength="40" placeholder="新增成員帳號" />
			<input type="submit"  value="確認新增" />
		</li>
	</ul>
</form>
<table class="detail-list" >
	<tr>
		<th colspan="2">目前成員</th>
	</tr>
	
	<?php
	if(!empty($detailGroupVO)){
		foreach ($detailGroupVO->members as $member){ 
	?>
	<tr>
		<td><?=$member->user->account ?></td>
		<td>
			<?php if($member->userId!=$user->userId){ ?>
			<a href="<?=Yii::app()->request->baseUrl; ?>/detail/deleteMember/?group=<?=$member->groupId?>&member=<?=$member->userId?>">
				刪除
			</a>
			<?php } ?>
		</td>
	</tr>
	<?php
		} 
	}
	?>
	<tr>
		<td colspan="2">
			<input type="button" value="返  回" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/detail/';" />
		</td>
	</tr>
</table>
<script type="text/javascript">
<?php if($status === false){ ?>
alert('此帳號不存在');
<?php }?>
</script>
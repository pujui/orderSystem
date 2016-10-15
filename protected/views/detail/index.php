<div class="detail-add-group" >
	<input type="button" id="addGroup" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/detail/addGroup';" value="建立群組" />
</div>
<table class="detail-list" >
	<tr>
		<th>
		<?php if(empty($detailGroupVOList)){ ?>
		無群組資料
		<?php }else{ ?>
		群組名稱
		<?php } ?>
		</th>
		<th></th>
	</tr>
<?php foreach ($detailGroupVOList as $key=>$row){ ?>
	<tr <? if($key%2 == 1){ ?>class="odd-row" <? } ?> >
		<td>
			<a href="<?=Yii::app()->request->baseUrl; ?>/detail/list/?group=<?=$row->groupId?>">
				<?=CHtml::encode($row->title); ?>
			</a>
		</td>
		<td>
			<?php if($user->userId==$row->userId){ ?>
			<input type="button" path="<?=Yii::app()->request->baseUrl; ?>/detail/editGroup/?group=<?=$row->groupId?>" class="editGroupTitle" value="編輯群組名稱">
			&nbsp;/&nbsp;
			<input type="button" path="<?=Yii::app()->request->baseUrl; ?>/detail/member/?group=<?=$row->groupId?>" class="editGroup" value="編輯成員">
			&nbsp;/&nbsp;
			<input type="button" path="<?=Yii::app()->request->baseUrl; ?>/detail/delGroup/?group=<?=$row->groupId?>" class="delGroup" value="刪除群組" />
			<?php }else{?>
				編輯群組&nbsp;/&nbsp;
				編輯成員&nbsp;/&nbsp;
				刪除
			<?php } ?>
		</td>
	</tr>
<?php } ?>
</table>

	
<?php 
$this->widget('CPageView',array(
	'pageVO' => $pageVO
));
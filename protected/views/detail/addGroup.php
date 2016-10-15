<form id="groupForm" method="post" >
	<ul>
		<li class="title">
			群組名稱：
			<input type="text" name="title" id="title" maxlength="40" placeholder="群組名稱" />
			<input type="hidden" name="group" id="group" value="<?=intval($group) ?>" />
		</li>
		<li class="submit" ><input type="submit" name="groupSubmit" id="groupSubmit" value="確認新增" /></li>
	</ul>
</form>
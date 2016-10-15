<div id="login">
    <?php if($isLogin === false){ ?>
    <h1>
        您目前未登入，請由此<a href="<?=Yii::app()->request->baseUrl; ?>/user/login" >登入</a>
    </h1>
    <?php }else if($user->isActive == 2){ ?>
    <div style="text-align: right;" >
        <input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/add';" value="建立帳號" />
    </div>
    <br/><br/>
    <table class="detail-list">
        <tr>
            <th>ID</th>
            <th>帳號</th>
            <th>名稱</th>
            <th>建立時間</th>
            <th>更新時間</th>
            <th></th>
        </tr>
        <?php foreach ($userList as $key=>$row){ ?>
        <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?> >
            <td><?=$row->userId ?></td>
            <td><?=CHtml::encode($row->account) ?></td>
            <td><?=CHtml::encode($row->name) ?></td>
            <td><?=$row->createTime ?></td>
            <td><?=$row->updateTime ?></td>
            <td><input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/del';" value="從列表中移除" /></td>
        </tr>
        <?php } ?>
    </table>
    <?php }?>
</div>
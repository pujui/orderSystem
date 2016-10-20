<div>
    <?php if($isLogin === false){ ?>
    <h1>您目前未登入訂單管理系統，請由此<a href="<?=Yii::app()->request->baseUrl; ?>/user/login" >登入</a></h1>
    <?php }else if($user->isActive == 2){ ?>
    <div id="tabs" >
        <ul>
            <li><a href="#tabs-1">使用者列表</a></li>
            <li style="width: 780px; text-align: right;">
                <input type="button" class="templeBtn3"  onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/add';" value="建立帳號" />
            </li>
        </ul>
        <div id="tabs-1">
            <table class="detail-list">
                <tr>
                    <th>帳號</th>
                    <th>名稱</th>
                    <th>權限</th>
                    <th>時間</th>
                    <th></th>
                </tr>
                <?php foreach ($userList as $key=>$row){ ?>
                <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?> >
                    <td><?=$row->userId ?>&nbsp;-&nbsp;<?=CHtml::encode($row->account) ?></td>
                    <td><?=CHtml::encode($row->name) ?></td>
                    <td><?=CHtml::encode($activeList[$row->isActive]) ?></td>
                    <td><br/><?=$row->createTime ?><br/></td>
                    <td>
                        <?=$row->updateTime ?><br/>
                        <input type="button" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/edit/?id=<?=$row->userId ?>';" value="編輯" />
                       
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php }?>
</div>
<form id="eatraMenu" method="post" >
    <div id="sugar" >
        <table class="detail-list">
            <tr>
                <th colspan="2">sugar - the first is default </th>
            </tr>
            <?php foreach ($list['sugar'] as $trCount=>$row){ ?>
            <tr <?php if($trCount%2 == 1){ ?>class="odd-row" <?php } ?> >
                <td colspan="2" >
                    <input type="hidden" name="sugarId[]" value="<?=$row[2] ?>" maxlength="40"/>
                    <input type="text" name="sugarName[]" value="<?=CHtml::encode($row[0]) ?>" maxlength="40" />
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div id="ice">
        <table class="detail-list">
            <tr>
                <th colspan="2">ice - the first is default</th>
            </tr>
            <?php foreach ($list['ice'] as $trCount=>$row){ ?>
            <tr <?php if($trCount%2 == 1){ ?>class="odd-row" <?php } ?> >
                <td colspan="2" >
                    <input type="hidden" name="iceId[]" value="<?=$row[2] ?>" maxlength="40"/>
                    <input type="text" name="iceName[]" value="<?=CHtml::encode($row[0]) ?>" maxlength="40" />
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div id="extra">
        <table class="detail-list">
            <tr>
                <th colspan="4">extra</th>
            </tr>
            <?php foreach ($list['extra'] as $trCount=>$row){ ?>
                <?php if($trCount%2 == 0){ ?>
            <tr <?php if($trCount%4 == 0){ ?>class="odd-row" <?php } ?> >
                <?php } ?>
                <td >
                    <input type="hidden" name="extraId[]" value="<?=$row[2] ?>" maxlength="40"/>
                    <input type="text" name="extraName[]" value="<?=CHtml::encode($row[0]) ?>" maxlength="40" />
                </td>
                <td >
                    <input type="text" name="extraPrice[]" value="<?=CHtml::encode($row[1]) ?>" maxlength="40" />
                </td>
                <?php if($trCount%2 == 1){ ?>
            </tr>
                <?php } ?>
            <?php } ?>
            <?php if($trCount%2 != 1){ echo '</tr>'; } ?>
        </table>
    </div>
    <div id="extraMenuSend">
        <div class="btn-group btn-group-lg" role="group" >
            <button class="btn btn-lg btn-primary btn-block loginSubmit" type="submit">提交</button>
        </div>
    </div>
</form>
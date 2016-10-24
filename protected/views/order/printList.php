<table class="detail-list" style="width: 1000px;" >
    <tr>
        <th colspan="2">標籤等待列印名單</th>
    </tr>
    <?php foreach (glob(dirname(__FILE__).'/../../../prints/tag/*.html') as $key=>$row){ ?>
    <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?>>
        <td style="text-align: center; padding: 0px; margin: 0px;">
            <?=CHtml::encode(basename($row)) ?>
        </td>
    </tr>
    <?php }?>
    <tr>
        <th colspan="2">明細等待列印名單</th>
    </tr>
    <?php foreach (glob(dirname(__FILE__).'/../../../prints/list/*.html') as $key=>$row){ ?>
    <tr <?php if($key%2 == 1){ ?>class="odd-row" <?php } ?>>
        <td style="text-align: center; padding: 0px; margin: 0px;">
            <?=CHtml::encode(basename($row)) ?>
        </td>
    </tr>
    <?php }?>
</table>
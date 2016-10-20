<div id="tabs-2">
    <table class="detail-list" >
        <tr>
            <th colspan="3">近7日統計</th>
        </tr>
        <tr>
            <th>日</th>
            <th>訂單數</th>
            <th>金額</th>
        </tr>
        <?php foreach ($days as $day_row){ ?>
        <tr>
            <td><?=$day_row['ym'] ?></td>
            <td><?=$day_row['count'] ?></td>
            <td><?=$day_row['price'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
<div id="tabs-3">
    <table class="detail-list" >
        <tr>
            <th colspan="3">近5個月統計</th>
        </tr>
        <tr>
            <th>年月</th>
            <th>訂單數</th>
            <th>金額</th>
        </tr>
        <?php foreach ($months as $month_row){ ?>
        <tr>
            <td><?=$month_row['ym'] ?></td>
            <td><?=$month_row['count'] ?></td>
            <td><?=$month_row['price'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
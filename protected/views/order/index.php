<div id="tabs">
    <ul>
        <li><a href="#tabs-1">定單列表</a></li>
        <li><a href="#tabs-2">近7日統計頁</a></li>
        <li><a href="#tabs-3">近5月統計頁</a></li>
    </ul>
    <div id="tabs-1">
        <?php include dirname(__FILE__).'/block/tabList.php'; ?>
    </div>
    <?php include dirname(__FILE__).'/block/tabTotal.php'; ?>
</div>
<?php 
$list = glob(dirname(__FILE__).'/../../../prints/tag/*.html') ;
if(count($list) > 0){
    $file = array_pop($list);
    echo file_get_contents($file);
    unlink($file);
?>
<script type="text/javascript">
    function print_timeout(){
        window.print();
        setTimeout(local_timeout, 2000);
    }
    function local_timeout(){
        location.href = '?'.<?=time(); ?>;
    }
    setTimeout(print_timeout, 3000);
</script>
<?php
}else{
?>
<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="zh" />
        <meta http-equiv="refresh" content="3" />
    </head>
    <body>目前無待列印資料3秒後重新確認</body>
</html>
<?php 
}
?>
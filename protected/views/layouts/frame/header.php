<header>
    <div id="header-bar">
        <div class="user-info-bar">
        哈囉~
        <?php if($isLogin === true){ ?>
            <?=$user->account ?>
        <a href="<?=Yii::app()->request->baseUrl ?>/user/logout" >登出</a>
        <?php }else{ ?>
        訪客
        <?php } ?>
        </div>
    </div>
    <div id="header">
        <div class="app-grid" >
            <ul>
                <li class="grid-picture" >
                    <input type="button" class="headbtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/user/index';" value="使用者管理" />
                </li>
                <li class="grid-name"></li>
            </ul>
        </div>
        <div class="app-grid" >
            <ul>
                <li class="grid-picture" >
                    <input type="button" class="headbtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/index';" value="訂單管理" />
                </li>
                <li class="grid-name"></li>
            </ul>
        </div>
        <div class="app-grid" >
            <ul>
                <li class="grid-picture" >
                    <input type="button" class="headbtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/menu/index';" value="菜單管理" />
                </li>
                <li class="grid-name"></li>
            </ul>
        </div>
        <div class="app-grid" >
            <ul>
                <li class="grid-picture" >
                    <input type="button" class="headbtn" onclick="location.href='<?=Yii::app()->request->baseUrl; ?>/order/add';" value="建立訂單" />
                </li>
                <li class="grid-name"></li>
            </ul>
        </div>
    </div>
    <div id="breadcrumbs">
        <?php
        $this->widget('CBreadCrumbsView',array(
            'BreadCrumbs' => $this->BreadCrumbs
        ));
        ?>
    </div>
</header>
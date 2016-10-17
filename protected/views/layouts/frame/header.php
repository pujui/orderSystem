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
                    <a href="<?=Yii::app()->request->baseUrl ?>/order/index" >
                        <img src="<?=Yii::app()->request->baseUrl ?>/images/90x90.jpg" />
                    </a>
                </li>
                <li class="grid-name">
                    <a href="<?=Yii::app()->request->baseUrl ?>/order/index" >
                        訂單管理
                    </a>
                </li>
            </ul>
        </div>
        <div class="app-grid" >
            <ul>
                <li class="grid-picture" >
                    <a href="<?=Yii::app()->request->baseUrl ?>/menu/index" >
                        <img src="<?=Yii::app()->request->baseUrl ?>/images/90x90.jpg" />
                    </a>
                </li>
                <li class="grid-name">
                    <a href="<?=Yii::app()->request->baseUrl ?>/menu/index" >
                        菜單管理
                    </a>
                </li>
            </ul>
        </div>
        <div class="app-grid" >
            <ul>
                <li class="grid-picture" >
                        <img src="<?=Yii::app()->request->baseUrl ?>/images/90x90.jpg" />
                </li>
                <li class="grid-name">
                        帳務管理
                </li>
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
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Online store', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Shop',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Brands', 'icon' => 'file-code-o', 'url' => ['/shop/brand'],],
                            ['label' => 'Categories', 'icon' => 'dashboard', 'url' => ['/shop/category'],],
                            ['label' => 'Products', 'icon' => 'dashboard', 'url' => ['/shop/product'],],
                            ['label' => 'Tags', 'icon' => 'dashboard', 'url' => ['/shop/tag'],],
                            ['label' => 'Characteristics', 'icon' => 'dashboard', 'url' => ['/shop/characteristic'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>

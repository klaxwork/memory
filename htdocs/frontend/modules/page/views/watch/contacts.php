<?php use common\components\M; ?>
<?php /*/ ?>
<a title="Квест Стрип-клуб" class="link"
   href="<?= $this->createUrl('/page/lookup', ['node_id' => 119]) ?>"></a>
<?php //*/ ?>
<div class="page-wrapper">
    <?php
    $breadcrumbs = [];
    $breadcrumbs['Главная'] = '/';
    $breadcrumbs['О нас'] = '/about/';
    $breadcrumbs += $oNode->getBreadcrumbs();
    M::printr($breadcrumbs, '$breadcrumbs');

    ?>

    <div class="breadcrumb-wr">
        <div class="container">
            <div class="breadcrumb">
                <?php if (isset($breadcrumbs)) { ?>
                    <?php
                    if (0) {
                        $this->widget(
                            'common.widgets.Breadcrumbs.Breadcrumbs',//'zii.widgets.CBreadcrumbs',
                            array(
                                'links' => $breadcrumbs,
                            )
                        );
                    }
                    ?><!-- breadcrumbs -->
                <?php } ?>
            </div>
        </div>
    </div>
    <section class="main-title">
        <div class="container">
            <h1><?php //= $page->page_title ?></h1>
        </div>
    </section>


    <div class="catalog-item-wr">
        <div class="container">
            <div class="catalog-item__list">
                <div class="row">
                    <div class="catalog-item__item col-md-12 col-sm-12 col-xs-12">
                        <article>
                            <?php //= $page->page_body ?>
                        </article>
                        <!--
                        <p>Рыболовный интернет-магазин «Фишмен.ру» находится в городе Ярославле, ул.Комарова, 3А.</p>
                        <p>Мы осуществляем продажу удилищ, катушек, приманок, лесок и других товаров для рыбалки.</p>
                        <p><a href="/about/contacts">Подробная контактная информация</a></p>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

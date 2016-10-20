<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use backend\assets\AppAsset;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use common\widgets\Alert;

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
                          'brandLabel' => 'My',
                          'brandUrl'   => Yii::$app->homeUrl,
                          'options'    => [
                              'class' => 'navbar-inverse navbar-fixed-top',
                          ],
                      ]);
        $menuItems = [];
        if(Yii::$app->user->isGuest){
            $menuItems[] = ['label' => Yii::t('app','Login'), 'url' => ['/site/login']];
        }else{
            if(Yii::$app->user->can('adminAccess')){
                $menuItems = array_merge($menuItems, [
//                    ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
                    ['label' => Yii::t('app', 'User'), 'url' => ['/type/index', 'nameModel' => 'user']],
                    ['label' => Yii::t('app', 'Realty'), 'url' => ['/type/index', 'nameModel' => 'realty']],
                    ['label' => Yii::t('app', 'PostalCode'), 'url' => ['/type/index', 'nameModel' => 'postalCode']],
                    ['label' => Yii::t('app', 'AdType'), 'url' => ['/type/index', 'nameModel' => 'adType']],
                    ['label' => Yii::t('app', 'PropertyType'), 'url' => ['/type/index', 'nameModel' => 'propertyType']],
                    ['label' => Yii::t('app', 'BuildingType'), 'url' => ['/type/index', 'nameModel' => 'buildingType']],
                    ['label' => Yii::t('app', 'Language'), 'url' => ['/type/index', 'nameModel' => 'language']],
                    ['label' => Yii::t('app', 'Country'), 'url' => ['/type/index', 'nameModel' => 'country']],
                ]);
            }
            $menuItems[] = '<li>'.Html::beginForm(['/site/logout'], 'post').Html::submitButton(Yii::t('app','Logout').' ('.Yii::$app->user->identity->name.')',
                                                                                               ['class' => 'btn btn-link']).Html::endForm().'</li>';
        }
        echo Nav::widget([
                             'options' => ['class' => 'navbar-nav navbar-right'],
                             'items'   => $menuItems,
                         ]);
        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

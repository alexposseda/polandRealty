<?php
    
    /* @var $this \yii\web\View */
    /* @var $content string */
    
    use common\models\LoginForm;
    use frontend\assets\SiteAsset;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use macgyer\yii2materializecss\widgets\Nav;
    use macgyer\yii2materializecss\widgets\Alert;
    use yii\helpers\Url;
    
    SiteAsset::register($this);
    
    $loginFormModel = new LoginForm();
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
    <header class="header">
        <div class="container page-title-wrap relative hide-on-med-and-down">
            <div class="fixed-action-btn horizontal lang-btn click-to-toggle">
                <a class="btn-floating" href="#"><i class="material-icons">language</i></a>
                <ul>
                    <li class="tooltipped" data-position="bottom" data-tooltip="Poland">
                        <a href="#" class="btn-floating"><span class="lang-icon lang-icon-pl"></span></a>
                    </li>
                    <li class="tooltipped" data-position="bottom" data-tooltip="English">
                        <a href="#" class="btn-floating"><span class="lang-icon lang-icon-en"></span></a>
                    </li>
                </ul>
            </div>
            <div class="row no-margin">
                <div class="col l6">
                    <h1 class="page-title"><a href="<?= Url::home() ?>">Site Header</a></h1>
                </div>
                <div class="col l6">
                    <ul class="page-top-line right-align">
                        <?php if(Yii::$app->user->isGuest): ?>
                            <li><a href="<?= Url::to(['site/registration']) ?>"><i class="material-icons">person_add</i>SignUp</a></li>
                            <li><a href="#login-form" class="modal-trigger"><i class="material-icons">person</i>SignIn</a></li>
                        <?php else: ?>
                            <li>
                                <a data-activates="personal-menu" href="#" id="personal-but"><i class="material-icons">face</i><?= Yii::$app->user->identity->name?></a>
                                <ul class="dropdown-content" id="personal-menu">
                                    <li><a href="<?= Url::to(['user/index'])?>">My Ads</a></li>
                                    <li><a href="<?= Url::to(['user/profile'])?>">Profile</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?= Url::to(['site/logout'])?>" data-method="post"><i class="material-icons">exit_to_app</i>Logout</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li><a href="<?= Url::to(['realty/create']) ?>"><i class="material-icons">add</i>Add Advert</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="nav">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo center hide-on-large-only">Site Header</a>
                <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
                <?= Nav::widget([
                                    'options' => ['class' => 'general-menu hide-on-med-and-down'],
                                    'items'   => [
                                        [
                                            'label' => 'Home',
                                            'url'   => ['site/index']
                                        ]
                                    ],
                                ]); ?>
            </div>
        </nav>
        <ul class="side-nav" id="mobile-menu">
            <li class="logo-container center-align">
                <a href="<?= Url::home() ?>">Site Header</a>
            </li>
            <li class="divider"></li>
            <li><a href="<?= Url::home() ?>">Home</a></li>
            <li class="divider"></li>
            <li><a href="<?= Url::to(['realty/create']) ?>"><i class="material-icons">person_add</i>SignUp</a></li>
            <li><a href="#login-form" class="modal-trigger"><i class="material-icons">person</i>SignIn</a></li>
        </ul>
    </header>
    <main class="content">
        <div class="container">
            <?= Alert::widget() ?>
        </div>
        
        <?= $content ?>
    </main>
    
    <footer class="footer"></footer>
    <div id="login-form" class="modal bottom-sheet">
        <div class="modal-content">
            <div class="container">
                <div class="row  no-margin">
                    <div class="col s12 m12 l8 offset-l2 relative">
                        <a href="#!" class="modal-action modal-close modal-close-btn"><i class="material-icons">close</i></a>
                        <h4>Login</h4>
                        <?php $loginForm = ActiveForm::begin([
                            'action' => Url::to(['site/login'])
                                                             ]) ?>
                        <form>
                            <div class="row no-margin-bottom">
                                <?= $loginForm->field($loginFormModel, 'email', ['options' => ['class' => 'input-field col s12 l6']])
                                              ->label('Type your email') ?>
                                <?= $loginForm->field($loginFormModel, 'password', ['options' => ['class' => 'input-field col s12 l6']])
                                              ->passwordInput()
                                              ->label('Type your password') ?>
                            </div>
                            <div class="row">
                                <div class="col s12 l6">
                                    <p>
                                        <?= Html::checkbox('rememberMe', true, [
                                            'class' => 'filled-in',
                                            'id'    => 'remember-checkbox',
                                            'name'  => 'LoginForm[rememberMe]'
                                        ]) ?>
                                        <label for="remember-checkbox">Remember Me</label>
                                    </p>
                                </div>
                                <div class="input-field col s12 l6">
                                    <button class="btn light-blue waves-effect waves-light full-width" type="submit">Submit
                                        <i class="material-icons right">send</i>
                                    </button>
                                    <a href="<?= Url::to(['site/request-password-reset']) ?>">Forgot Password?</a>
                                </div>
                            </div>
                        </form>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
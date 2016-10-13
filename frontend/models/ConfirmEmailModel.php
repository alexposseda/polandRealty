<?php
    
    namespace frontend\models;
    
    use common\components\Notify;
    use common\models\UserIdentity;
    use Yii;
    use yii\base\InvalidParamException;
    use yii\base\Model;

    class ConfirmEmailModel extends Model{
        private $_user;
        
        public function __construct($token ,$config = []){
            if(empty($token) || !is_string($token)){
                throw new InvalidParamException('Email confirm token cannot be blank.');
            }
            
            $this->_user = UserIdentity::findByEmailConfirmToken($token);
            if(!$this->_user){
                throw new InvalidParamException('Wrong email confirm token.');
            }
            
            parent::__construct($config);
        }
        
        public function confirmEmail(){
            $this->_user->removeEmailConfirmToken();
            $this->_user->status = UserIdentity::STATUS_ACTIVE;
            if(!$this->_user->save()){
                Notify::addMessages('error', 'Failed to save user');
            }else{
                Notify::addMessages('success', 'E-mail was successfully verified');
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('registeredUser');
                $auth->assign($authorRole, $this->_user->getId());
                Yii::$app->user->login($this->_user);
            }
        }
    }
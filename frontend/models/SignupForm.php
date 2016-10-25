<?php
    namespace frontend\models;
    
    use common\components\Notify;
    use common\models\UserIdentity;
    use Yii;
    use yii\base\Exception;
    use yii\base\Model;
    use Swift_Plugins_LoggerPlugin;
    use Swift_Plugins_Loggers_ArrayLogger;
    
    /**
     * Signup form
     */
    class SignupForm extends Model{
        public $name;
        public $phone;
        public $email;
        public $password;
        public $password_repeat;
        
        
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    ['name', 'phone', 'email'],
                    'trim'
                ],
                [
                    ['name', 'email', 'phone'],
                    'string',
                    'min' => 2,
                    'max' => 255
                ],
                [
                    'email',
                    'email'
                ],
                [
                    'email',
                    'unique',
                    'targetClass' => '\common\models\User',
                    'message'     => 'This email address has already been taken.'
                ],
                
                [
                    ['email', 'name', 'password', 'password_repeat'],
                    'required'
                ],
                [
                    ['password', 'password_repeat'],
                    'string',
                    'min' => 6
                ],
                [
                    'password',
                    'compare'
                ]
            ];
        }
    
        /**
         * @return bool
         */
        public function signup(){
            if(!$this->validate()){
                Notify::addMessages('error', $this->getErrors());
                return false;
            }
            
            $user = new UserIdentity();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->status = UserIdentity::STATUS_NOT_CONFIRMED;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
    
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if(!$user->save()){
                    throw new Exception('registration failed (cannot save new user)');
                }
                $mailer = Yii::$app->get('mailer');
                $message = $mailer->compose(
                    ['html' => 'confirmEmail-html', 'text' => 'confirmEmail-text'],
                    ['user' => $user]
                )
                                  ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                                  ->setTo($this->email)
                                  ->setSubject('Confirm email for ' . Yii::$app->name);
                $logger = new Swift_Plugins_Loggers_ArrayLogger();
                $mailer->getSwiftMailer()->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
                if (!$message->send()) {
                    throw new Exception($logger->dump());
                }
                $transaction->commit();
                Notify::addMessages('success', 'Check your email for further instructions.');
                return true;
            }catch(Exception $e){
                $transaction->rollBack();
                Notify::addMessages('error', $e->getMessage());
                return false;
            }
        }
    }

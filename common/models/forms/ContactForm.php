<?php

    namespace common\models\forms;

    use Yii;
    use yii\base\Model;

    class ContactForm extends Model{
        public $name;
        public $phone;
        public $email;

        public function rules(){
            return [
                ['name', 'required'],
                ['email', 'email'],
                [['name', 'phone', 'email'], 'string'],
//                ['name', 'default', 'value' => Yii::$app->user->identity->name],
//                ['phone', 'default', 'value' => Yii::$app->user->identity->phone],
//                ['email', 'default', 'value' => Yii::$app->user->identity->email],
            ];
        }

        public function init(){
            $this->name =Yii::$app->user->identity->name;
            $this->phone =Yii::$app->user->identity->phone;
            $this->email =Yii::$app->user->identity->email;
        }

        public function scenarios(){
            return ['default'=>['name','phone','email']];
        }
    }
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
            ];
        }

        public function init(){
            $this->name = Yii::$app->user->identity->name;
            $this->phone = Yii::$app->user->identity->phone;
            $this->email = Yii::$app->user->identity->email;
        }

        public function scenarios(){
            return ['default' => ['name', 'phone', 'email']];
        }

        public function attributeLabels(){
            return [
                'name'  => Yii::t('app', 'Name'),
                'email' => Yii::t('app', 'Email'),
                'phone' => Yii::t('app', 'Phone'),
            ];
        }
    }
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
                ['name', 'default', 'value' => Yii::$app->user->identity->name],
                ['name', 'default', 'value' => Yii::$app->user->identity->phone],
                ['name', 'default', 'value' => Yii::$app->user->identity->email],
            ];
        }
    }
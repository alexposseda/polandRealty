<?php

    namespace common\models;

    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%realty_lang}}".
     *
     * @property integer  $id
     * @property integer  $realty_id
     * @property integer  $language
     * @property string   $description
     * @property integer  $created_at
     * @property integer  $updated_at
     *
     * @property Language $language0
     * @property Realty   $realty
     */
    class RealtyLang extends ActiveRecord{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                ['class' => TimestampBehavior::className(),],
            ];
        }

        /**
         * @inheritdoc
         */
        public static function tableName(){
            return '{{%realty_lang}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['realty_id', 'language', 'created_at', 'updated_at'], 'integer'],
                [['description'], 'string'],
                [['language'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language' => 'id']],
                [['realty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Realty::className(), 'targetAttribute' => ['realty_id' => 'id']],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'          => 'ID',
                'realty_id'   => Yii::t('app', 'Realty'),
                'language'    => Yii::t('app', 'Language'),
                'description' => Yii::t('app', 'Description'),
                'created_at'  => Yii::t('app', 'Created At'),
                'updated_at'  => Yii::t('app', 'Updated At'),
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getLanguage0(){
            return $this->hasOne(Language::className(), ['id' => 'language']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getRealty(){
            return $this->hasOne(Realty::className(), ['id' => 'realty_id']);
        }
    }

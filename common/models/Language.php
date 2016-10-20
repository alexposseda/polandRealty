<?php

    namespace common\models;

    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%language}}".
     *
     * @property integer            $id
     * @property string             $code
     * @property string             $title
     * @property integer            $created_at
     * @property integer            $updated_at
     *
     * @property AdTypeLang[]       $adTypeLangs
     * @property BuildingTypeLang[] $buildingTypeLangs
     * @property PropertyTypeLang[] $propertyTypeLangs
     * @property RealtyLang[]       $realtyLangs
     */
    class Language extends ActiveRecord{
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
            return '{{%language}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['code', 'title'], 'required'],
                [['created_at', 'updated_at'], 'integer'],
                [['code'], 'string', 'max' => 4],
                [['title'], 'string', 'max' => 20],
                [['code'], 'unique'],
                [['title'], 'unique'],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'         => 'ID',
                'code'       => Yii::t('app', 'Code'),
                'title'      => Yii::t('app', 'Title'),
                'created_at' => Yii::t('app', 'Created At'),
                'updated_at' => Yii::t('app', 'Updated At'),
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getAdTypeLangs(){
            return $this->hasMany(AdTypeLang::className(), ['language' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getBuildingTypeLangs(){
            return $this->hasMany(BuildingTypeLang::className(), ['language' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getPropertyTypeLangs(){
            return $this->hasMany(PropertyTypeLang::className(), ['language' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getRealtyLangs(){
            return $this->hasMany(RealtyLang::className(), ['language' => 'id']);
        }

        public static function getAttrib($name = 'full'){
            $attr = [
                'full'   => [
                    'code',
                    'title',
                ],
                'create' => [
                    'code',
                    'title',
                ],
            ];

            return $attr[$name];
        }
    }

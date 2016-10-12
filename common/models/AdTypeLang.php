<?php
    
    namespace common\models;
    
    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;
    
    /**
     * This is the model class for table "{{%ad_type_lang}}".
     *
     * @property integer $id
     * @property integer $ad_type_id
     * @property string  $lang
     * @property string  $title
     * @property integer $created_at
     * @property integer $updated_at
     *
     * @property AdType  $adType
     */
    class AdTypeLang extends ActiveRecord{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                TimestampBehavior::className(),
            ];
        }
        
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return '{{%ad_type_lang}}';
        }
        
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'ad_type_id',
                        'created_at',
                        'updated_at'
                    ],
                    'integer'
                ],
                [
                    [
                        'created_at',
                        'updated_at'
                    ],
                    'required'
                ],
                [
                    ['lang'],
                    'string',
                    'max' => 4
                ],
                [
                    ['title'],
                    'string',
                    'max' => 255
                ],
                [
                    ['ad_type_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => AdType::className(),
                    'targetAttribute' => ['ad_type_id' => 'id']
                ],
            ];
        }
        
        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'         => 'ID',
                'ad_type_id' => 'Ad Type ID',
                'lang'       => 'Lang',
                'title'      => 'Title',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ];
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getAdType(){
            return $this->hasOne(AdType::className(), ['id' => 'ad_type_id']);
        }
    }

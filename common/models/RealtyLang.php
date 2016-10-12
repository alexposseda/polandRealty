<?php
    
    namespace common\models;
    
    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;
    
    /**
     * This is the model class for table "{{%realty_lang}}".
     *
     * @property integer $id
     * @property integer $realty_id
     * @property string  $lang
     * @property string  $description
     * @property integer $created_at
     * @property integer $updated_at
     *
     * @property Realty  $realty
     */
    class RealtyLang extends ActiveRecord{
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
            return '{{%realty_lang}}';
        }
        
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'realty_id',
                        'created_at',
                        'updated_at'
                    ],
                    'integer'
                ],
                [
                    ['description'],
                    'string'
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
                    ['realty_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => Realty::className(),
                    'targetAttribute' => ['realty_id' => 'id']
                ],
            ];
        }
        
        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'          => 'ID',
                'realty_id'   => 'Realty ID',
                'lang'        => 'Lang',
                'description' => 'Description',
                'created_at'  => 'Created At',
                'updated_at'  => 'Updated At',
            ];
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getRealty(){
            return $this->hasOne(Realty::className(), ['id' => 'realty_id']);
        }
    }

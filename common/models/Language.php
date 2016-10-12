<?php
    
    namespace common\models;
    
    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%language}}".
     *
     * @property integer $id
     * @property string  $code
     * @property string  $title
     * @property integer $created_at
     * @property integer $updated_at
     */
    class Language extends ActiveRecord{
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
            return '{{%language}}';
        }
        
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'code',
                        'title',
                        'created_at',
                        'updated_at'
                    ],
                    'required'
                ],
                [
                    [
                        'created_at',
                        'updated_at'
                    ],
                    'integer'
                ],
                [
                    ['code'],
                    'string',
                    'max' => 4
                ],
                [
                    ['title'],
                    'string',
                    'max' => 20
                ],
                [
                    [
                        'code',
                        'title'
                    ],
                    'unique'
                ]
            ];
        }
        
        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'         => 'ID',
                'code'       => 'Code',
                'title'      => 'Title',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ];
        }
    }

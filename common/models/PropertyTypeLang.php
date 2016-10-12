<?php
    
    namespace common\models;
    
    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;
    
    /**
     * This is the model class for table "{{%property_type_lang}}".
     *
     * @property integer      $id
     * @property integer      $property_type_id
     * @property string       $lang
     * @property string       $title
     * @property integer      $created_at
     * @property integer      $updated_at
     *
     * @property PropertyType $propertyType
     */
    class PropertyTypeLang extends ActiveRecord{
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
            return '{{%property_type_lang}}';
        }
        
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'property_type_id',
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
                    ['property_type_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => PropertyType::className(),
                    'targetAttribute' => ['property_type_id' => 'id']
                ],
            ];
        }
        
        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'               => 'ID',
                'property_type_id' => 'Property Type ID',
                'lang'             => 'Lang',
                'title'            => 'Title',
                'created_at'       => 'Created At',
                'updated_at'       => 'Updated At',
            ];
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getPropertyType(){
            return $this->hasOne(PropertyType::className(), ['id' => 'property_type_id']);
        }
    }

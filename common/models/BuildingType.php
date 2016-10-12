<?php
    
    namespace common\models;
    
    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;
    
    /**
     * This is the model class for table "{{%building_type}}".
     *
     * @property integer            $id
     * @property string             $title
     * @property integer            $created_at
     * @property integer            $updated_at
     *
     * @property BuildingTypeLang[] $buildingTypeLangs
     * @property Realty[]           $realties
     */
    class BuildingType extends ActiveRecord{
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
            return '{{%building_type}}';
        }
        
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
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
                    ['title'],
                    'string',
                    'max' => 255
                ],
                [
                    ['title'],
                    'unique'
                ],
            ];
        }
        
        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'         => 'ID',
                'title'      => 'Title',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ];
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getBuildingTypeLangs(){
            return $this->hasMany(BuildingTypeLang::className(), ['building_type_id' => 'id']);
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getRealties(){
            return $this->hasMany(Realty::className(), ['building_type_id' => 'id']);
        }
    }

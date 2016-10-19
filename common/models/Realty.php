<?php

    namespace common\models;

    use common\models\forms\ContactForm;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
    use yii\base\InvalidValueException;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%realty}}".
     *
     * @property integer      $id
     * @property integer      $ad_type_id
     * @property integer      $property_type_id
     * @property integer      $building_type_id
     * @property integer      $created_by
     * @property double       $price
     * @property double       $area
     * @property integer      $floors_count
     * @property integer      $floor
     * @property integer      $rooms_count
     * @property string       $gallery
     * @property string       $description
     * @property string       $contact
     * @property string       $status
     * @property integer      $created_at
     * @property integer      $updated_at
     *
     * @property Location   $location
     * @property AdType       $adType
     * @property BuildingType $buildingType
     * @property User         $createdBy
     * @property PropertyType $propertyType
     * @property RealtyLang[] $realtyLangs
     */
    class Realty extends ActiveRecord{
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
            return '{{%realty}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'ad_type_id',
                        'property_type_id',
                        'building_type_id',
                        'created_by',
                        'floors_count',
                        'floor',
                        'rooms_count',
                        'created_at',
                        'updated_at',
                    ],
                    'integer',
                ],
                [['price', 'description', 'contact'], 'required'],
                [['price', 'area'], 'number'],
                [['gallery', 'description', 'contact', 'status'], 'string'],
                [['ad_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdType::className(), 'targetAttribute' => ['ad_type_id' => 'id']],
                [
                    ['building_type_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => BuildingType::className(),
                    'targetAttribute' => ['building_type_id' => 'id'],
                ],
                [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
                ['created_by', 'default', 'value' => Yii::$app->user->identity->id],
                [
                    ['property_type_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => PropertyType::className(),
                    'targetAttribute' => ['property_type_id' => 'id'],
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'                 => 'ID',
                'ad_type_id'         => Yii::t('app', 'Ad Type'),
                'adType.title'       => Yii::t('app', 'Ad Type'),
                'property_type_id'   => Yii::t('app', 'Property Type'),
                'propertyType.title' => Yii::t('app', 'Property Type'),
                'building_type_id'   => Yii::t('app', 'Building Type'),
                'buildingType.title' => Yii::t('app', 'Building Type'),
                'created_by'         => Yii::t('app', 'Created By'),
                'createdBy.name'     => Yii::t('app', 'Created By'),
                'price'              => Yii::t('app', 'Price'),
                'area'               => Yii::t('app', 'Area'),
                'floors_count'       => Yii::t('app', 'Floors Count'),
                'floor'              => Yii::t('app', 'Floor'),
                'rooms_count'        => Yii::t('app', 'Rooms Count'),
                'gallery'            => Yii::t('app', 'Gallery'),
                'description'        => Yii::t('app', 'Description'),
                'contact'            => Yii::t('app', 'Contact'),
                'status'             => Yii::t('app', 'Status'),
                'created_at'         => Yii::t('app', 'Created At'),
                'updated_at'         => Yii::t('app', 'Updated At'),
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getLocation(){
            return $this->hasOne(Location::className(), ['realty_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getAdType(){
            return $this->hasOne(AdType::className(), ['id' => 'ad_type_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getBuildingType(){
            return $this->hasOne(BuildingType::className(), ['id' => 'building_type_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCreatedBy(){
            return $this->hasOne(User::className(), ['id' => 'created_by']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getPropertyType(){
            return $this->hasOne(PropertyType::className(), ['id' => 'property_type_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getRealtyLangs(){
            return $this->hasMany(RealtyLang::className(), ['realty_id' => 'id']);
        }

        public static function getAttrib($name = 'full'){

            $attr = [
                'full'   => [
                    'adType.title',
                    'propertyType.title',
                    'buildingType.title',
                    'createdBy.name',
                    'price',
                    'area',
                    'floors_count',
                    'floor',
                    'rooms_count',
                    'status',
//                    'created_at:datetime',
//                    'updated_at:datetime',
                ],
                'create' => [
                    'ad_type_id',
                    'property_type_id',
                    'building_type_id',
                    'price',
                    'area',
                    'floors_count',
                    'floor',
                    'rooms_count',
                    'gallery',
                    'description',
                    'contact',
                ],
            ];

            return $attr[$name];
        }

        public function afterSave(){
            $gallery = json_decode($this->gallery);

            if(!empty($gallery)){
                foreach($gallery as $pic){
                    FileManager::getInstance()
                               ->removeFile($pic);
                }
            }
        }

    }

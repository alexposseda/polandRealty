<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%realty}}".
 *
 * @property integer $id
 * @property integer $ad_type_id
 * @property integer $property_type_id
 * @property integer $building_type_id
 * @property double $price
 * @property double $area
 * @property integer $floors_count
 * @property integer $floor
 * @property integer $rooms_count
 * @property string $gallery
 * @property string $description
 * @property string $contact
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $status
 * @property integer $created_by
 *
 * @property Location[] $locations
 * @property AdType $adType
 * @property BuildingType $buildingType
 * @property User $createdBy
 * @property PropertyType $propertyType
 * @property RealtyLang[] $realtyLangs
 */
class Realty extends \yii\db\ActiveRecord
{
    /**
        * @inheritdoc
    */
    public function behaviors(){
        return [
            ['class'=>TimestampBehavior::className(),]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%realty}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_type_id', 'property_type_id', 'building_type_id', 'floors_count', 'floor', 'rooms_count', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['price', 'description', 'contact', 'created_at', 'updated_at'], 'required'],
            [['price', 'area'], 'number'],
            [['gallery', 'description', 'contact', 'status'], 'string'],
            [['ad_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdType::className(), 'targetAttribute' => ['ad_type_id' => 'id']],
            [['building_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingType::className(), 'targetAttribute' => ['building_type_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['property_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyType::className(), 'targetAttribute' => ['property_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ad_type_id' => 'Ad Type ID',
            'property_type_id' => 'Property Type ID',
            'building_type_id' => 'Building Type ID',
            'price' => 'Price',
            'area' => 'Area',
            'floors_count' => 'Floors Count',
            'floor' => 'Floor',
            'rooms_count' => 'Rooms Count',
            'gallery' => 'Gallery',
            'description' => 'Description',
            'contact' => 'Contact',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['realty_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdType()
    {
        return $this->hasOne(AdType::className(), ['id' => 'ad_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingType()
    {
        return $this->hasOne(BuildingType::className(), ['id' => 'building_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyType()
    {
        return $this->hasOne(PropertyType::className(), ['id' => 'property_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealtyLangs()
    {
        return $this->hasMany(RealtyLang::className(), ['realty_id' => 'id']);
    }
}

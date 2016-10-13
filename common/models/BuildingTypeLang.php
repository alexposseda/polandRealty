<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%building_type_lang}}".
 *
 * @property integer $id
 * @property integer $building_type_id
 * @property string $lang
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BuildingType $buildingType
 */
class BuildingTypeLang extends \yii\db\ActiveRecord
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
        return '{{%building_type_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_type_id', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['lang'], 'string', 'max' => 4],
            [['title'], 'string', 'max' => 255],
            [['building_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingType::className(), 'targetAttribute' => ['building_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'building_type_id' => 'Building Type ID',
            'lang' => 'Lang',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingType()
    {
        return $this->hasOne(BuildingType::className(), ['id' => 'building_type_id']);
    }
}

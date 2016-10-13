<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%property_type_lang}}".
 *
 * @property integer $id
 * @property integer $property_type_id
 * @property integer $language
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Language $language0
 * @property PropertyType $propertyType
 */
class PropertyTypeLang extends ActiveRecord
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
        return '{{%property_type_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_type_id', 'language', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language' => 'id']],
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
            'property_type_id' => 'Property Type ID',
            'language' => 'Language',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage0()
    {
        return $this->hasOne(Language::className(), ['id' => 'language']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyType()
    {
        return $this->hasOne(PropertyType::className(), ['id' => 'property_type_id']);
    }
}

<?php

namespace common\models;

use common\components\MultyLangBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%building_type}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BuildingTypeLang[] $buildingTypeLangs
 * @property Realty[] $realties
 */
class BuildingType extends ActiveRecord
{
    /**
        * @inheritdoc
    */
    public function behaviors(){
        return [
            ['class'=>TimestampBehavior::className()],
            'ml' => [
                'class' => MultyLangBehavior::className(),
                'attributes' => ['title'],
                'relationName' => 'building_type_id'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%building_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app', 'Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingTypeLangs()
    {
        return $this->hasMany(BuildingTypeLang::className(), ['building_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealties()
    {
        return $this->hasMany(Realty::className(), ['building_type_id' => 'id']);
    }

    public static function getAttrib($name = 'full'){
        $attr = [
            'full'   => ['title'],
            'create'   => ['title'],
        ];

        return $attr[$name];
    }

}

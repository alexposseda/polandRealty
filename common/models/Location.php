<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%location}}".
 *
 * @property integer $id
 * @property integer $realty_id
 * @property integer $country_id
 * @property string $city
 * @property string $region
 * @property string $street
 * @property string $coordinates
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Country $country
 * @property Realty $realty
 */
class Location extends ActiveRecord
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
        return '{{%location}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['realty_id', 'country_id', 'created_at', 'updated_at'], 'integer'],
            [['city', 'street', 'coordinates'], 'required'],
            [['city', 'region', 'street', 'coordinates'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['realty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Realty::className(), 'targetAttribute' => ['realty_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'realty_id' => Yii::t('app', 'Realty'),
            'country_id' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'region' => Yii::t('app', 'Region'),
            'street' => Yii::t('app', 'Street'),
            'coordinates' => Yii::t('app', 'Coordinates'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealty()
    {
        return $this->hasOne(Realty::className(), ['id' => 'realty_id']);
    }

    public function getAttrib($name = 'full'){

        $attr = [
            'full'   => [
                'realty_id',
                'country.name',
                'city',
                'region',
                'street',
                'coordinates',
                'created_at:datetime',
                'updated_at:datetime',
            ],
            'create' => [
            ],
        ];

        return $attr[$name];
    }

}

<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ad_type_lang}}".
 *
 * @property integer $id
 * @property integer $ad_type_id
 * @property integer $language
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AdType $adType
 * @property Language $language0
 */
class AdTypeLang extends ActiveRecord
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
        return '{{%ad_type_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_type_id', 'language', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['ad_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdType::className(), 'targetAttribute' => ['ad_type_id' => 'id']],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language' => 'id']],
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
            'language' => 'Language',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getLanguage0()
    {
        return $this->hasOne(Language::className(), ['id' => 'language']);
    }
}

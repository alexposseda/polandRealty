<?php

    namespace common\models;

    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%postal_code}}".
     *
     * @property integer $id
     * @property integer $country_id
     * @property integer $code
     * @property string  $region
     * @property string  $city
     * @property string  $street
     * @property integer $created_at
     * @property integer $updated_at
     *
     * @property Country $country
     */
    class PostalCode extends ActiveRecord{
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
            return '{{%postal_code}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['country_id', 'code', 'created_at', 'updated_at'], 'integer'],
                [['city', 'street'], 'required'],
                [['street'], 'string'],
                [['region', 'city'], 'string', 'max' => 255],
                [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'         => 'ID',
                'country_id' => 'Country ID',
                'code'       => 'Code',
                'region'     => 'Region',
                'city'       => 'City',
                'street'     => 'Street',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCountry(){
            return $this->hasOne(Country::className(), ['id' => 'country_id']);
        }

        public static function getAttrib($name = 'full'){
            $attr = [
                'full'   => [
                    'country.name',
                    'code',
                    'region',
                    'city',
                    'street',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
                'create' => [
                    'country_id',
                    'code',
                    'region',
                    'city',
                    'street',
                ],
            ];

            return $attr[$name];
        }
    }

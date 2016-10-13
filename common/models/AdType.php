<?php

    namespace common\models;

    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "{{%ad_type}}".
     *
     * @property integer      $id
     * @property string       $title
     * @property integer      $created_at
     * @property integer      $updated_at
     *
     * @property AdTypeLang[] $adTypeLangs
     * @property Realty[]     $realties
     */
    class AdType extends ActiveRecord{
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
            return '{{%ad_type}}';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
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
        public function getAdTypeLangs(){
            return $this->hasMany(AdTypeLang::className(), ['ad_type_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getRealties(){
            return $this->hasMany(Realty::className(), ['ad_type_id' => 'id']);
        }

        public static function getAttrib($name = 'full'){
            $attr = [
                'full'   => ['title', 'created_at:datetime', 'updated_at:datetime'],
                'create'   => ['title'],
            ];

            return $attr[$name];
        }
    }

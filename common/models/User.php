<?php
    
    namespace common\models;
    
    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;
    
    /**
     * This is the model class for table "{{%user}}".
     *
     * @property integer  $id
     * @property string   $email
     * @property string   $name
     * @property string   $phone
     * @property string   $auth_key
     * @property string   $password_hash
     * @property string   $password_reset_token
     * @property string   $email_confirm_token
     * @property integer  $status
     * @property integer  $created_at
     * @property integer  $updated_at
     *
     * @property Realty[] $realties
     */
    class User extends ActiveRecord{
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
            return '{{%user}}';
        }
        
        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'email',
                        'name',
                        'auth_key',
                        'password_hash',
                    ],
                    'required'
                ],
                [
                    [
                        'status',
                        'created_at',
                        'updated_at'
                    ],
                    'integer'
                ],
                [
                    [
                        'email',
                        'name',
                        'phone',
                        'password_hash',
                        'password_reset_token',
                        'email_confirm_token'
                    ],
                    'string',
                    'max' => 255
                ],
                [
                    ['auth_key'],
                    'string',
                    'max' => 32
                ],
                [
                    ['email'],
                    'unique'
                ],
                [
                    ['password_reset_token', 'email_confirm_token'],
                    'unique'
                ],
            ];
        }
        
        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'                   => 'ID',
                'email'                => 'Email',
                'name'                 => 'Name',
                'phone'                => 'Phone',
                'auth_key'             => 'Auth Key',
                'password_hash'        => 'Password Hash',
                'password_reset_token' => 'Password Reset Token',
                'email_confirm_token'  => 'Email Confirm Token',
                'status'               => 'Status',
                'created_at'           => 'Created At',
                'updated_at'           => 'Updated At',
            ];
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getRealties(){
            return $this->hasMany(Realty::className(), ['created_by' => 'id']);
        }
    }

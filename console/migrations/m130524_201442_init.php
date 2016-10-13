<?php

    use yii\db\Migration;

    class m130524_201442_init extends Migration{
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%user}}', [
                'id'                   => $this->primaryKey(),
                'email'                => $this->string()
                                               ->notNull()
                                               ->unique(),
                'name'                 => $this->string()
                                               ->notNull(),
                'phone'                => $this->string(),
                'auth_key'             => $this->string(32)
                                               ->notNull(),
                'password_hash'        => $this->string()
                                               ->notNull(),
                'password_reset_token' => $this->string()
                                               ->unique(),
                'email_confirm_token'  => $this->string()
                                               ->unique(),
                'status'               => $this->smallInteger()
                                               ->notNull()
                                               ->defaultValue(1),
                'created_at'           => $this->integer(),
                'updated_at'           => $this->integer(),
            ], $tableOptions);

            echo 'Enter admin email: ';
            $email = trim(fgets(STDIN));
            echo 'Enter admin password: ';
            $password = trim(fgets(STDIN));
            $time = time();

            $this->insert('{{%user}}', [
                'id'            => 1,
                'email'         => $email,
                'name'          => 'admin',
                'auth_key'      => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash($password),
                'status'        => 10,
                'created_at'    => $time,
                'updated_at'    => $time,
            ]);
        }

        public function down(){
            $this->dropTable('{{%user}}');
        }
    }

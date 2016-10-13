<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `countries`.
     */
    class m161011_121944_create_country_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%country}}', [
                'id'         => $this->primaryKey(),
                'name'       => $this->string()
                                     ->notNull()
                                     ->unique(),
                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),
            ], $tableOptions);
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropTable('{{%country}}');
        }
    }

<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `ad_type`.
     */
    class m161011_103233_create_ad_type_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('{{%ad_type}}', [
                'id'         => $this->primaryKey(),
                'title'      => $this->string()
                                     ->notNull()
                                     ->unique(),
                'created_at' => $this->integer()
                                     ->notNull(),
                'updated_at' => $this->integer()
                                     ->notNull(),
            ], $tableOptions);
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropTable('{{%ad_type}}');
        }
    }

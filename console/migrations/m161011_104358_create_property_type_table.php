<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `property_type`.
     */
    class m161011_104358_create_property_type_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%property_type}}', [
                'id'         => $this->primaryKey(),
                'title'      => $this->string()
                                     ->unique()
                                     ->notNull(),
                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),
            ], $tableOptions);
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropTable('{{%property_type}}');
        }
    }

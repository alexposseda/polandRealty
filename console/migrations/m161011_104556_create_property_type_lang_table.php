<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `property_type_lang`.
     */
    class m161011_104556_create_property_type_lang_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('{{%property_type_lang}}', [
                'id'               => $this->primaryKey(),
                'property_type_id' => $this->integer(),
                'lang'             => $this->string(4),
                'title'            => $this->string(),
                'created_at'       => $this->integer()
                                           ->notNull(),
                'updated_at'       => $this->integer()
                                           ->notNull(),

            ], $tableOptions);

            $this->createIndex('PropertyTypeLangCode', '{{%property_type_lang}}', 'lang');
            $this->addForeignKey('PropertyTypeLang_FK', '{{%property_type_lang}}', 'property_type_id', '{{%property_type}}', 'id', 'CASCADE', 'CASCADE');
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('PropertyTypeLang_FK', '{{%property_type_lang}}');
            $this->dropTable('property_type_lang');
        }
    }

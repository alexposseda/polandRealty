<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `ad_type_lang`.
     */
    class m161011_103904_create_ad_type_lang_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('{{%ad_type_lang}}', [
                'id'         => $this->primaryKey(),
                'ad_type_id' => $this->integer(),
                'lang'       => $this->string(4),
                'title'      => $this->string(),
                'created_at' => $this->integer()
                                     ->notNull(),
                'updated_at' => $this->integer()
                                     ->notNull(),
            ], $tableOptions);
            $this->createIndex('AdTypeLangCode', '{{%ad_type_lang}}', 'lang');
            $this->addForeignKey('AdTypeLang_FK', '{{%ad_type_lang}}', 'ad_type_id', '{{%ad_type}}', 'id', 'CASCADE', 'CASCADE');
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('AdTypeLang_FK', '{{%ad_type_lang}}');
            $this->dropTable('{{%ad_type_lang}}');
        }
    }

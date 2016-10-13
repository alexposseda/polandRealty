<?php
    
    use yii\db\Migration;
    
    /**
     * Handles the creation for table `realty_lang`.
     */
    class m161011_120612_create_realty_lang_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('{{%realty_lang}}', [
                'id'          => $this->primaryKey(),
                'realty_id'   => $this->integer(),
                'language'    => $this->integer(),
                'description' => $this->text(),
                'created_at'  => $this->integer(),
                'updated_at'  => $this->integer(),
            ], $tableOptions);
            
            $this->addForeignKey('RealtyLang_FK', '{{%realty_lang}}', 'realty_id', '{{%realty}}', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('LangCode_realty_FK', '{{%realty_lang}}', 'language', '{{%language}}', 'id', 'CASCADE', 'CASCADE');
        }
        
        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('RealtyLang_FK', '{{%realty_lang}}');
            $this->dropForeignKey('LangCode_realty_FK', '{{%realty_lang}}');
            $this->dropTable('{{%realty_lang}}');
        }
    }

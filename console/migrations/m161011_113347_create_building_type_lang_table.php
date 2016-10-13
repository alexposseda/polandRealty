<?php
    
    use yii\db\Migration;
    
    /**
     * Handles the creation for table `building_type_lang`.
     */
    class m161011_113347_create_building_type_lang_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('{{%building_type_lang}}', [
                'id'               => $this->primaryKey(),
                'building_type_id' => $this->integer(),
                'language'         => $this->integer(),
                'title'            => $this->string(),
                'created_at'       => $this->integer(),
                'updated_at'       => $this->integer(),
            ], $tableOptions);
            
            $this->addForeignKey('BuildingTypeLang_FK', '{{%building_type_lang}}', 'building_type_id', '{{%building_type}}', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('LangCode_buildingtype_FK', '{{%building_type_lang}}', 'language', '{{%language}}', 'id', 'CASCADE', 'CASCADE');
        }
        
        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('BuildingTypeLang_FK', '{{%building_type_lang}}');
            $this->dropForeignKey('LangCode_buildingtype_FK', '{{%building_type_lang}}');
            $this->dropTable('{{%building_type_lang}}');
        }
    }

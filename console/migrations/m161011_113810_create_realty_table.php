<?php
    
    use yii\db\Migration;
    
    /**
     * Handles the creation for table `realty`.
     */
    class m161011_113810_create_realty_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            
            $this->createTable('{{%realty}}', [
                'id'               => $this->primaryKey(),
                'ad_type_id'       => $this->integer(),
                'property_type_id' => $this->integer(),
                'building_type_id' => $this->integer(),
                'created_by'       => $this->integer(),
                'price'            => $this->float()
                                           ->notNull(),
                'area'             => $this->float(),
                'floors_count'     => $this->integer(),
                'floor'            => $this->integer(),
                'rooms_count'      => $this->integer(),
                'gallery'          => $this->text(),
                'description'      => $this->text()
                                           ->notNull(),
                'contact'          => $this->text()
                                           ->notNull(),
                'status'           => "enum('active','inactive') NOT NULL DEFAULT 'active'",
                'created_at'       => $this->integer(),
                'updated_at'       => $this->integer(),
            
            ], $tableOptions);
            
            $this->addForeignKey('AdType_FK', '{{%realty}}', 'ad_type_id', '{{%ad_type}}', 'id', 'SET NULL', 'CASCADE');
            $this->addForeignKey('PropertyType_FK', '{{%realty}}', 'property_type_id', '{{%property_type}}', 'id', 'SET NULL', 'CASCADE');
            $this->addForeignKey('BuildingType_FK', '{{%realty}}', 'building_type_id', '{{%building_type}}', 'id', 'SET NULL', 'CASCADE');
            $this->addForeignKey('Creator_FK', '{{%realty}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        }
        
        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('AdType_FK', '{{%realty}}');
            $this->dropForeignKey('PropertyType_FK', '{{%realty}}');
            $this->dropForeignKey('BuildingType_FK', '{{%realty}}');
            $this->dropForeignKey('Creator_FK', '{{%realty}}');
            $this->dropTable('{{%realty}}');
        }
    }

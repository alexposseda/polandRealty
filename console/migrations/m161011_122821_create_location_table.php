<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `location`.
     */
    class m161011_122821_create_location_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%location}}', [
                'id'          => $this->primaryKey(),
                'realty_id'   => $this->integer(),
                'country_id'  => $this->integer(),
                'city'        => $this->string()->notNull(),
                'region'      => $this->string(),
                'street'      => $this->string()->notNull(),
                'coordinates' => $this->string()->notNull(),
                'created_at'  => $this->integer()
                                      ->notNull(),
                'updated_at'  => $this->integer()
                                      ->notNull(),
            ], $tableOptions);

            $this->addForeignKey('RealtyId_Location_FK', '{{%location}}', 'realty_id', '{{%realty}}', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('CountryId_Location_FK', '{{%location}}', 'country_id', '{{%country}}', 'id', 'RESTRICT', 'CASCADE');
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('RealtyId_Location_FK', '{{%location}}');
            $this->dropForeignKey('CountryId_Location_FK', '{{%location}}');
            $this->dropTable('{{%location}}');
        }
    }

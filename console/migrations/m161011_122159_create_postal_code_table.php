<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `postal_code`.
     */
    class m161011_122159_create_postal_code_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%postal_code}}', [
                'id' => $this->primaryKey(),
                'country_id' => $this->integer(),
                'code' => $this->integer(),
                'region' => $this->string(),
                'city' => $this->string()->notNull(),
                'street' => $this->text()->notNull(),
                'created_at'  => $this->integer()
                                      ->notNull(),
                'updated_at'  => $this->integer()
                                      ->notNull(),
            ], $tableOptions);

            $this->addForeignKey('CountryId_FK', '{{%postal_code}}', 'country_id', '{{%country}}', 'id', 'RESTRICT', 'CASCADE');
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('CountryId_FK', '{{%postal_code}}');
            $this->dropTable('{{%postal_code}}');
        }
    }

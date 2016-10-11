<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `language`.
     */
    class m161011_103426_create_language_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $tableOptions = null;
            if($this->db->driverName === 'mysql'){
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('{{%language}}', [
                'id'         => $this->primaryKey(),
                'code'       => $this->string(4),
                'title'      => $this->string(20),
                'created_at' => $this->integer()
                                     ->notNull(),
                'updated_at' => $this->integer()
                                     ->notNull(),
            ], $tableOptions);

            $createdTime = time();
            $this->batchInsert('{{%language}}', [
                'code',
                'title',
                'created_at',
                'updated_at'
            ], [
                                   [
                                       'en',
                                       'english',
                                       $createdTime,
                                       $createdTime
                                   ],
                                   [
                                       'po',
                                       'polski',
                                       $createdTime,
                                       $createdTime
                                   ]
                               ]);
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropTable('{{%language}}');
        }
    }

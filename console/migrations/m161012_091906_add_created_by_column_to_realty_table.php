<?php
    
    use yii\db\Migration;
    
    /**
     * Handles adding created_by to table `realty`.
     */
    class m161012_091906_add_created_by_column_to_realty_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $this->addColumn('{{%realty}}', 'created_by', $this->integer());
            $this->addForeignKey('Creator_FK', '{{%realty}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        }
        
        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropForeignKey('Creator_FK', '{{%realty}}');
            $this->dropColumn('{{%realty}}', 'created_by');
        }
    }

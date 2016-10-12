<?php
    
    use yii\db\Migration;
    
    /**
     * Handles adding status to table `realty`.
     */
    class m161012_085003_add_status_column_to_realty_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $this->addColumn('{{%realty}}', 'status', "enum('active','inactive') NOT NULL DEFAULT 'active'");
        }
        
        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropColumn('{{%realty}}', 'status');
        }
    }

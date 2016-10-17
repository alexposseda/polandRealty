<?php

    namespace common\models\forms;

    use common\models\Location;
    use common\models\Realty;
    use Yii;
    use yii\base\Exception;
    use yii\base\Model;

    class RealtyForm extends Model{
        public $realty;
        public $contact;
        public $location;

        public function __construct(Realty $realty){
            $this->realty = $realty;
            $this->contact = new ContactForm();
            if($this->realty->contact){
                $tmp = json_decode($this->realty->contact);
                $this->contact->name = $tmp->name;
                $this->contact->phone = $tmp->phone;
                $this->contact->email = $tmp->email;
            }
            $this->location = Location::findOne(['realty_id' => $this->realty->id]);
            if(!$this->location){
                $this->location = new Location();
            }
        }

        public function load(){
            return $this->realty->load(Yii::$app->request->post()) && $this->contact->load(Yii::$app->request->post()) && $this->location->load(Yii::$app->request->post());
        }

        public function save(){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $this->realty->contact = json_encode($this->contact);
                if(!$this->realty->save()){
                    throw new Exception('');
                }
                $this->location->realty_id = $this->realty->id;
                if(!$this->location->save()){
                    throw new Exception('');
                }
                $transaction->commit();

                return true;
            }catch(Exception $e){
                $transaction->rollBack();

                return false;
            }
        }
    }
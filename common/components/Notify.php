<?php
    
    namespace common\components;
    
    use Yii;
    use yii\base\Object;

    class Notify extends Object{
        const SESSION_KEY = 'fl';
        
        public static function addMessages($type, $messages){
            $flashes = Yii::$app->session->get(self::SESSION_KEY);
            if(empty($flashes)){
               $flashes = [];
            }
            
            if(is_array($messages)){
                foreach($messages as $message){
                    $flashes[] = [$type => implode('<br>',$message)];
                    Yii::$app->session->addFlash($type, implode('<br>',$message));
                }
            }else{
                $flashes[] = [$type => $messages];
                Yii::$app->session->addFlash($type, $messages);
            }
            
            Yii::$app->session->set(self::SESSION_KEY, $flashes);
        }
        
        public static function showMessages(){
            $messages = Yii::$app->session->get(self::SESSION_KEY);
            if(!empty($messages)){
                foreach($messages as $key => $val){
                    Yii::$app->session->addFlash($key, $val);
                }
                Yii::$app->session->remove(self::SESSION_KEY);
            }
        }
        
    }
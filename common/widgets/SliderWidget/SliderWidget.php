<?php

    namespace common\widgets\SliderWidget;

    use common\widgets\SliderWidget\assets\SliderWidgetAsset;
    use yii\base\Widget;
    use yii\bootstrap\Html;
    use yii\web\View;

    class SliderWidget extends Widget{
        public $label;
        public $labelOption = ['class' => 'label no-marg-bot'];

        public $model;
        public $attribute;
        public $inputId;

        public $type = 'double';
        public $postfix;
        public $interval;

        public function init(){
            if(empty($this->inputId)){
                $this->inputId = self::getId().'slider-'.$this->attribute;
            }else{
                $this->inputId = self::getId().$this->inputId;
            }
        }


        public function run(){
            SliderWidgetAsset::register(\Yii::$app->getView());
            $this->registerJS();
            $input = Html::tag('p', $this->label, $this->labelOption);
            $input .= Html::activeInput('text', $this->model, $this->attribute, ['id' => $this->inputId]);

            return $input;
        }

        private function registerJS(){
            $js = <<<JS
            var myslider = {
                'id': '{$this->inputId}',
                'type': '{$this->type}',
                'postfix': '{$this->postfix}',
                'min': '{$this->interval['min']}',
                'max': '{$this->interval['max']}'};
                createSlider(myslider);
JS;
            \Yii::$app->getView()
                      ->registerJs($js, View::POS_END);
        }


    }
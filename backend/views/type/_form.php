<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \yii\db\ActiveRecord
     */
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\bootstrap\Tabs;
    use yii\helpers\ArrayHelper;
    
    function getRelation($attribute){
        if(strpos($attribute, '_id') !== false ){
            $propertyName = '\common\models\\'.ucfirst(substr($attribute, 0, strpos($attribute, '_id')));
            return ArrayHelper::map($propertyName::find()->all(), 'id', 'name');
        }
        return null;
    }
    
    /**
     * @param ActiveForm $form
     * @param            $model
     * @param            $attributes
     * @param null       $index
     *
     * @return string
     */
    
    function getInputs($form, $model, $attributes, $index = null){
        $str = '';
        foreach($attributes as $attr){
            if(!is_null($index)){
                $attrName = "[$index]$attr";
            }else{
                $attrName = $attr;
            }
            
            $relation = getRelation($attr);
            $lang = (isset($model->language0)) ? $model->language0->code : Yii::$app->sourceLanguage;
            if(!is_null($relation)){
                $str .= $form->field($model, $attrName)->dropDownList($relation)->label(Yii::t('app', ucfirst($attr), [], $lang));
            }else{
                $str .= $form->field($model, $attrName)
                             ->label(Yii::t('app', ucfirst($attr), [], $lang));
            }
        }

        return $str;
    }
?>
<?php $form = ActiveForm::begin(); ?>
<?php
    $formItems = [
        [
            'label'   => Yii::$app->sourceLanguage,
            'content' => getInputs($form, $model, $model->getAttrib('create')),
        ],
    ];

    if($model->getBehavior('ml')){
        $langModels = $model->getLangModelsForForm();
        if(!empty($langModels)){
            foreach($langModels as $index => $lm){
                $formItems[] = [
                    'label'   => $lm->language0->code,
                    'content' => getInputs($form, $lm, $model->getBehavior('ml')->attributes, $index).Html::activeHiddenInput($lm, "[$index]lang",
                                                                                                                              ['value' => $lm->language0->id]),
                ];
            }
        }
    }

?>


<?= Tabs::widget([
                     'items' => $formItems,
                 ]) ?>
<?= Html::submitButton(($model->isNewRecord) ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                       ['class' => 'btn '.(($model->isNewRecord) ? 'btn-primary' : 'btn-warning')]) ?>
<?php ActiveForm::end(); ?>

<?php

    namespace common\models\search;

    use common\models\Realty;
    use yii\data\ActiveDataProvider;

    class RealtySearch extends Realty{
        public $name;

        public function getInterval($attribute){
            $query = Realty::find();

            $minProp = $query->min($attribute);

            $maxProp = $query->max($attribute);

            return [
                'min' => $minProp,
                'max' => $maxProp
            ];
        }

        public function rules(){
            return [
                [['name', 'price', 'area'], 'string'],
                [['ad_type_id', 'property_type_id', 'building_type_id'], 'integer'],
            ];
        }

        public function search($params){
            $query = Realty::find()
                           ->orderBy('created_at');

            $dataProvider = new ActiveDataProvider([
                                                       'query'      => $query,
                                                       'pagination' => [
                                                           'pageSize' => 9
                                                       ],
                                                   ]);
            $this->load($params);
            if(!$this->validate()){
                return $dataProvider;
            }

            $query->andFilterWhere(['ad_type_id' => $this->ad_type_id])
                  ->andFilterWhere(['property_type_id' => $this->property_type_id,])
                  ->andFilterWhere(['building_type_id' => $this->building_type_id]);

            $query->andFilterWhere(['like', 'createdBy.name', $this->name]);

            $price = explode(';', $this->price);
            $area = explode(';', $this->area);

            $query->andFilterWhere(['between', 'area', $area[0], $area[1]])
                  ->andFilterWhere(['between', 'price', $price[0], $price[1]]);

            $query->andFilterWhere(['like', 'location.region', $this->location->region])
                  ->andFilterWhere(['like', 'location.city', $this->location->city])
                  ->andFilterWhere(['like', 'location.country.name', $this->location->country->name]);

            return $dataProvider;
        }
    }
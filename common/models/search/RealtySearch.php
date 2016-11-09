<?php

namespace common\models\search;

use common\models\Realty;
use Yii;
use yii\data\ActiveDataProvider;

class RealtySearch extends Realty
{
    public $priceFrom;
    public $priceTo;
    public $areaFrom;
    public $areaTo;

    public $country_id;
    public $postalCode;
    public $region;
    public $city;
    public $street;

    public function attributeLabels()
    {
        return [
            'priceFrom' => Yii::t('app', 'Price From'),
            'priceTo' => Yii::t('app', 'Price To'),
            'areaFrom' => Yii::t('app', 'Area From'),
            'areaTo' => Yii::t('app', 'Area To'),
        ];
    }

    public function rules()
    {
        return [
            [['created_by','ad_type_id', 'building_type_id', 'property_type_id', 'country_id', 'postalCode', 'priceFrom', 'priceTo', 'areaFrom', 'areaTo',], 'integer'],
            [['region', 'city', 'street',], 'string'],
        ];
    }

    public function search($params = [])
    {
        $query = Realty::find()
            ->orderBy('created_at');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->priceFrom) || !empty($this->priceTo)) {
            $this->priceFrom = !empty($this->priceFrom) ? $this->priceFrom : self::find()
                ->min('price');
            $this->priceTo = !empty($this->priceTo) ? $this->priceTo : self::find()
                ->max('price');
        }

        if (!empty($this->areaFrom) || !empty($this->areaTo)) {
            $this->areaFrom = !empty($this->areaFrom) ? $this->areaFrom : self::find()
                ->min('area');
            $this->areaTo = !empty($this->areaTo) ? $this->areaTo : self::find()
                ->max('area');
        }

        $query->andFilterWhere(['created_by' => $this->created_by]);
        $query->andFilterWhere(['ad_type_id' => $this->ad_type_id])
            ->andFilterWhere(['property_type_id' => $this->property_type_id,])
            ->andFilterWhere(['building_type_id' => $this->building_type_id]);

        $query->andFilterWhere(['between', 'area', $this->areaFrom, $this->areaTo])
            ->andFilterWhere(['between', 'price', $this->priceFrom, $this->priceTo]);

        if (!empty($this->city)) {
            $query->joinWith(['location'])
                ->andFilterWhere(['like', 'city', $this->city]);
        }
        if (!empty($this->street)) {
            $query->joinWith(['location'])
                ->andFilterWhere(['like', 'street', $this->street]);
        }

        if (!empty($this->country_id)) {
            $query->joinWith(['location'])
                ->andFilterWhere(['country_id' => $this->country_id]);
        }
        if (!empty($this->region)) {
            $query->joinWith(['location'])
                ->andFilterWhere(['region' => $this->region]);
        }

        return $dataProvider;
    }
}
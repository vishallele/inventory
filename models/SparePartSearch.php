<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SparePart;

/**
 * SparePartSearch represents the model behind the search form of `app\models\SparePart`.
 */
class SparePartSearch extends SparePart
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_active', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['spare_part_name', 'spare_part_serial_no', 'spare_part_hsn_no'], 'safe'],
            [['spare_part_rate'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SparePart::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'spare_part_rate' => $this->spare_part_rate,
            'is_active' => $this->is_active,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'spare_part_name', $this->spare_part_name])
            ->andFilterWhere(['like', 'spare_part_serial_no', $this->spare_part_serial_no])
            ->andFilterWhere(['like', 'spare_part_hsn_no', $this->spare_part_hsn_no]);

        return $dataProvider;
    }
}

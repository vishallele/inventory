<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BillMaster;

/**
 * BillSearch represents the model behind the search form of `app\models\BillMaster`.
 */
class BillSearch extends BillMaster
{

    public $customer;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'bill_cgst_rate', 'bill_sgst_rate', 'bill_igst_rate', 'is_active', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['bill_no', 'purchase_order_no', 'bill_date', 'purchase_order_date','customer'], 'safe'],
            [['bill_subtotal_amount', 'bill_total_amount', 'bill_paid_amount'], 'number'],
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
        $query = BillMaster::find();

        $query->joinWith(['customer']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['customer'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['customer.company_name' => SORT_ASC],
            'desc' => ['customer.company_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'bill_date' => $this->bill_date,
            'purchase_order_date' => $this->purchase_order_date,
            'bill_subtotal_amount' => $this->bill_subtotal_amount,
            'bill_total_amount' => $this->bill_total_amount,
            'bill_paid_amount' => $this->bill_paid_amount,
            'bill_cgst_rate' => $this->bill_cgst_rate,
            'bill_sgst_rate' => $this->bill_sgst_rate,
            'bill_igst_rate' => $this->bill_igst_rate,
            'is_active' => $this->is_active,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'customer.company_name', $this->customer]);

        $query->andFilterWhere(['like', 'bill_no', $this->bill_no])
            ->andFilterWhere(['like', 'purchase_order_no', $this->purchase_order_no]);

        return $dataProvider;
    }
}

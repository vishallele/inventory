<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill_master".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $bill_no
 * @property string $purchase_order_no
 * @property string $bill_date
 * @property string $bill_due_date
 * @property string $bill_subtotal_amount
 * @property string $bill_total_amount
 * @property string $bill_paid_amount
 * @property int $bill_cgst_rate
 * @property int $bill_sgst_rate
 * @property int $bill_igst_rate
 * @property int $is_active
 * @property int $is_deleted
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BillDetails[] $billDetails
 * @property Customer $customer
 */
class BillMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'bill_no', 'purchase_order_no', 'bill_date', 'bill_subtotal_amount', 'bill_total_amount', 'bill_paid_amount', 'bill_cgst_rate', 'bill_sgst_rate', 'bill_igst_rate', 'created_at', 'updated_at'], 'required'],
            [['customer_id', 'bill_cgst_rate', 'bill_sgst_rate', 'bill_igst_rate', 'is_active', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['bill_date', 'bill_due_date'], 'safe'],
            [['bill_subtotal_amount', 'bill_total_amount', 'bill_paid_amount'], 'number'],
            [['bill_no', 'purchase_order_no'], 'string', 'max' => 50],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Company Name',
            'bill_no' => 'Bill No',
            'purchase_order_no' => 'Purchase Order No',
            'bill_date' => 'Bill Date',
            'bill_due_date' => 'Bill Due Date',
            'bill_subtotal_amount' => 'Bill Subtotal Amount',
            'bill_total_amount' => 'Bill Total Amount',
            'bill_paid_amount' => 'Bill Paid Amount',
            'bill_cgst_rate' => 'Bill Cgst Rate',
            'bill_sgst_rate' => 'Bill Sgst Rate',
            'bill_igst_rate' => 'Bill Igst Rate',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillDetails()
    {
        return $this->hasMany(BillDetails::className(), ['bill_master_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}

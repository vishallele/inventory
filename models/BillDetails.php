<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill_details".
 *
 * @property int $id
 * @property int $bill_master_id
 * @property int $spare_part_id
 * @property string $quantity
 * @property string $rate
 * @property int $is_deleted
 *
 * @property BillMaster $billMaster
 * @property SparePart $sparePart
 */
class BillDetails extends \yii\db\ActiveRecord
{

    public $spare_part_description;

    public $spare_part_hsn_no;

    public $amount;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bill_master_id', 'spare_part_id', 'quantity', 'rate'], 'required'],
            [['bill_master_id', 'spare_part_id', 'is_deleted'], 'integer'],
            [['quantity', 'rate'], 'number'],
            [['bill_master_id'], 'exist', 'skipOnError' => true, 'targetClass' => BillMaster::className(), 'targetAttribute' => ['bill_master_id' => 'id']],
            [['spare_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => SparePart::className(), 'targetAttribute' => ['spare_part_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_master_id' => 'Bill Master ID',
            'spare_part_id' => 'Spare Part ID',
            'spare_part_description' => 'Description',
            'spare_part_hsn_no' => 'HSN No.',
            'quantity' => 'Quantity',
            'rate' => 'Rate',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillMaster()
    {
        return $this->hasOne(BillMaster::className(), ['id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSparePart()
    {
        return $this->hasOne(SparePart::className(), ['id' => 'spare_part_id']);
    }
}

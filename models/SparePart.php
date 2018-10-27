<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "spare_part".
 *
 * @property int $id
 * @property string $spare_part_name
 * @property string $spare_part_serial_no
 * @property string $spare_part_hsn_no
 * @property string $spare_part_rate
 * @property int $is_active
 * @property int $is_deleted
 * @property int $created_at
 * @property int $updated_at
 */
class SparePart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spare_part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['spare_part_serial_no', 'spare_part_rate'], 'required'],
            [['id', 'is_active', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['spare_part_rate'], 'number'],
            [['spare_part_name', 'spare_part_serial_no'], 'string', 'max' => 50],
            [['spare_part_hsn_no'], 'string', 'max' => 20],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'spare_part_name' => 'Spare Part Name',
            'spare_part_serial_no' => 'Spare Part Serial No',
            'spare_part_hsn_no' => 'Spare Part Hsn No',
            'spare_part_rate' => 'Spare Part Rate',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
}

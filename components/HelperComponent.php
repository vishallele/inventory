<?php 
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


class HelperComponent extends Component 
{
    public function generateBillInvoiceNumber() {

        $bill_invoice_no = 'ACE/'.date('m').'-'.date('y').'/';

        $count = (new \yii\db\Query())
                ->from('bill_master')
                ->where(['DATE_FORMAT(FROM_UNIXTIME(created_at),"%m")' => date('m')])
                ->count();

        if($count === '0') {
            $bill_invoice_no .= '1';
        } else {
            $count++;
            $bill_invoice_no .= $count;
        }

        return $bill_invoice_no;

    }
}
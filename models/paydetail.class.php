<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class PayDetail extends \protec\core\Model
{
    const TABLENAME = 'PayDetail';

    protected $scheme = 
    [

        'paymentID'         => ['type' => M::TYPE_INT], 
        'billingAddressID'  => ['type' => M::TYPE_INT], //Foreign Key auf Addresses
        'custID'            => ['type' => M::TYPE_INT], //Foreign Key auf Customers
        'createdAt'         => ['type' => M::TYPE_STRING],
        'updatedAt'         => ['type' => M::TYPE_STRING],
        'paymentMethod'     => ['type' => M::TYPE_ENUM,'values' => ['IBAN','PayPal','Invoice']],
        'paymentNumber'     => ['type' => M::TYPE_STRING, 'max'=>150]

    ];
}
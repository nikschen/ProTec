<?php

class PayDetail extends \protec\core\Model
{
    const TABLENAME = '`PayDetail`';

    protected $scheme = 
    [

        'paymentID'         => ['type' => Model::TYPE_INT], 
        'billingAddressID'  => ['type' => Model::TYPE_INT], //Foreign Key auf Addresses
        'custID'            => ['type' => Model::TYPE_INT], //Foreign Key auf Customers
        'createdAt'         => ['type' => Model::TYPE_STRING],
        'updatedAt'         => ['type' => Model::TYPE_STRING],
        'paymentMethod'     => ['type' => Model::TYPE_ENUM,'values' => ['IBAN','PayPal','Invoice']],
        'paymentNumber'     => ['type' => Model::TYPE_STRING, 'max'=>150]

    ];
}
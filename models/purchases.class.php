<?php

class Purchases extends \protec\core\models
{
    const TABLE_NAME = '`Purchases`';

    protected $scheme = 
    [

        'productID'         => ['type' => Model::TYPE_INT],
        'createdAt'         => ['type' => Model::TYPE_STRING],
        'updatedAt'         => ['type' => Model::TYPE_STRING],
        'custID'            => ['type' => Model::TYPE_INT], //Foreign Key auf Customers
        'shippingAddressID' => ['type' => Model::TYPE_INT] //Foreign Key auf Addresses

    ];
}
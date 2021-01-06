<?php

class Pricing extends \protec\core\Model
{
    const TABLENAME = '`Pricing`';

    protected $scheme = 
    [

        'productID'         => ['type' => Model::TYPE_INT], //Foreign Key auf Products
        'createdAt'         => ['type' => Model::TYPE_STRING],
        'updatedAt'         => ['type' => Model::TYPE_STRING],
        'amount'            => ['type' => Model::TYPE_DECIMAL],
        'currency'          => ['type' => Model::TYPE_STRING, 'max'=>45]

    ];
}
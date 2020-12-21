<?php

class Product extends \protec\core\Model
{
    const TABLENAME = '`Product`';

    protected $scheme = 
    [

        'productID'         => ['type' => Model::TYPE_INT],
        'createdAt'         => ['type' => Model::TYPE_STRING],
        'updatedAt'         => ['type' => Model::TYPE_STRING],
        'quantityStored'    => ['type' => Model::TYPE_INT],
        'prodName'          => ['type' => Model::TYPE_STRING, 'max'=>100],
        'prodDescription'   => ['type' => Model::TYPE_STRING, 'max'=>1000]

    ];
}
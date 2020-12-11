<?php

class ProductBaskets extends \protec\core\models
{
    const TABLE_NAME = '`ProductBaskets`';

    protected $scheme = 
    [

        'purchaseID'        => ['type' => Model::TYPE_INT], //Foreign Key auf Purchases
        'quantityWanted'    => ['type' => Model::TYPE_INT],
        'productID'         => ['type' => Model::TYPE_INT] //Foreign Key auf Products

    ];
}
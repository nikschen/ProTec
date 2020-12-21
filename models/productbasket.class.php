<?php

class ProductBasket extends \protec\core\model
{
    const TABLE_NAME = '`ProductBasket`';

    protected $scheme = 
    [

        'purchaseID'        => ['type' => Model::TYPE_INT], //Foreign Key auf Purchases
        'quantityWanted'    => ['type' => Model::TYPE_INT],
        'productID'         => ['type' => Model::TYPE_INT] //Foreign Key auf Products

    ];
}
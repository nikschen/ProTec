<?php

class ProductBasket extends \protec\core\Model
{
    const TABLENAME = '`ProductBasket`';

    protected $scheme = 
    [

        'purchaseID'        => ['type' => Model::TYPE_INT], //Foreign Key auf Purchases
        'quantityWanted'    => ['type' => Model::TYPE_INT],
        'productID'         => ['type' => Model::TYPE_INT] //Foreign Key auf Products

    ];
}
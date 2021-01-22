<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class ProductBasket extends \protec\core\Model
{
    const TABLENAME = 'ProductBasket';

    protected $scheme = 
    [

        'purchaseID'        => ['type' => M::TYPE_INT], //Foreign Key auf Purchases
        'productBasketID'    => ['type' => M::TYPE_INT],

    ];
}
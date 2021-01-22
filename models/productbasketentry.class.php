<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class ProductBasketEntry extends \protec\core\Model
{
    const TABLENAME = 'ProductBasketEntry';

    protected $scheme =
        [

            'productBasketEntryID' => ['type' => M::TYPE_INT],
            'productBasketID'    => ['type' => M::TYPE_INT],//Foreign Key auf ProductBasket
            'productID'         => ['type' => M::TYPE_INT], //Foreign Key auf Products
            'quantityWanted'         => ['type' => M::TYPE_INT]

        ];
}
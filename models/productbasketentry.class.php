<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class ProductBasketEntry extends \protec\core\Model
{
    const TABLENAME = 'ProductBasketEntry';

    protected $scheme =
        [

            'productBasketEntryID'  => ['type' => M::TYPE_INT],
            'purchaseID'            => ['type' => M::TYPE_INT],//Foreign Key auf Purchase
            'productID'             => ['type' => M::TYPE_INT], //Foreign Key auf Product
            'quantityWanted'        => ['type' => M::TYPE_INT]

        ];
}
<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class Product extends \protec\core\Model
{
    const TABLENAME = 'Product';

    protected $scheme = 
    [

        'productID'         => ['type' => M::TYPE_INT],
        'createdAt'         => ['type' => M::TYPE_STRING],
        'updatedAt'         => ['type' => M::TYPE_STRING],
        'quantityStored'    => ['type' => M::TYPE_INT],
        'prodName'          => ['type' => M::TYPE_STRING, 'max'=>100],
        'prodDescription'   => ['type' => M::TYPE_STRING, 'max'=>1000],
        'category'          => ['type' => M::TYPE_STRING]

    ];
}
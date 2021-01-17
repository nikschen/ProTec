<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class Pricing extends \protec\core\Model
{
    const TABLENAME = 'Pricing';

    protected $scheme = 
    [

        'productID'         => ['type' => M::TYPE_INT], //Foreign Key auf Products
        'createdAt'         => ['type' => M::TYPE_STRING],
        'updatedAt'         => ['type' => M::TYPE_STRING],
        'amount'            => ['type' => M::TYPE_DECIMAL],
        'currency'          => ['type' => M::TYPE_STRING, 'max'=>45]

    ];
}
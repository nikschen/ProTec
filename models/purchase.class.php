<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class Purchase extends \protec\core\Model
{
    const TABLENAME = 'Purchase';

    protected $scheme = 
    [

        'productID'         => ['type' => M::TYPE_INT],
        'createdAt'         => ['type' => M::TYPE_STRING],
        'updatedAt'         => ['type' => M::TYPE_STRING],
        'customerID'        => ['type' => M::TYPE_INT], //Foreign Key auf Customers
        'shippingAddressID' => ['type' => M::TYPE_INT] //Foreign Key auf Addresses

    ];
}
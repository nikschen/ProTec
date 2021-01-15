<?php
namespace protec\model;//fresh changed
use \protec\core\Model as M;
class Address extends \protec\core\Model
{
    const TABLENAME = '`Address`';

    protected $scheme = 
    [

        'addressID'     => ['type' => M::TYPE_INT],
        'createdAt'     => ['type' => M::TYPE_STRING],
        'updatedAt'     => ['type' => M::TYPE_STRING],
        'street'        => ['type' => M::TYPE_STRING, 'max'=>255],
        'streetNumber'  => ['type' => M::TYPE_STRING, 'max'=>10],
        'zipCode'       => ['type' => M::TYPE_STRING, 'max'=>12],
        'city'          => ['type' => M::TYPE_STRING, 'max'=>60],
        'country'       => ['type' => M::TYPE_STRING, 'max'=>60]

    ];
}
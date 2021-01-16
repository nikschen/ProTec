<?php



namespace protec\model;//fresh changed
use \protec\core\Model as M;
class Customer extends \protec\core\Model
{
    const TABLENAME = 'Customer';

    protected $scheme = 
    [
        'customerID'  => ['type' => M::TYPE_INT],
        'createdAt'   => ['type' => M::TYPE_STRING],
        'updatedAt'   => ['type' => M::TYPE_STRING],
        'firstName'   => ['type' => M::TYPE_STRING, 'max'=>45],
        'lastName'    => ['type' => M::TYPE_STRING, 'max'=>100],
        'birthDate'   => ['type' => M::TYPE_DATE],
        'eMail'       => ['type' => M::TYPE_STRING, 'max'=>150]

    ];
}


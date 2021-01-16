<?php

namespace protec\model;//fresh changed
use \protec\core\Model as M;

class Account extends \protec\core\Model
{
    const TABLENAME = '`Account`';

    protected $scheme = 
    [

        'customerID'    => ['type' => M::TYPE_INT], //Foreign Key auf Customers
        'createdAt'     => ['type' => M::TYPE_STRING],
        'updatedAt'     => ['type' => M::TYPE_STRING],
        'username'      => ['type' => M::TYPE_STRING,'max'=>150], //Foreign Key auf eMail in Customers
        'passwordHash'  => ['type' => M::TYPE_STRING, 'max'=>255],
        'validated'     => ['type' => M::TYPE_BOOL]  //tinyint(1) in mysql

    ];
}
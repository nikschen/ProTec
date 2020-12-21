<?php

class Account extends \protec\core\Model
{
    const TABLENAME = '`Account`';

    protected $scheme = 
    [

        'custID'        => ['type' => Model::TYPE_INT], //Foreign Key auf Customers
        'createdAt'     => ['type' => Model::TYPE_STRING],
        'updatedAt'     => ['type' => Model::TYPE_STRING],
        'username'      => ['type' => Model::TYPE_STRING,'max'=>150], //Foreign Key auf eMail in Customers
        'passwordHash'  => ['type' => Model::TYPE_STRING, 'max'=>255],
        'validated'     => ['type' => Model::TYPE_BOOL]  //tinyint(1) in mysql

    ];
}
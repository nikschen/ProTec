<?php

class Customer extends \protec\core\Model
{
    const TABLENAME = '`Customer`';

    protected $scheme = 
    [

        'custID'      => ['type' => Model::TYPE_INT],
        'createdAt'   => ['type' => Model::TYPE_STRING],
        'updatedAt'   => ['type' => Model::TYPE_STRING],
        'firstName'   => ['type' => Model::TYPE_STRING, 'max'=>45],
        'lastName'    => ['type' => Model::TYPE_STRING, 'max'=>100],
        'birthDate'   => ['type' => Model::TYPE_DATE],
        'eMail'       => ['type' => Model::TYPE_STRING, 'max'=>150]

    ];
}
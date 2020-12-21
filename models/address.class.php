<?php

class Address extends \protec\core\model
{
    const TABLE_NAME = '`Address`';

    protected $scheme = 
    [

        'addressID'     => ['type' => Model::TYPE_INT],
        'createdAt'     => ['type' => Model::TYPE_STRING],
        'updatedAt'     => ['type' => Model::TYPE_STRING],
        'street'        => ['type' => Model::TYPE_STRING, 'max'=>255],
        'streetNumber'  => ['type' => Model::TYPE_STRING, 'max'=>10],
        'zipCode'       => ['type' => Model::TYPE_STRING, 'max'=>12],
        'city'          => ['type' => Model::TYPE_STRING, 'max'=>60],
        'country'       => ['type' => Model::TYPE_STRING, 'max'=>60]

    ];
}
<?php


namespace protec\core;

abstract class Model 
{
    const TYPE_STRING   = 'string';
    const TYPE_INT      = 'int';
    const TYPE_DECIMAL  = 'dec';
    const TYPE_DATE     = 'date';
    const TYPE_BOOL     = 'bool';
    const TYPE_ENUM     = 'enum';

    protected $scheme = [];
}
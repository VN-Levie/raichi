<?php

namespace System\Eloquent;

use Closure;

class QueryObject
{
    protected $query;
    protected $model;
    protected $eagerLoad = [];
    protected $propertyPassthru = [
        'from',
    ];
    protected $passthru = [
        'avg',
        'count',
        'insert',
        'max',
        'min',
        'raw',
        'sum',
        'tosql',
    ];
}

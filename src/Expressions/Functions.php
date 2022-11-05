<?php

namespace Esyede\Matematika\Expressions;

use Esyede\Matematika\Stack;

class Functions extends Operator
{
    protected $precedence = 10;

    protected static $functions = [
        'ABS',
        'COS', 'COSH', 'SIN', 'SINH', 'TAN', 'TANH',
        'ACOS', 'ACOSH', 'ASIN', 'ASINH', 'ATAN', 'ATAN2', 'ATANH',
        'DEG2GRAD', 'RAD2DEG', 'PI',
        'CEIL', 'FLOOR', 'ROUND', 'SQRT', 'LOG10',
    ];

    public static function valid($value)
    {
        return in_array($value, self::$functions);
    }

    public function operate(Stack $stack)
    {
        $value = $stack->pop()->operate($stack);
        $function = strtolower($this->value);

        return (new Number($function($value)))->operate($stack);
    }
}

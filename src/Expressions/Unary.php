<?php

namespace Esyede\Matematika\Expressions;

use Esyede\Matematika\Stack;

class Unary extends Operator
{
    protected $precedence = 7;

    public function isUnary()
    {
        return true;
    }

    public function operate(Stack $stack)
    {
        $next = $stack->pop()->operate($stack);
        return (new Number(- $next))->operate($stack);
    }
}

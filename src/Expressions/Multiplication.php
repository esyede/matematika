<?php

namespace Esyede\Matematika\Expressions;

use Esyede\Matematika\Stack;

class Multiplication extends Operator
{
    protected $precedence = 5;

    public function operate(Stack $stack)
    {
        return $stack->pop()->operate($stack) * $stack->pop()->operate($stack);
    }
}

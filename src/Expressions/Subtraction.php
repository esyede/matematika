<?php

namespace Esyede\Matematika\Expressions;

use Esyede\Matematika\Stack;

class Subtraction extends Operator
{
    protected $precedence = 4;

    public function operate(Stack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);

        return $right - $left;
    }
}

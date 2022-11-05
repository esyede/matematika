<?php

namespace Esyede\Matematika\Expressions;

use Esyede\Matematika\Stack;

class Power extends Operator
{
    protected $precedence = 6;

    public function operate(Stack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);

        return pow($left, $right);
    }
}

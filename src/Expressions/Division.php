<?php

namespace Esyede\Matematika\Expressions;

use Esyede\Matematika\Stack;

class Division extends Operator
{
    protected $precedence = 5;

    public function operate(Stack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);

        return $right / $left;
    }
}

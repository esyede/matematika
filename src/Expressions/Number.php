<?php

namespace Esyede\Matematika\Expressions;

use Esyede\Matematika\Stack;
use Esyede\Matematika\Expression;

class Number extends Expression
{
    public function operate(Stack $stack)
    {
        return $this->value;
    }
}

<?php

namespace Esyede\Matematika;

abstract class Expression
{
    protected $value = '';

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function factory($value)
    {
        switch ($value) {
            case ($value instanceof self): return $value;
            case in_array($value, ['(', ')']): return new Expressions\Parenthesis($value);
            case is_numeric($value): return new Expressions\Number($value);
            case 'u': return new Expressions\Unary($value);
            case '+': return new Expressions\Addition($value);
            case '-': return new Expressions\Subtraction($value);
            case '*': return new Expressions\Multiplication($value);
            case '/': return new Expressions\Division($value);
            case '^': return new Expressions\Power($value);
            case Expressions\Functions::valid($value): return new Expressions\Functions($value);
            default: throw new \Exception(sprintf('Undefined value: %s', $value));
        }
    }

    public function isOperator()
    {
        return false;
    }

    public function isUnary()
    {
        return false;
    }

    public function isParenthesis()
    {
        return false;
    }

    public function isNoOp()
    {
        return false;
    }

    public function render()
    {
        return $this->value;
    }

    abstract public function operate(Stack $stack);
}

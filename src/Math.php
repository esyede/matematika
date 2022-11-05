<?php

namespace Esyede\Matematika;

class Math
{
    protected $variables = [];

    public function put($name, $value)
    {
        $this->variables[$name] = $value;
        return $this;
    }

    public function evaluate($string)
    {
        return $this->run($this->parse($string));
    }

    private function parse($string)
    {
        $tokens = $this->tokenize($string);
        $output = new Stack();
        $operators = new Stack();

        foreach ($tokens as $token) {
            $token = $this->extract($token);
            $expression = Expression::factory($token);

            if ($expression->isOperator()) {
                $this->operator($expression, $output, $operators);
            } elseif ($expression->isParenthesis()) {
                $this->parenthesis($expression, $output, $operators);
            } else {
                $output->push($expression);
            }
        }

        while (($operator = $operators->pop())) {
            if ($operator->isParenthesis()) {
                throw new \RuntimeException('Mismatched parenthesis');
            }

            $output->push($operator);
        }

        return $output;
    }

    private function run(Stack $stack)
    {
        while (($operator = $stack->pop()) && $operator->isOperator()) {
            $value = $operator->operate($stack);

            if (! is_null($value)) {
                $stack->push(Expression::factory($value));
            }
        }

        return $operator ? $operator->render() : $this->render($stack);
    }

    private function extract($token)
    {
        if (isset($token[0]) && '$' === $token[0]) {
            $key = substr($token, 1);
            return isset($this->variables[$key]) ? $this->variables[$key] : 0;
        }

        return $token;
    }

    private function render(Stack $stack)
    {
        $output = '';

        while (($el = $stack->pop())) {
            $output .= $el->render();
        }

        if (! $output) {
            throw new \RuntimeException('Could not render output');
        }

        return $output;
    }

    private function parenthesis(Expression $expression, Stack $output, Stack $operators)
    {
        if ($expression->isOpen()) {
            $operators->push($expression);
        } else {
            $clean = false;

            while (($tail = $operators->pop())) {
                if ($tail->isParenthesis()) {
                    $clean = true;
                    break;
                } else {
                    $output->push($tail);
                }
            }

            if (! $clean) {
                throw new \RuntimeException('Mismatched parenthesis');
            }
        }
    }

    private function operator(Expression $expression, Stack $output, Stack $operators)
    {
        $tail = $operators->tail();

        if (! $tail) {
            $operators->push($expression);
        } elseif ($tail->isOperator()) {
            do {
                if ($expression->isLeftAssoc()
                && $expression->getPrecedence() <= $tail->getPrecedence()) {
                    $output->push($operators->pop());
                } elseif (! $expression->isLeftAssoc()
                && $expression->getPrecedence() < $tail->getPrecedence()) {
                    $output->push($operators->pop());
                } else {
                    break;
                }
            } while (($tail = $operators->tail()) && $tail->isOperator());

            $operators->push($expression);
        } else {
            $operators->push($expression);
        }
    }

    private function tokenize($string)
    {
        $tokens = preg_split(
            '((\$[a-zA-Z]+\d+)|(\d+\.?\d+|\+|-|\(|\)|\*|/)|\s+)',
            $string,
            null,
            PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
        );

        $tokens = array_map('trim', $tokens);

        foreach ($tokens as $key => &$value) {
            if ('-' === $value) {
                $symbols = ['+', '-', '*', '/', '('];

                if (($key - 1) < 0 || in_array($tokens[$key - 1], $symbols)) {
                    $value = 'u';
                }
            }
        }

        return $tokens;
    }
}

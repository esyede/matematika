<?php

namespace Esyede\Matematika;

class Stack
{
    protected $elements = [];

    public function push($element)
    {
        $this->elements[] = $element;
    }

    public function pop()
    {
        return array_pop($this->elements);
    }

    public function head()
    {
        return reset($this->elements);
    }

    public function tail()
    {
        return end($this->elements);
    }

    public function peak()
    {
        return current(array_slice($this->elements, - 1));
    }
}

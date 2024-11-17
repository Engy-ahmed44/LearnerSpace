<?php

namespace App\Core;

abstract class View
{
    abstract public function render(): void;
}

abstract class DecoratedView extends View
{
    public View $parent;
    function __construct(View $parent)
    {
        $this->parent = $parent;
    }
}

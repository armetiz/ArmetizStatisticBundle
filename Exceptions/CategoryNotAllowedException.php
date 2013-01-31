<?php

namespace Armetiz\StatisticBundle\Exceptions;

class CategoryNotAllowedException extends StatisticException
{
	public function __construct()
    {
        parent::__construct('Category not allowed. See documentation to know available categories.');
    }
}
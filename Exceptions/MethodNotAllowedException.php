<?php

namespace Armetiz\StatisticBundle\Exceptions;

class MethodNotAllowedException extends StatisticException
{
	public function __construct()
    {
        parent::__construct('Method not allowed. See documentation to know available categories.');
    }
}
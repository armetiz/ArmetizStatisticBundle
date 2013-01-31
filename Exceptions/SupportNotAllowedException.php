<?php

namespace Armetiz\StatisticBundle\Exceptions;

class SupportNotAllowedException extends StatisticException
{
	public function __construct()
    {
        parent::__construct('Support not allowed. See documentation to know available supports.');
    }
}
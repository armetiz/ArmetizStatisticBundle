<?php

namespace Armetiz\StatisticBundle\Exceptions;

class NoEventFoundException extends StatisticException
{
	public function __construct()
    {
        parent::__construct('No event where found.');
    }
}
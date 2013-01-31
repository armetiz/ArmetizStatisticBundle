<?php

namespace Armetiz\StatisticBundle\Exceptions;

use Armetiz\SystemBundle\Exceptions\ServiceException;

class StatisticException extends ServiceException
{
	public function __construct($message = "Statistic service exception.")
    {
        parent::__construct($message);
    }
}
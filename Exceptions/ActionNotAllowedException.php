<?php

namespace Armetiz\StatisticBundle\Exceptions;

class ActionNotAllowedException extends StatisticException {
    public function __construct() {
        parent::__construct('Action not allowed. See documentation to know available actions.');
    }
}
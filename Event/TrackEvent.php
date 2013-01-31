<?php

namespace Armetiz\StatisticBundle\Event;

use Symfony\Component\EventDispatcher\Event as EventBase;
use Armetiz\StatisticBundle\Entity\Event;

class TrackEvent extends EventBase {
    const TRACK = "armetiz.statistic.event.track";
    
    private $event;
    
    public function __construct(Event $event) {
        $this->event = $event;
    }
    
    public function getEvent() {
        return $this->event;
    }
}

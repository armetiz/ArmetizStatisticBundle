<?php

namespace Armetiz\StatisticBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\SecurityContext;
use Armetiz\StatisticBundle\Entity\Event;
use Armetiz\StatisticBundle\Exceptions\ActionNotAllowedException;
use Armetiz\StatisticBundle\Exceptions\CategoryNotAllowedException;
use Armetiz\StatisticBundle\Exceptions\SupportNotAllowedException;
use Armetiz\StatisticBundle\Event\TrackEvent;

class Tracker extends Service {
    private $entityManager;
    private $securityContext;
    private $allowedCategories;
    private $allowedActions;
    private $allowedSupports;
    private $dispatcher;

    public function __construct(array $allowedCategories = array(), array $allowedActions = array(), array $allowedSupports = array()) {
        $this->allowedCategories = $allowedCategories;
        $this->allowedActions = $allowedActions;
        $this->allowedSupports = $allowedSupports;
    }

    public function track($category, $action, $value = null, $support = null) {
        //TODO Secure : Throttle this function. Hit by IP ?

        if (!$this->isAllowedCategory($category)) {
            throw new CategoryNotAllowedException();
        }

        if (!$this->isAllowedAction($action)) {
            throw new ActionNotAllowedException();
        }

        if (null != $support && !$this->isAllowedSupport($support)) {
            throw new SupportNotAllowedException();
        }

        //Check is value exists for this category
        $entityClass = $this->allowedCategories[$category];
        if ($entityClass && !$this->getEntityManager()->find($entityClass, $value)) {
            throw new EntityNotFoundException();
        }

        if (isset($_SERVER['argc']))
            $ip = "127.0.0.1";
        else if (isset($_SERVER["HTTP_CLIENT_IP"]))
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else
            $ip = $_SERVER["REMOTE_ADDR"];

        $ip = explode(",", $ip);
        $ip = $ip[0];

        $event = new Event();
        $event->setIp($ip);
        $event->setCategory($category);
        $event->setAction($action);
        $event->setValue($value);
        $event->setSupport($support);

        $token = $this->getSecurityContext()->getToken();
        if ($token) {
            $event->setUsername((string) $token->getUser());
        }

        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();

        $this->getDispatcher()->dispatch(TrackEvent::TRACK, new TrackEvent($event));
    }

    public function isAllowedCategory($category) {
        return array_key_exists($category, $this->allowedCategories);
    }

    public function isAllowedAction($action) {
        return (false !== array_search($action, $this->allowedActions));
    }

    public function isAllowedSupport($support) {
        return (false !== array_search($support, $this->allowedSupports));
    }

    public function setSecurityContext(SecurityContext $value) {
        $this->securityContext = $value;
    }

    public function getSecurityContext() {
        return $this->securityContext;
    }

    public function setDispatcher(EventDispatcher $value) {
        $this->dispatcher = $value;
    }

    public function getDispatcher() {
        return $this->dispatcher;
    }

    public function setEntityManager(EntityManager $value) {
        $this->entityManager = $value;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }
}
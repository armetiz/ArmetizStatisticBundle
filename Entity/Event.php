<?php

namespace Armetiz\StatisticBundle\Entity;

class Event
{
    /**
     *
     * @var integer
     */
    private $id = null;
    
    /**
     *
     * @var string
     */
    private $category = null;
    
    /**
     *
     * @var string
     */
    private $action = null;
    
    /**
     *
     * @var \DateTime
     */
    private $dateCreation = null;
    
    /**
     *
     * @var string
     */
    private $ip = null;
    
    /**
     * @var string
     */
    private $username = null;
    
    /**
     *
     * @var mixed
     */
    private $value;
    
    /**
     * @var string 
     */
    private $support;

    public function __construct() {
        $this->dateCreation = new \DateTime();
    }
    
    public function getId (){
        return $this->id;
    }
    
    public function setId ($value){
        $this->id = $value;
    }
    
    public function getCategory (){
        return $this->category;
    }
    
    public function setCategory ($value){
        $this->category = $value;
    }
    
    public function getAction (){
        return $this->action;
    }
    
    public function setAction ($value){
        $this->action = $value;
    }
    
    public function getDateCreation (){
        return $this->dateCreation;
    }
    
    public function setDateCreation ($value){
        $this->dateCreation = $value;
    }
    
    public function getValue (){
        return $this->value;
    }
    
    public function setValue ($value){
        $this->value = $value;
    }
    
    public function getIp (){
        return $this->ip;
    }
    
    public function setIp ($value){
        $this->ip = $value;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($value) {
        $this->username = $value;
    }
    
    public function getSupport() {
        return $this->support;
    }
    
    public function setSupport($value) {
        $this->support = $value;
    }
}
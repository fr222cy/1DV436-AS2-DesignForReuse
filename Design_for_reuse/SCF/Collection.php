<?php


class Collection
{
    private $collectionID;
    
    public function __construct($collectionID)
    {
        $this->collectionID = $collectionID;   
        
    }
    
    public function getID()
    {
        return $this->collectionID;
    }
    
    
    
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Description of MappingListener
 *
 * @author informatica
 */
class PrePersistListener 
{
    private $context;
    
    public function __construct(TokenStorageInterface $context) {
        $this->context = $context;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if (in_array('App\Interfaces\UsernameInterface',class_implements($entity)))
            $entity->setUsername($this->context->getToken()->getUser()->getUsername());
            
    }
}

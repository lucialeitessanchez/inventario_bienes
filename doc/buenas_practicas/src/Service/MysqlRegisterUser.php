<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
/**
 * Description of MysqlRegisterUser
 *
 * @author informatica
 */
class MysqlRegisterUser {
    private $context;
    private $request_stack;
    
    public function __construct(TokenStorageInterface $context,RequestStack $request_stack) {
        $this->context = $context;
        $this->request_stack = $request_stack;
    }
    
    public function onFlush( $args)
    {
        $em = $args->getEntityManager();
        $conn = $em->getConnection();
        $username = $this->context->getToken()->getUser()->getUsername();
        $client_ip = $this->request_stack->getCurrentRequest()->getClientIp();
        $sql = 'SET @user_name = \''.$username.'\'; SET @dir_ip_cliente=\''.$client_ip.'\';';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}

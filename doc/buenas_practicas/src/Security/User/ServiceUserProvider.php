<?php

namespace App\Security\User;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Entity\Area;
use PDOException;
use SoapClient;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Psr\Log\LoggerInterface;
/**
 * Description of WebServiceUserProvider
 *
 * @author informatica
 */
class ServiceUserProvider implements UserProviderInterface {

    private $em;
    private $request;
    private $logger;
    
    function __construct(RequestStack $request_stack, $permisos_to_roles, $em, LoggerInterface $logger) {

        $this->request = $request_stack->getCurrentRequest();
        $this->em = $em;
        $this->logger = $logger;
    }

    public function loadUserByUsername($idusuario) {

        $idUser = $this->request->get('idUser');
        $idApp = $this->request->get('idApp');
        $token = $this->request->get('token');
        if ($idusuario) {
            $this->logger->debug('idusuario '.$idusuario);
            // -- Llamo al Servicio que valida la sesion del usuario.
            $client = new SoapClient('http://10.1.6.7/~florencia/nuevo_portalmds_admin/web/app_dev.php/soap?wsdl');
            //$client = new SoapClient('https://twww.santafe.gob.ar/mds/portalmds/soap?wsdl');
            //$client = new SoapClient('https://www.santafe.gob.ar/mds/portalmds/soap?wsdl');
            $arrParam = [$idApp, $idUser, $token];

            
            //$result = $client->__soapCall('getDatosAplicacion', $arrParam);

            try {
                $this->logger->debug('call web service '.$idusuario);
                $result = $client->__soapCall('getDatosAplicacion', $arrParam);

                $this->logger->debug(print_r($result,1));
                // -- En $result esta el arrpay resultado del service
            } catch (PDOException $exception) {
                //echo $exception;
                throw new UsernameNotFoundException(sprintf('No pudo llamar al soap', $exception));
            }
            
            if (count($result) == 0) {
                //echo $idusuario;
                throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $idusuario));
            } else {
                $usuario_id = $result[0];
                $usuario_nombre = $result[1];
                $roles = array($result[2]);
                $area_id = $result[3];

                $ormArea = $this->em->getRepository(Area::class)->find($area_id);
                $area = $ormArea->getArea();
            }
            $user = new ServiceUser($usuario_nombre, null, $idApp, $roles, $usuario_id, null, $area_id, $area);
            
            
            return $user;
        } else {
            throw new UsernameNotFoundException(sprintf('"%s" No tiene permisos para acceder al sistema.', $usuario_id));
        }
    }

    public function refreshUser(UserInterface $user) {
        if (!$user instanceof ServiceUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
        //return $this->loadUserByUsername($user->getUsername());
        return $user;
    }

    public  function supportsClass($class) {
        return ServiceUser::class === $class;
    }

}

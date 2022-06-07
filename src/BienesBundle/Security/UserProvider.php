<?php
namespace BienesBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\HttpFoundation\Session\Session;
use MDS\UsuarioBundle\Entity\Sistema;
use MDS\NuevaOportunidadBundle\Exception\GroupNotSetException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Description of WebServiceUserProvider
 *
 * @author informatica
 */
class UserProvider implements UserProviderInterface {

    private $em;
    private $permisos_to_roles;
    private $container;
    private $request;

    function __construct(EntityManagerInterface $em, RequestStack $requestStack) {
        $this->em = $em;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function loadUserByUsername($username) {
        //die('die');
        $usuario = $this->em->getRepository('BienesBundle:User')->findOneBy(array('username' => $username));
        //die($username);
        
        if ($usuario && $usuario->getIsActive()) {
            
            // completamos los datos requeridos por WebserviceUser por los obtenidos desde el webservice.
            $id =  $usuario->getId();
            $username = $usuario->getUsername();
            $password = $usuario->getPassword();
            $email = $usuario->getEmail();
            $salt = null;
            
            if($usuario->getUsername() == 'jimena'){ //especifico que el user admin le ponga el rol de administrador
                $roles[] = 'ROLE_ADMIN';
            }
            else{
                $roles[] = 'ROLE_USUARIO';
            }
            
            //throw new UnsupportedUserException(sprintf('"%s" No tiene permisos para acceder al sistema "$s".', print_r($roles,1),$sistema->getSistemaNombre()));
            $user = new User($id,$username, $password, $email, $roles,1);
            return $user;
        } else {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
    }

    public function refreshUser(UserInterface $user) {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
        
        /*$c = $this->em->getConnection();
        $sql = 'SET @user_name = :username;';
        $c->executeQuery($sql,array('username' => $user->getUsername()));
        $sql = 'SET @dir_ip_cliente= :client_ip;';
        $c->executeQuery($sql,array('client_ip' => $this->request->getClientIp()));*/

        return $user;
    }

    public function supportsClass($class) {
        //echo $class;
        return $class === User::class;
    }

    public function setRequest($r) {
        
    }
}
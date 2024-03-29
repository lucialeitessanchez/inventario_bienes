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
  
        $usuario = $this->em->getRepository('BienesBundle:User')->findOneBy(array('username' => $username)); //consulta la entidad
        
        
        if ($usuario && $usuario->getIsActive()) {
            
            // completamos los datos requeridos por WebserviceUser por los obtenidos desde el webservice.
            $id =  $usuario->getId();
            $username = $usuario->getUsername();
            $password = $usuario->getPassword();
            $email = $usuario->getEmail();
            $salt = null;

            $roles = [];
            foreach($usuario->getRoles() as $rol)
                $roles[] = $rol->getIdRol(); 

            //return User::newFromEntity($usuario);
            
            //throw new UnsupportedUserException(sprintf('"%s" No tiene permisos para acceder al sistema "$s".', print_r($roles,1),$sistema->getSistemaNombre()));
            $user = new User($id,$username, $password, $email, $roles,$usuario->getIsActive()); //aca guarda en la clase de seguridad
            return $user;
        } 
        
        throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
    }

    public function refreshUser(UserInterface $user) {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
        //asignacion en SQL 
        $c = $this->em->getConnection();        
        $sql = 'SET @user_name = :username;'; //esto es lo que guarda en la base de datos al modificar tomando el usuario logueado
        $c->executeQuery($sql,array('username' => $user->getUsername()));
        $sql = 'SET @dir_ip_cliente= :client_ip;';
        $c->executeQuery($sql,array('client_ip' => $this->request->getClientIp()));

        return $user;
    }

    public function supportsClass($class) {
        //echo $class;
        return $class === User::class;
    }

    public function setRequest($r) {
        
    }
}
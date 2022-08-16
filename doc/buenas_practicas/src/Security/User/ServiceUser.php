<?php
namespace App\Security\User;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of ServiceUser
 *
 * @author informatica
 */
class ServiceUser  implements UserInterface, \Serializable {
    /**
     * @var string
     */
    private $username;
    
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $salt;
    /**
     * @var array
     */
    private $roles;
    /**
     * @var integer
     */
    private $userid;
    /**
     * @var integer
     */
    private $permisos_to_roles;
    /**
     * @var string
     */
    private $oficinas; 
    
    /**
     * @var string
     */
    private $descripcionOficinas;
    

    public function __construct($username, $password, $salt, array $roles,$user_id,$permisos_to_roles, $oficinas,$ofi) {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
        $this->userid = $user_id;
        $this->permisos_to_roles= $permisos_to_roles;
        $this->oficinas = $oficinas;
        $this->descripcionOficinas= $ofi;
        
        
       // $this->permisos_to_roles = $permisos_to_roles;
      //  $this->oficinas = $oficinas;
     }
    
    
     function getDescripcionOficinas(): string {
         return $this->descripcionOficinas;
     }

     function setDescripcionOficinas(string $descripcionOficinas): void {
         $this->descripcionOficinas = $descripcionOficinas;
     }

         function getOficinas() {
        return $this->oficinas;
    }

        
    function getPermisos_to_roles() {
        return $this->permisos_to_roles;
    }

            
    public function getRoles() {
        return $this->roles;
    }
    
    public function getPassword() {
       return $this->password;
    }
    
    public function getSalt() {
        return $this->salt;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getUserid() {
        return $this->userid;
    }
    
    public function eraseCredentials() {
        
    }
            
    public function equals(UserInterface $user) {
        if (!$user instanceof ServiceUser) { return false; }
        if ($this->password !== $user->getPassword()) { return false; }
        if ($this->getSalt() !== $user->getSalt()) { return false; }
        if ($this->username !== $user->getUsername()) { return false; }
        if ($this->userid !== $user->getUserid()) { return false; }
        
       // if ($this->permisos_to_roles !== $user->getPermisos_to_roles()) { return false; }
      //  if ($this->oficinas !== $user->getOficinas()) { return false; }
        return true;
    }
    
    public function serialize() {
        //echo 'Serialize'.'<br>';
        return serialize(array($this->username,$this->password,$this->salt,$this->roles,$this->userid,$this->permisos_to_roles,$this->oficinas,$this->descripcionOficinas));
    }
    
    public function unserialize($data) {
        //echo 'UnSerialize'.'<br>';
        list($this->username,$this->password,$this->salt,$this->roles,$this->userid,$this->permisos_to_roles,$this->oficinas,$this->descripcionOficinas) = unserialize($data);
    }
   

}

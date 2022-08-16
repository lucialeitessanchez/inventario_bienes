<?php

namespace App\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\RouterInterface;

class TokenAuthenticator extends AbstractGuardAuthenticator {

    private $idApp;
    private $token;
    private $usuario_id;
    private $id;
    private $router;
    private $logger;

    public function __construct(RouterInterface $router, int $sistemaId)
    {
        
        $this->id = $sistemaId;
        $this->router = $router;
    }
    
    /**
    * @required
    */
    public function setLogger(LoggerInterface $logger): void {
        $this->logger = $logger;
    }
 
       
    public function supports(Request $request) {
     
        $this->logger->debug($request->attributes->get('_route'));
        if('default_index' === $request->attributes->get('_route') && ($request->get('idApp') == $this->id ))
        {
           $this->logger->debug('Activando Autenticador');
           return true;
        }              
        
    } 
    

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request) {
        
             
        if (($request->get('token') != '' ) && ($request->get('idApp') == $this->id )) {
            //mando el id de usuario 
            $credentials = $request->get('idUser');
             return 'el valor de credentials es: '. $credentials;
        } else {
            echo 'no se crea credencial';
            return null;
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider) {
     
        if (null === $credentials) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            return null;
        }
        
        $user = $userProvider->loadUserByUsername($credentials);
        
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user) {
        // Check credentials - e.g. make sure the password is valid.
        // In case of an API token, no credential check is needed.

        // Return `true` to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {

       
        // on success, let the request continue
        return null;
    }


   
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        
        if ($exception->getMessage()) 
            $error = $exception->getMessage();
        else
            $error = "Error Webservices";
        
        $request->getSession()->getFlashBag()->add('mensaje_danger', $error);
        $response = new RedirectResponse($this->router->generate('salir'));
        return $response;


    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null) {       
          
        $request->getSession()->getFlashBag()->add('mensaje_danger', 'Es necesario loguearse en el Portal MDS para acceder');
        $response = new RedirectResponse($this->router->generate('salir'));
        
        return $response;
    }

    
    
    public function supportsRememberMe() {
        return false;
    }

    function getIdApp() {
        return $this->idApp;
    }

    function getToken() {
        return $this->token;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function setIdApp($idApp) {
        $this->idApp = $idApp;
    }

    function setToken($token) {
        $this->token = $token;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

}
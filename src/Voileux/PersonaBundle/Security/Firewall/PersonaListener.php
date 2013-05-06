<?php
/**
 * PersonaListener.php
 *
 * Created By: jonathan
 * Date: 5/5/13
 * Time: 11:50 PM
 */

namespace Voileux\PersonaBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Voileux\PersonaBundle\Security\Authentication\Token\PersonaUserToken;
use Buzz\Browser;

class PersonaListener implements ListenerInterface
{
    protected $securityContext;
    protected $authenticationManager;
    protected $verifierUrl;
    protected $browser;

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager, $verifierUrl, Browser $browser)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;

    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $assertion = $request->request->get('assertion');


        $token = new PersonaUserToken();
        $token->setAssertion($assertion);


        try {
            $authToken = $this->authenticationManager->authenticate($token);

            $this->securityContext->setToken($authToken);
        } catch (AuthenticationException $failed) {
            // ... you might log something here

            // To deny the authentication clear the token. This will redirect to the login page.
            // $this->securityContext->setToken(null);
            // return;

            // Deny authentication with a '403 Forbidden' HTTP response
            $response = new Response();
            $response->setStatusCode(403);
            $event->setResponse($response);

        }
    }



}

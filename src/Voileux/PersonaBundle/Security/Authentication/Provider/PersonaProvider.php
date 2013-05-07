<?php


namespace Voileux\PersonaBundle\Security\Authentication\Provider;


use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Voileux\PersonaBundle\Security\Authentication\Token\PersonaUserToken;
use Buzz\Browser;


class PersonaProvider implements AuthenticationProviderInterface
{
    private $userProvider;

    private $createUserIfNotExists;
    private $verifierUrl;
    private $audienceUrl;
    private $browser;


    public function __construct(UserProviderInterface $userProvider = null, $createUserIfNotExists = false, $verifierUrl, $audienceUrl, Browser $browser )
    {
        $implements = class_implements($userProvider);
        if ($createUserIfNotExists && !$userProvider instanceof \FOS\UserBundle\Model\UserManagerInterface) {
            throw new \InvalidArgumentException('The $userProvider must implement UserManagerInterface if $createIfNotExists is true.');
        }

        $this->userProvider = $userProvider;
        $this->createUserIfNotExists = $createUserIfNotExists;
        $this->verifierUrl = $verifierUrl;
        $this->audienceUrl = $audienceUrl;
        $this->browser = $browser;
    }

    public function authenticate(TokenInterface $token)
    {
        if (!$this->supports($token)) {
            return null;
        }

        $user = $token->getUser();

        if ($user instanceof UserInterface) {
            $newToken = new PersonaUserToken($user, $user->getRoles());
            $newToken->setAttributes($token->getAttributes());

            return $newToken;
        }

        try {

            if ($accessToken = $this->getAccessToken($token->getAssertion()))
            {
                $newToken = $this->createAuthenticatedToken($accessToken);
                $newToken->setAttributes($token->getAttributes());

                return $newToken;
            }

        } catch (AuthenticationException $failed) {
            throw $failed;
        } catch (\Exception $failed) {
            throw new AuthenticationException($failed->getMessage(), $failed->getCode());
        }

        // our user not able to verfiy, store, refresh, whatever handler
        throw new AuthenticationException('The persona user could not be retrieved from the session.');
    }



    public function getAccessToken($assertion)
    {
        $data = array(
            'audience' => $this->audienceUrl,
            'assertion' => $assertion,
        );

        $verifier_token = $this->verifyAssertion($data);
        if ($verifier_token && $verifier_token->status === 'okay')
        {
//            $this->session->set('persona_email', $verifier_token->email);
//            $this->session->set('persona_expires', $verifier_token->expires);
//            $this->session->set('persona_status', $verifier_token->status);

            return $verifier_token;
        }

        /* Return null for failure */
        return null;
    }

    protected function verifyAssertion($data)
    {
        $this->browser->getClient()->setVerifyPeer(false);
        $result = $this->browser->post($this->verifierUrl, array(), http_build_query($data));
        $content = $result->getContent();
        return json_decode($content);
    }


    public function supports(TokenInterface $token)
    {
        return $token instanceof PersonaUserToken;
    }

    protected function createAuthenticatedToken($uid)
    {
        if (null === $this->userProvider) {
            return new PersonaUserToken($uid, array('ROLE_PERSONA_USER'));
        }

        try
        {
            $user = $this->userProvider->loadUserByUsername($uid->email);
        }   catch (UsernameNotFoundException $ex) {
            if (!$this->createUserIfNotExists) {
                throw $ex;
            }
            $user = $this->userProvider->createUserFromAccessToken($uid);
        }

        if (!$user instanceof UserInterface) {
            throw new \RuntimeException('User provider did not return an implementation of user interface.');
        }

        return new PersonaUserToken($user, $user->getRoles());
    }
}

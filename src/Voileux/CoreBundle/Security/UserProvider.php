<?php
/**
 * UserProvider.php
 *
 * Created By: jonathan
 * Date: 5/5/13
 * Time: 1:54 AM
 */

namespace Voileux\CoreBundle\Security;

use Voileux\CoreBundle\Entity\UserManager;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use BG\PersonaBundle\Services\BasePersona;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserProvider extends UserManager implements UserProviderInterface{

    protected $userManager;
    protected $validator;
    protected $session;
    protected $persona;

    public function __construct(BasePersona $persona, $userManager, $validator, SessionInterface $session)
    {
        $this->persona = $persona;
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->session = $session;
    }

    // main auth entry point, load user on exist, create user on non-existance
    public function loadUserByUsername($p_persona_email)
    {
        $user = $this->findUserByPersonaId($p_persona_email);
        $t_persona_email = $this->session->get('persona_email');
        $t_persona_status = $this->session->get('persona_status');
        $t_persona_expires = $this->session->get('persona_expires');

        // compare persona expires microtimestamp with current one ...
        if (($t_persona_status==='okay')&&($t_persona_expires>=round((microtime(true) * 1000))))
        {
            if (empty($user))
            {
                $user = $this->userManager->createUser();
                $user->setEnabled(true);
                $user->setPassword('');
            }

            $user->setPersonaId($t_persona_email);
            $user->setPersonaLastStatus($t_persona_status);
            $user->addRole('ROLE_PERSONA_USER');
            $user->setPersonaExpires($t_persona_expires);
            $this->userManager->updateUser($user);

            // kill old persona session stack
            $this->session->set('persona_email', null);
            $this->session->set('persona_expires', null);
            $this->session->set('persona_status', null);
        }

        if (empty($user)) {
            throw new UsernameNotFoundException('The user is not authenticated on persona');
        }

        return $user;
    }

    public function findUserByPersonaId($personaEmail)
    {
        return $this->userManager->findUserBy(array('persona_email' => $personaEmail));
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user)) || !$user->getPersonaEmail()) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getPersonaEmail());
    }

    public function supportsClass($class)
    {
        return true;
        return $this->userManager->supportsClass($class);
    }
}
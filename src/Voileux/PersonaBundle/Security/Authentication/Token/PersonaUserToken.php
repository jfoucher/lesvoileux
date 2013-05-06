<?php
/**
 * PersonaToken.php
 *
 * Created By: jonathan
 * Date: 5/5/13
 * Time: 11:42 PM
 */

namespace Voileux\PersonaBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\User\UserInterface;

class PersonaUserToken extends AbstractToken{

    private $assertion;

    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials()
    {
        return '';
    }


    public function setAssertion($assertion)
    {
        $this->assertion = $assertion;
    }

    public function getAssertion()
    {
        return $this->assertion;
    }


}
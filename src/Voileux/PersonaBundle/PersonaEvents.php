<?php
namespace Voileux\PersonaBundle;

final class PersonaEvents
{
    /**
     * The persona.loginr event is thrown each time user logs in
     *
     * The event listener receives an
     * Voilaux\PersonaBundle\Event\PersonaLoginEvent instance.
     *
     * @var string
     */
    const PERSONA_LOGIN = 'persona.login';
    /**
     * The persona.register event is thrown each time user registers in
     *
     * The event listener receives an
     * Voilaux\PersonaBundle\Event\PersonaRegisterEvent instance.
     *
     * @var string
     */
    const PERSONA_REGISTER = 'persona.register';
}
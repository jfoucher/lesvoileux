<?php
namespace Voileux\CoreBundle\EventSubscriber;

use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Voileux\PersonaBundle\PersonaEvents;
use Voileux\PersonaBundle\Event\PersonaRegisterEvent;

use Swift_Mailer;
use Swift_Message;
use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\TranslationBundle\Annotation\Desc;
use Symfony\Component\Translation\Translator;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class EmailSubscriber implements EventSubscriberInterface
{

    protected $mailer;
    protected $container;
    protected $translator;

    public function __construct(Swift_Mailer $mailer, ContainerInterface $container, Translator $translator)
    {
        $this->mailer = $mailer;
        $this->container = $container;
        $this->translator = $translator;
    }



    public function onUserRegistered(PersonaRegisterEvent $event)
    {
        $user = $event->getUser();
        $message = new Swift_Message();
        $message->setFrom('info@lesvoileux.com', 'Les Voileux');
        $message->setTo($user->getEmail());
        $message->setSubject($this->translator->trans('Merci de votre inscription'));
        $message->setBody('Merci de vous être inscrit sur lesvoileux.com. nous serons rapidement en contact avec vous pour ajouter votre voilier à notre base de données.', 'text/html; charset=utf-8');

        $sent = $this->mailer->send($message);

        $message = new Swift_Message();
        $message->setFrom('info@lesvoileux.com', 'Les Voileux');
        $message->setTo('info@lesvoileux.com', 'Les Voileux');
        $message->setSubject($this->translator->trans('Nouveau propriétaire inscrit'));
        $message->setBody('Une nouvelle personne est inscrite : '.$user->getEmail(), 'text/html; charset=utf-8');

        $sent = $this->mailer->send($message);
        return $sent;

    }

    static public function getSubscribedEvents()
    {

        return array(
            PersonaEvents::PERSONA_REGISTER => array('onUserRegistered', 0),
        );
    }
}

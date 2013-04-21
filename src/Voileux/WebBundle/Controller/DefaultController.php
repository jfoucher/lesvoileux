<?php

namespace Voileux\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Voileux\CoreBundle\Entity\Boat;
use JMS\TranslationBundle\Annotation\Desc;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="root")
     * @Template(engine="haml")
     */
    public function indexAction()
    {
        $boatManager = $this->get('voileux.core.boat.manager');
        $boats = $boatManager->findByPosition(Boat::BOAT_POSITION_HOME);
        return $this->getGeneralData() + array(
            'boats' => $boats,

        );
    }

    /**
     * @Route("/faq", name="faq")
     * @Template(engine="haml")
     */
    public function faqAction()
    {
        return $this->getGeneralData();
    }

    /**
     * @Route("/{slug}", name="boat")
     * @Template(engine="haml")
     */
    public function boatAction($slug)
    {
        /**
         * @var \Voileux\CoreBundle\Entity\BoatManager $boatManager
         */
        $boatManager = $this->get('voileux.core.boat.manager');
        $translator = $this->get('translator');
        $boat = $boatManager->findOneBy(array('slug' => $slug));
        /** @Desc("Location voilier %name% à %city%, %country%") */
        $title = $translator->trans('voileux.single.boat.title', array(
            '%name%' => $boat->getName(),
            '%city%' => $boat->getCity(),
            '%country%' => $boat->getCountry(),
        ));
        return $this->getGeneralData() + array(
            'boat' => $boat,
            'title' => $title,
        );
    }

    protected function getGeneralData()
    {
        $boatManager = $this->get('voileux.core.boat.manager');
        $latestBoats = $boatManager->getLatest(5);
        return array(
            'latestBoats' => $latestBoats,
        );
    }
}

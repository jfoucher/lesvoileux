<?php

namespace Voileux\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Voileux\CoreBundle\Entity\Boat;
use JMS\TranslationBundle\Annotation\Desc;
use Voileux\CoreBundle\Form\SearchType;
use Voileux\CoreBundle\Model\Search;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="root")
     * @Template(engine="haml")
     */
    public function indexAction(Request $request)
    {
        $boatManager = $this->get('voileux.core.boat.manager');
        $boats = $boatManager->findByPosition(Boat::BOAT_POSITION_HOME);
        $search = new Search();
        $form = $this->createForm(new SearchType(), $search, array('csrf_protection' => false));
        return $this->getGeneralData($request) + array(
            'boats' => $boats,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/faq", name="faq")
     * @Template(engine="haml")
     */
    public function faqAction(Request $request)
    {
        return $this->getGeneralData($request);
    }

    /**
     * @Route("/{slug}", name="boat")
     * @Template(engine="haml")
     */
    public function boatAction(Request $request, $slug)
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
        return $this->getGeneralData($request) + array(
            'boat' => $boat,
            'title' => $title,
        );
    }

    protected function getGeneralData(Request $request)
    {
        $boatManager = $this->get('voileux.core.boat.manager');
        $latestBoats = $boatManager->getLatest(5);
        return array(
            'latestBoats' => $latestBoats,
            'locale' => $request->getLocale(),
        );
    }
}

<?php

namespace Voileux\WebBundle\Controller;

use Voileux\WebBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\TranslationBundle\Annotation\Desc;
use Symfony\Component\HttpFoundation\Request;
use Voileux\CoreBundle\Form\SearchType;
use Voileux\CoreBundle\Model\Search;
use Symfony\Component\HttpFoundation\Response;
use Voileux\CoreBundle\Entity\Boat;

class RssController extends Controller
{
    /**
     * @Route("/boats.{_format}", name="boats", defaults={"_format":"rss"})
     * @Template(engine="twig")
     */
    public function boatsAction(Request $request)
    {
        $boatManager = $this->get('voileux.core.boat.manager');
        $boats = $boatManager->findByPosition(Boat::BOAT_POSITION_HOME);

        return $this->getGeneralData($request) + array(
            'boats' => $boats,
        );
    }

}

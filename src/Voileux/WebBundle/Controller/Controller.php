<?php

namespace Voileux\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Voileux\CoreBundle\Entity\Boat;
use JMS\TranslationBundle\Annotation\Desc;
use Voileux\CoreBundle\Form\SearchType;
use Voileux\CoreBundle\Model\Search;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController
{

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

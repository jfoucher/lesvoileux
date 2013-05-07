<?php

namespace Voileux\PersonaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/auth/login")
     */
    public function loginAction(Request $request)
    {
        $data = $request->request->all();
        $user = $this->get('security.context')->getToken()->getUser();
        return new Response($this->get('serializer')->serialize($user, 'json'));
    }
    /**
     * @Route("/auth/logout")
     * @Template()
     */
    public function logoutAction()
    {
        $this->get("request")->getSession()->invalidate();
        $this->get("security.context")->setToken(null);
        return new Response();
    }
}

<?php

namespace Voileux\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\TranslationBundle\Annotation\Desc;
use Symfony\Component\HttpFoundation\Request;
use Voileux\CoreBundle\Form\SearchType;
use Voileux\CoreBundle\Model\Search;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {

        $search = new Search();
        $form = $this->createForm(new SearchType(), $search, array('csrf_protection' => false));

        $data = $this->getData($request);
        $form->bind($data);

        if($form->isValid()){
            $message = \Swift_Message::newInstance()
                ->setSubject('New Boat search on les voileux')
                ->setFrom($this->container->getParameter('voileux.admin.email'))
                ->setReplyTo($search->getEmail())
                ->setTo($this->container->getParameter('voileux.admin.email'))
                ->setBody(
                    $this->renderView(
                        'VoileuxCoreBundle:Email:search.txt.haml',
                        array('search' => $search)
                    )
                )
            ;
            $this->get('mailer')->send($message);

            $w = $this->get('jms_serializer')->serialize($search, 'json');

            return new Response($w, 200, array('Content-type' => 'application/json'));

        } else {
            $r = $this->get('jms_serializer')->serialize($form, 'json');
            return new Response($r, 400, array('Content-type' => 'application/json'));
        }

    }

    protected function getData(Request $request)
    {
        if ('json' === $request->getContentType()) {
            $data = $request->getContent();

            return json_decode($data, true);
        }
    }

}

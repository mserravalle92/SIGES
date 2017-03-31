<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materia = $em->getRepository('ApplicationBundle:Materia')->findOneById(1);

        die(dump($materia->getCurso()->getSeccion()));

        return $this->render('ApplicationBundle:Default:index.html.twig');
    }
}

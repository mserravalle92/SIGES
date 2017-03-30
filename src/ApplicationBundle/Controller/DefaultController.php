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

        $alumno = $em->getRepository('ApplicationBundle:Alumno')->findOneById(1);

        $tutor =$alumno->getTutores()[0];

        //die(dump($tutor->getNombre().", ".$tutor->getApellido()));

        return $this->render('ApplicationBundle:Default:index.html.twig');
    }
}

<?php

namespace AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/default")
     */
    public function indexAction()
    {
        return $this->render('AuthBundle:Default:index.html.twig');
    }
}

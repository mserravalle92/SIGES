<?php

namespace TeachingClassBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TeachingClassBundle\Entity\Materia;

class DefaultController extends Controller
{
    /**
     * @Route("/clase/didactica/{id}", name="clase_didactica_inicio")
     */
    public function indexAction(Materia $materia)
    {

        $em =$this->getDoctrine()->getManager('claseDidactica');

        $clasesDidacticas = $em->getRepository('TeachingClassBundle:ClaseDidactica')->findByMateria($materia);

        $curso = $materia->getCurso();

        $em2 =$this->getDoctrine()->getManager();

        return $this->render('TeachingClassBundle:Default:index.html.twig',
                            ['materia'=> $materia
                            ,'curso'  => $curso
                            ,'clases' => $clasesDidacticas]);
    }
}

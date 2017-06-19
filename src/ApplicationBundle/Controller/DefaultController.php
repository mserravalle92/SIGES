<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $anioActivo = $em->getRepository('ApplicationBundle:CicloLectivo')->findOneByActivo(true);

        $cursosPersona = $this->getUser()->getPersona()->getCursos();

        $cursoActivo = null;

        $dia = $em->getRepository('ApplicationBundle:Dia')->findOneById($this->diaActual());



        foreach ($cursosPersona as $curso){
            if ($curso->getCicloLectivo()->getActivo()){
                $cursoActivo = $curso;
            }
        }

        $examenesCercanos = $this->getExamenesCercanos($cursoActivo);


        $horariosMaterias = $em->getRepository('ApplicationBundle:HorarioDiaMateria')
                               ->findBy(['curso'=>$cursoActivo,
                                         'dia'=>$dia
                                        ]);


        $cantidadAsistencias=$this->getCantidadAsistencias($this->getUser()->getPersona(),$cursoActivo);
        $cantidadInasistencias = $this->getCantidadInasistencias($this->getUser()->getPersona(),$cursoActivo);

        return $this->render('default/index.html.twig',
                                  [
                                      'diasMaterias'=>$horariosMaterias,
                                      'examenesCercanos'=>$examenesCercanos,
                                      'asistencias'=>$cantidadAsistencias,
                                      'inasistencias'=>$cantidadInasistencias,
                                  ]);
    }


    public function diaActual(){

        $datetime = new  \DateTime('now');

        return $datetime->format('w');

    }

    public function getExamenesCercanos($curso){

        $examenes = $curso->getExamenes();

        $examenesCercanos = [];

        $datetime = new  \DateTime('now');

        $mesActual = $datetime->format('m');


        foreach ($examenes as $examen) {

            $datetime = new  \DateTime('now');

            $mesActual = $datetime->format('m');

            $fechaExamen = $examen->getFechaExamen();
            $mesExamen = $fechaExamen->format('m');

            if ($mesExamen == $mesActual or $mesExamen == ($mesActual + 1) ){
                $examenesCercanos[] = $examen;
            }

        }
        return $examenesCercanos;


    }

    public function getCantidadAsistencias($alumno,$curso){
        $em = $this->getDoctrine()->getManager();

        $tipoAsistencia=$em->getRepository('ApplicationBundle:TipoAsistencia')->findOneByValorNumerico(0);


        $asistencias = $em->getRepository('ApplicationBundle:Asistencia')->findBy([
            'alumno'=>$alumno,
            'curso'=>$curso,
            'tipoAsistencia'=>$tipoAsistencia,
        ]);


        $cantidadAsistencias=count($asistencias);

        return $cantidadAsistencias;


    }

    public function getCantidadInasistencias($alumno,$curso){
        $em = $this->getDoctrine()->getManager();

        $asistencias = $em->getRepository('ApplicationBundle:Asistencia')->findBy([
            'alumno'=>$alumno,
            'curso'=>$curso,
        ]);


        $cantidadInasistencias=0;

       foreach ($asistencias as $asistencia){
           $cantidadInasistencias+=$asistencia->getTipoAsistencia()->getValorNumerico();
       }

        return $cantidadInasistencias;
    }
}

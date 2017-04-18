<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use TeachingClassBundle\Entity\Alumno;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder;


class DefaultController extends Controller
{
  /**
  * @ApiDoc(
   *   section="Alumno",
   *   description = "Obtener datos de alumno",
   *   parameters={
   *      {"name"="dni", "dataType"="integer", "required"=true, "description"="DNI del Alumno"},
   *   },
     *  output={"class"="TeachingClassBundle\Entity\Alumno",
     *     "name"="Alumno",
     *     "groups"={"alumno"}
     *
     *
*
*   }
   * )
   * @Route("/alumno")
   * @Method("GET")
    */
    public function getAlumnoAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager('claseDidactica');
      $alumno = $em->getRepository('TeachingClassBundle:Alumno')->findOneBy(['dni'=>$request->get('dni')]);
      $nombre = $alumno->getNombre();
      $serializer = SerializerBuilder::create()->build();
      $jsonContent = $serializer->serialize($alumno, 'json');
        return new Response($jsonContent);
    }
}

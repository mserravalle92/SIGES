<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use TeachingClassBundle\Entity\Alumno;
use TeachingClassBundle\Entity\Anonimo;
use TeachingClassBundle\Entity\ClaseDidactica;

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

    /**
    * @ApiDoc(
     *   section="Sesion",
     *   description = "Genera una Sesión anónima y devuelve el código de acceso",
     *   parameters={
     *      {"name"="password", "dataType"="string", "required"=true, "description"="Password para la sesión anónima"},
     *   },
       *  output={"class"="TeachingClassBundle\Entity\Sesion",
       *     "name"="Sesion",
       *     "groups"={"sesion"}
       *
       *
  *
  *   }
     * )
     * @Route("/sesion/anonima")
     * @Method({"GET","POST"})
     *
      */

      public function crearSesionAnonimaAction(Request $request)
      {

        $entityManager = $this->getDoctrine()->getManager('claseDidactica');


        $password = $request->get('password');

        $anonimo = new Anonimo();
        $anonimo->setPassword($password);

        $entityManager->persist($anonimo);
        $entityManager->flush();

        $this->asignarCodigo($anonimo);

        //$serializer = SerializerBuilder::create()->build();
        //$jsonContent = $serializer->serialize($alumno, 'json');
          return new Response($anonimo->getCodigo());
      }

      /**
      * @ApiDoc(
       *   section="Sesion",
       *   description = "Devuelve true si las credenciales son correctas",
        *
       *   parameters={
       *      {"name"="codigo", "dataType"="string", "required"=true, "description"="Código de acceso único del alumno"},
       *      {"name"="password", "dataType"="string", "required"=true, "description"="Password de la sesión anónima"},
       *   },
         *  output={"class"="TeachingClassBundle\Entity\Sesion",
         *     "name"="Sesion",
         *     "groups"={"sesion"}
         *
         *
    *
    *   }
       * )
       * @Route("/validar/sesion")
       * @Method("GET")
       *
        */
        public function validarCredencialesAction(Request $request)
        {
          $codigo = $request->get('codigo');
          $password = $request->get('password');

          $resultado = $this->validarCredenciales($codigo,$password);

          return new Response(json_encode($resultado));
        }

        /**
        * @ApiDoc(
         *   section="Sesion",
         *   description = "Obtiene la Entidad Anonimo con sus datos",
          *
         *   parameters={
         *      {"name"="codigo", "dataType"="string", "required"=true, "description"="Código de acceso único del alumno"},
         *   },
           *  output={"class"="TeachingClassBundle\Entity\Anonimo",
           *     "name"="Anonimo",
           *     "groups"={"sesion"}
           *
           *
      *
      *   }
         * )
         * @Route("/anonimo")
         * @Method("GET")
         *
          */
          public function obtenerAnonimoAction(Request $request)
          {

            $em = $this->getDoctrine()->getManager('claseDidactica');

            $codigo = $request->get('codigo');

            $anonimo = $em->getRepository('TeachingClassBundle:Anonimo')->findOneByCodigo($codigo);

            $serializer = SerializerBuilder::create()->build();

            $jsonContent = $serializer->serialize($anonimo, 'json');

            return new Response($jsonContent);
          }

          /**
          * @ApiDoc(
           *   section="Clase",
           *   description = "Obtiene la Clase actual en base al código ingresado",
            *
           *   parameters={
           *      {"name"="codigoClase", "dataType"="string", "required"=true, "description"="Código de acceso de la clase"},
           *   },
             *  output={"class"="TeachingClassBundle\Entity\Anonimo",
             *     "name"="Anonimo",
             *     "groups"={"sesion"}
             *
             *
        *
        *   }
           * )
           * @Route("/clase")
           * @Method("GET")
           *
            */
            public function obtenerClaseAction(Request $request)
            {
                $em = $this->getDoctrine()->getManager('claseDidactica');

                $codigo = $request->get('codigoClase');

                $clase = $em->getRepository('TeachingClassBundle:ClaseDidactica')->findOneByClaveAcceso($codigo);

                $clase = array(
                                'id'=> $clase->getId(),
                                'hora' => $clase->getHora(),
                                'fechaAlta' => $clase->getFechaAlta(),
                                'fechaModificacion' => $clase->getFechaModificacion(),
                                'estado' => $clase->getEstado()->getId(),
                                'materia'=> $clase->getMateria()->getId(),
                                'habilitada' =>$clase->getHabilitada(),
                                'claveAcceso' => $clase->getClaveAcceso()
                              );


                return new Response(json_encode($clase));
            }













        /********************************************************
        ******************* FUNCIONES EXTERNAS ******************
        ***********************************************************/

      public function validarCredenciales($codigo,$password)
      {
        $valido = false;

        $em = $this->getDoctrine()->getManager('claseDidactica');

        $anonimo = $em->getRepository('TeachingClassBundle:Anonimo')->findOneByCodigo($codigo);

        if ($anonimo != null) {
          if ( $anonimo->getPassword() == $password ) {
            $valido =true;
          }
        }

        return $valido;
      }

      public function asignarCodigo($anonimo)
      {
        $uuid = $anonimo->getId();

        $uuidArray = explode('-',$uuid);

        $codigo = $uuidArray[0];

        $anonimo->setCodigo($codigo);

        $entityManager = $this->getDoctrine()->getManager('claseDidactica');

        $entityManager->persist($anonimo);

        $entityManager->flush();


      }


}

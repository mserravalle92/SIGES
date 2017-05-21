<?php

namespace TeachingClassBundle\Controller;

use TeachingClassBundle\Entity\Alumno;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use TeachingClassBundle\Entity\Anonimo;
use Symfony\Component\HttpFoundation\Response;
use TeachingClassBundle\Entity\Sesion;
use TeachingClassBundle\Entity\Respuesta;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use JMS\Serializer\SerializerBuilder;

/**
 * Alumno controller.
 *
 * @Route("alumnos")
 */
class AlumnoController extends Controller
{
    /**
     * Lists all alumno entities.
     *
     * @Route("/inicio", name="inicio_alumno")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return $this->render('TeachingClassBundle:alumno:inicio.html.twig');
    }

    /**
     * Lists all alumno entities.
     *
     * @Route("/acceder", name="acceder")
     * @Method("GET")
     */
    public function accederAction(Request $request)
    {
        return $this->render('TeachingClassBundle:alumno:acceder.html.twig');
    }

    /**
     * Lists all alumno entities.
     *
     * @Route("/acceso/{id}", name="acceso_alumno")
     * @Method("GET")
     */
    public function accesoAction(Request $request, Anonimo $anonimo)
    {

      return $this->render('TeachingClassBundle:alumno:acceso.html.twig', ['anonimo'=>$anonimo]);

    }

    /**
     * Lists all alumno entities.
     *
     * @Route("/inicio/sesion", name="inicio_sesion_anonima")
     * @Method("POST")
     */

    public function inicioSesionAnonimaAction(Request $request)
    {
        $codigo = $request->get('codigo');
        $password = $request->get('password');

        if (!$this->validarCredenciales($codigo,$password)) {
          $this->addFlash(
            'error',
            'Las credenciales no son válidas. Vuelva a intentarlo'
          );

          return $this->render('TeachingClassBundle:alumno:acceder.html.twig');

        }
        $em = $this->getDoctrine()->getManager('claseDidactica');

        $anonimo = $em->getRepository('TeachingClassBundle:Anonimo')->findOneByCodigo($codigo);

        return $this->render('TeachingClassBundle:alumno:acceso.html.twig',['anonimo'=>$anonimo]);
    }


    /**
     * Lists all alumno entities.
     *
     * @Route("/proceso/respuestas", name="proceso_respuestas")
     * @Method("POST")
     */
     public function procesoRespuestasAction(Request $request)
     {

       $em = $this->getDoctrine()->getManager('claseDidactica');

       $respuesta = $request->get('respuesta');
       $anonimo = $em->getRepository('TeachingClassBundle:Anonimo')->findOneById($request->get('anonimo'));
       $clase = $em->getRepository('TeachingClassBundle:ClaseDidactica')->findOneById($request->get('clase'));

       $sesion = $this->buscarUltimaSesion($clase);

      try {

        if (is_array($respuesta)) {
          foreach ($respuesta as $resp) {

            $opcionPregunta = $em->getRepository('TeachingClassBundle:OpcionPregunta')->findOneById($resp);

            $nuevaRespuesta = new Respuesta();
            $nuevaRespuesta->setIdOpcionPregunta($opcionPregunta);
            $nuevaRespuesta->setAnonimo($anonimo);
            $nuevaRespuesta->setPregunta($opcionPregunta->getPregunta());
            $nuevaRespuesta->setSesion($sesion);

            $em->persist($nuevaRespuesta);


          }
          $em->flush();
        }
        else {
          $nuevaRespuesta = new Respuesta();
          $opcionPregunta = $em->getRepository('TeachingClassBundle:OpcionPregunta')->findOneById($respuesta);
          $nuevaRespuesta->setAnonimo($anonimo);
          $nuevaRespuesta->setIdOpcionPregunta($opcionPregunta);
          $nuevaRespuesta->setPregunta($opcionPregunta->getPregunta());
          $nuevaRespuesta->setSesion($sesion);
          $em->persist($nuevaRespuesta);
          $em->flush();

        }

        $this->addFlash(
                'ok',
                'Su respuesta ha sido enviada correctamente'

          );

      } catch (Exception $e) {
        $this->addFlash(
                'errorRespuesta',
                'Hubo un error al procesar su respuesta'

          );
      }
      return $this->redirectToRoute('ingreso_alumno',['codigoAcceso'=>$clase->getClaveAcceso(),'anonimo'=>$anonimo->getId()]);




     }






    /**
    * @ApiDoc(
     *   section="Pregunta",
     *   description = "Busca y devuelve la pregunta actual enviada y sus opciones. También verifica si el alumno ya respondió",
      *
     *   parameters={
     *      {"name"="idClase", "dataType"="integer", "required"=true, "description"="Id de la Clase"},
     *      {"name"="anonimo", "dataType"="integer", "required"=true, "description"="Id de la sesión anónima del alumno"},
     *   },
       *  output={"class"="TeachingClassBundle\Entity\Pregunta",
       *     "name"="Pregunta",
       *     "groups"={"sesion"}
       *
       *
  *
  *   })
     * Lists all alumno entities.
     *
     * @Route("/buscar/pregunta", name="buscar_preguntas")
     * @Method("POST")
     */

    public function buscarPreguntasAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager('claseDidactica');

      $clase = $request->get('idClase');

      $sesion = $this->buscarUltimaSesion($clase);

      $pregunta = $sesion->getPregunta();

      $respuestas = $em->getRepository('TeachingClassBundle:Respuesta')->findBy(['pregunta'=>$pregunta,'sesion'=>$sesion]);

      $anonimo = $em->getRepository('TeachingClassBundle:Anonimo')->findOneById($request->get('anonimo'));

      $opciones = $this->obtenerOpcionesPregunta($pregunta);


      if ($this->verificarSiRespondio($respuestas,$anonimo,$sesion)) {
        $arregloDatos = [];
      }else{
        $arregloDatos = [
                          'pregunta' => ['id'=>$pregunta->getId(), 'pregunta'=>$pregunta->getPregunta(), 'tipo' => $pregunta->getTipoPregunta()->getId()],
                          'opciones' => $opciones,
                        ];
      }



      $response = new Response(json_encode(json_encode($arregloDatos)));
      $response->headers->set('Content-Type', 'application/json');

      return $response;

    }

    

     /**
     * @ApiDoc(
      *   section="Respuesta",
      *   description = "Genera la respuesta del alumno, Devuelve OK si está bien o el mensaje de error en caso contrario",
       *
      *   parameters={
      *      {"name"="clase", "dataType"="integer", "required"=true, "description"="Id de la Clase"},
      *      {"name"="anonimo", "dataType"="integer", "required"=true, "description"="Id de la sesión anónima del alumno"},
       *     {"name"="respuesta", "dataType"="integer", "required"=true, "description"="Id de la respuesta del alumno"},
      *   },
        *  output={"class"="TeachingClassBundle\Entity\Respuesta",
        *     "name"="Respuesta",
        *     "groups"={"sesion"}
        *
        *
   *
   *   })
      * Lists all alumno entities.
      *
      * @Route("/procesar/respuesta", name="procesar_respuestas_api")
      * @Method({"POST","GET"})
      */

      public function procesarRespuestasAPIAction(Request $request)
      {

        $em = $this->getDoctrine()->getManager('claseDidactica');

        $respuesta = $request->get('respuesta');
        $anonimo = $em->getRepository('TeachingClassBundle:Anonimo')->findOneById($request->get('anonimo'));
        $clase = $em->getRepository('TeachingClassBundle:ClaseDidactica')->findOneById($request->get('clase'));

        $sesion = $this->buscarUltimaSesion($clase);

        $estado = "OK";

       try {
        if ($anonimo != null) {
         if (is_array($respuesta)) {
           foreach ($respuesta as $resp) {

             $opcionPregunta = $em->getRepository('TeachingClassBundle:OpcionPregunta')->findOneById($resp);

             $nuevaRespuesta = new Respuesta();
             $nuevaRespuesta->setIdOpcionPregunta($opcionPregunta);
             $nuevaRespuesta->setAnonimo($anonimo);
             $nuevaRespuesta->setPregunta($opcionPregunta->getPregunta());
             $nuevaRespuesta->setSesion($sesion);

             $em->persist($nuevaRespuesta);


           }
           $em->flush();
         }
         else {
           $nuevaRespuesta = new Respuesta();
           $opcionPregunta = $em->getRepository('TeachingClassBundle:OpcionPregunta')->findOneById($respuesta);
           $nuevaRespuesta->setAnonimo($anonimo);
           $nuevaRespuesta->setIdOpcionPregunta($opcionPregunta);
           $nuevaRespuesta->setPregunta($opcionPregunta->getPregunta());
           $nuevaRespuesta->setSesion($sesion);
           $em->persist($nuevaRespuesta);
           $em->flush();

         }

         $this->addFlash(
                 'ok',
                 'Su respuesta ha sido enviada correctamente'

           );

         }else{
           $estado ="No existe el alumno con el id: ".$request->get('anonimo');
         }

       } catch (Exception $e) {
         $this->addFlash(
                 'errorRespuesta',
                 'Hubo un error al procesar su respuesta'

           );
           $estado = $e->getMessage();
       }
      return new Response($estado);



      }

    /**
     * Lists all alumno entities.
     *
     * @Route("/generar/acceso", name="acceso_generar")
     * @Method("GET")
     */

    public function generarAccesoAction(){
      return $this->render('TeachingClassBundle:alumno:generarAcceso.html.twig');
    }


    /**
     * Lists all alumno entities.
     *
     * @Route("/generarClave/acceso", name="acceso_generar_clave")
     * @Method("POST")
     */

    public function generarClaveAccesoAction(Request $request)
    {
      $password = $request->get('password');
      $repassword = $request->get('repassword');

      if(!$this->validarPassword($password,$repassword)){
        $this->addFlash(
            'error',
            'Las contraseñas no coinciden o no cumplen con el mínimo de 8 caracteres'
        );
        return $this->render('TeachingClassBundle:alumno:generarAcceso.html.twig');
      }

      $entityManager =$this->getDoctrine()->getManager('claseDidactica');

      $anonimo = new Anonimo();
      $anonimo->setPassword($password);

      $entityManager->persist($anonimo);
      $entityManager->flush();

      $this->asignarCodigo($anonimo);

      $this->addFlash(
          'ok',
          'El acceso se ha generado correctamente'
      );

      return $this->redirectToRoute('acceso_alumno',['id' => $anonimo->getId()]);


    }

    /**
     * Lists all alumno entities.
     *
     * @Route("/clase/acceso", name="ingreso_alumno")
     * @Method({"POST","GET"})
     */
    public function ingresoAction(Request $request)
    {
        $codigo = $request->get('codigoAcceso');

        $em = $this->getDoctrine()->getManager('claseDidactica');

        $anonimo = $em->getRepository('TeachingClassBundle:Anonimo')->findOneById($request->get('anonimo'));

        $clase = $em->getRepository('TeachingClassBundle:ClaseDidactica')->findOneByClaveAcceso($codigo);

        return $this->render('TeachingClassBundle:alumno:clase.html.twig',['clase'=>$clase,'anonimo'=>$anonimo]);
    }


    /**
     * Creates a new alumno entity.
     *
     * @Route("/new", name="alumnos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alumno = new Alumno();
        $form = $this->createForm('TeachingClassBundle\Form\AlumnoType', $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumno);
            $em->flush();

            return $this->redirectToRoute('alumnos_show', array('id' => $alumno->getId()));
        }

        return $this->render('alumno/new.html.twig', array(
            'alumno' => $alumno,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a alumno entity.
     *
     * @Route("/{id}", name="alumnos_show")
     * @Method("GET")
     */
  /*  public function showAction(Alumno $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);

        return $this->render('alumno/show.html.twig', array(
            'alumno' => $alumno,
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    /**
     * Displays a form to edit an existing alumno entity.
     *
     * @Route("/{id}/edit", name="alumnos_edit")
     * @Method({"GET", "POST"})
     */
  /*  public function editAction(Request $request, Alumno $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);
        $editForm = $this->createForm('TeachingClassBundle\Form\AlumnoType', $alumno);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alumnos_edit', array('id' => $alumno->getId()));
        }

        return $this->render('alumno/edit.html.twig', array(
            'alumno' => $alumno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    /**
     * Deletes a alumno entity.
     *
     * @Route("/{id}", name="alumnos_delete")
     * @Method("DELETE")
     */
  /*  public function deleteAction(Request $request, Alumno $alumno)
    {
        $form = $this->createDeleteForm($alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alumno);
            $em->flush();
        }

        return $this->redirectToRoute('alumnos_index');
    }*/

    /**
     * Creates a form to delete a alumno entity.
     *
     * @param Alumno $alumno The alumno entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
  /*  private function createDeleteForm(Alumno $alumno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnos_delete', array('id' => $alumno->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }*/

    /**************************************************************
    ************** FUNCIONES DE SERVICIOS **************************
    ****************************************************************/

    public function validarPassword($password,$repassword)
    {
      $valido =false;

      if ($password == $repassword) {
        if (strlen($password)>=8) {
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

      $entityManager =$this->getDoctrine()->getManager('claseDidactica');

      $entityManager->persist($anonimo);

      $entityManager->flush();


    }

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

    public function buscarUltimaSesion($clase){

      $em = $this->getDoctrine()->getManager('claseDidactica');

      try {
        $sesion = $em->getRepository('TeachingClassBundle:Sesion')->findOneBy(['estado' =>1,'claseDidactica'=>$clase],['id'=>'DESC']);
        return $sesion;
      } catch (Exception $e) {
        throw $this->createNotFoundException("No se encontró sesión");
      }


    }

    public function obtenerOpcionesPregunta($pregunta)
    {
      $opciones = [];
      $opciones[] = $pregunta->serialize();

      foreach ($pregunta->getOpciones() as $key => $opcion) {
        $opciones["opciones"][] = array($opcion->getId(),$opcion->getOpcion());
      }

      return $opciones;
    }

    public function verificarSiRespondio($respuestas,$anonimo)
    {
      $respondio = false;

      foreach ($respuestas as $respuesta) {
        if ($respuesta->getAnonimo() == $anonimo) {
          $respondio = true;
        }
      }

      return $respondio;
    }
}

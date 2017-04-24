<?php

namespace TeachingClassBundle\Controller;

use TeachingClassBundle\Entity\Pregunta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TeachingClassBundle\Entity\Sesion;
use TeachingClassBundle\Entity\ClaseDidactica;

/**
 * Preguntum controller.
 *
 * @Route("pregunta")
 */
class PreguntaController extends Controller
{
    /**
     * Lists all preguntum entities.
     *
     * @Route("/{id}", name="pregunta_index")
     * @Method("GET")
     */
    public function indexAction(ClaseDidactica $clase)
    {
        $em = $this->getDoctrine()->getManager();

        $preguntas = $clase->getPreguntas();

        return $this->render('TeachingClassBundle:pregunta:index.html.twig', array(
            'preguntas' => $preguntas,
            'clase' => $clase,
        ));
    }

    /**
     * Creates a new preguntum entity.
     *
     * @Route("/crear/nueva/{id}", name="pregunta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,ClaseDidactica $clase)
    {
        $preguntum = new Pregunta();
        $form = $this->createForm('TeachingClassBundle\Form\PreguntaType', $preguntum);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager('claseDidactica');
            $preguntum->setClaseDidactica($clase);
            $em->persist($preguntum);
            $em->flush();

            return $this->redirectToRoute('opciones_new', array('id' => $preguntum->getId()));
        }

        return $this->render('TeachingClassBundle:pregunta:new.html.twig', array(
            'preguntum' => $preguntum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a preguntum entity.
     *
     * @Route("/{id}", name="pregunta_show")
     * @Method("GET")
     */
    public function showAction(Pregunta $preguntum)
    {
        $deleteForm = $this->createDeleteForm($preguntum);

        return $this->render('pregunta/show.html.twig', array(
            'preguntum' => $preguntum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing preguntum entity.
     *
     * @Route("/{id}/edit", name="pregunta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pregunta $preguntum)
    {
        $deleteForm = $this->createDeleteForm($preguntum);
        $editForm = $this->createForm('TeachingClassBundle\Form\PreguntaType', $preguntum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pregunta_edit', array('id' => $preguntum->getId()));
        }

        return $this->render('pregunta/edit.html.twig', array(
            'preguntum' => $preguntum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a preguntum entity.
     *
     * @Route("/{id}", name="pregunta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pregunta $preguntum)
    {
        $form = $this->createDeleteForm($preguntum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($preguntum);
            $em->flush();
        }

        return $this->redirectToRoute('pregunta_index');
    }

    /**
     * Creates a form to delete a preguntum entity.
     *
     * @param Pregunta $preguntum The preguntum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pregunta $preguntum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pregunta_delete', array('id' => $preguntum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Lists all preguntum entities.
     *
     * @Route("/enviar/pregunta", name="enviar_pregunta")
     * @Method("POST")
     */

     public function enviarPreguntaAction(Request $request)
     {
       $em = $this->getDoctrine()->getManager('claseDidactica');
       $id = $request->get('request');
       $pregunta = $em->getRepository('TeachingClassBundle:Pregunta')->findOneById($id);

       $pregunta->setEnvio(1);

       $em->persist($pregunta);
       $em->flush();

       $opciones = $this->obtenerOpcionesPregunta($pregunta);
       $datosSesion = ['pregunta'=>$pregunta , 'clase'=>$pregunta->getClaseDidactica()];

       if (!$this->crearSesion($datosSesion)) {
         throw $this->createNotFoundException('Imposible crear Sesión de preguntas');
       }


        $response = new Response(json_encode(json_encode($opciones)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

     }

     /**
      * Lists all preguntum entities.
      *
      * @Route("/consultar/respuestas", name="consultar_cantidad_respuestas")
      * @Method("POST")
      */

      public function consultarCantidadRespuestasAction(Request $request){

        $em = $this->getDoctrine()->getManager('claseDidactica');

        $pregunta = $em->getRepository('TeachingClassBundle:Pregunta')->findOneById($request->get('id'));

        $sesion = $this->buscarUltimaSesionPregunta($pregunta,$pregunta->getClaseDidactica());

        $cantidadRespuestas = $em->getRepository('TeachingClassBundle:Respuesta')->findBy(['pregunta'=>$pregunta, 'sesion'=>$sesion]);

        return new Response(count($cantidadRespuestas));

      }

      /**
       * Lists all preguntum entities.
       *
       * @Route("/reporte", name="finalizar_sesion")
       * @Method({"GET","POST"})
       */

       public function finalizarSesionAction(Request $request){



          $em = $this->getDoctrine()->getManager('claseDidactica');

          $pregunta = $em->getRepository('TeachingClassBundle:Pregunta')->findOneById($request->get('idPregunta'));

          $clase = $pregunta->getClaseDidactica();

          $sesion = $this->buscarUltimaSesionPregunta($pregunta,$clase);

          $respuestas = $sesion->getRespuestas();

          $respTipos = $this->getTiposRespuestas($sesion);

          $countResp = $this->getRespuestasCorrectas($sesion);

          $sesion->setEstado(0);


          $datos = ['pregunta'=>$pregunta->getPregunta(), 'respuestas' => $respTipos, 'cantRespuestas'=>$countResp];

          $em->persist($sesion);
          $em->flush();



          return $this->render('TeachingClassBundle:clasedidactica:clase.html.twig' , ['clase'=>$clase, 'datos'=>$datos , 'finalizado'=>true]);

       }



      /*******************************************
      ************* FUNCIONES SERVICIOS **********
      *******************************************/

      public function obtenerOpcionesPregunta($pregunta)
      {
        $opciones = [];
        $opciones[] = $pregunta->serialize();

        foreach ($pregunta->getOpciones() as $key => $opcion) {
          $opciones["opciones"][] = array($opcion->getId(),$opcion->getOpcion());
        }

        return $opciones;
      }

      public function crearSesion($datos){

        $em = $this->getDoctrine()->getManager('claseDidactica');

        $sesion = new Sesion();
        $sesion->setPregunta($datos['pregunta']);
        $sesion->setClaseDidactica($datos['clase']);
        $sesion->setEstado(1);

        try{
          $em->persist($sesion);
          $em->flush();

          return true;
        }
        catch(Exception $e){
          return false;
        }

      }

      public function buscarUltimaSesionPregunta($pregunta,$clase){

        $em = $this->getDoctrine()->getManager('claseDidactica');

        try {
          $sesion = $em->getRepository('TeachingClassBundle:Sesion')->findOneBy(['pregunta'=>$pregunta,'estado' =>1,'claseDidactica'=>$clase],['id'=>'DESC']);
          return $sesion;
        } catch (Exception $e) {
          throw $this->createNotFoundException("No se encontró sesión");
        }

      }




      public function getTiposRespuestas($sesion){

        $respuestas = $sesion->getRespuestas();



        $pregunta = $sesion->getPregunta();
        $tiposRespuestas=[];

        foreach ($respuestas as $respuesta) {
          $tiposRespuestas[$respuesta->getIdOpcionPregunta()->getId()][]= [$respuesta->getIdOpcionPregunta()->getOpcion(),$respuesta->getIdOpcionPregunta()->getId()];
        }

        foreach ($tiposRespuestas as $key=> $tipoRespuesta) {
          $tiposRespuestas[$key]['cantidad'] = count($tipoRespuesta);
        }

        return $tiposRespuestas;

      }

      public function getRespuestasCorrectas($sesion){

        $respuestas = $sesion->getRespuestas();

        $correctas = 0;
        $incorrectas = 0;

        foreach ($respuestas as $respuesta) {
          if ($respuesta->getIdOpcionPregunta()->getCorrecta()) {
            $correctas += 1;
          }
          else{
            $incorrectas +=1;
          }
        }

        return array('correctas'=>$correctas,'incorrectas'=>$incorrectas);
      }


}

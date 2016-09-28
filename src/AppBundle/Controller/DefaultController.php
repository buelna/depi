<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\SecurityContext;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    public function backendAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:backendMenu.html.twig');
    }
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:Inicio.html.twig', array('cuerpos'=>$cuerpos));
    }
	public function convocatoriasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        $convocatorias = $em->getRepository('AppBundle:Convocatoria')->findAll();
        $archivos = $em->getRepository('AppBundle:Archivo')->findAll();
        return $this->render('AppBundle:default:Admision.html.twig', array('convocatorias'=>$convocatorias,'archivos'=>$archivos,'cuerpos'=>$cuerpos));
    }
    public function contactoAction()
	{
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:Contacto.html.twig', array('cuerpos'=>$cuerpos));
    }
    public function criteriospnpAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:CriteriosPNP.html.twig', array('cuerpos'=>$cuerpos));
    }
    public function estudiantesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        $alumnos = $em->getRepository('AppBundle:Alumno')->findAll();
	    return $this->render('AppBundle:default:Estudiantes.html.twig', array('alumnos'=>$alumnos,'cuerpos'=>$cuerpos));
    }
    public function docentesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        $docentes = $em->getRepository('AppBundle:Docente')->findAll();
	    return $this->render('AppBundle:default:Docentes.html.twig', array('cuerpos'=>$cuerpos,"docentes" => $docentes));
    }
    public function lineasIIAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:LineasII.html.twig', array('cuerpos'=>$cuerpos));
    }
    public function lineasMEAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:LineasME.html.twig', array('cuerpos'=>$cuerpos));
    }
    public function programaIIAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:ProgramaII.html.twig', array('cuerpos'=>$cuerpos));
    }
    public function programaMEAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        return $this->render('AppBundle:default:ProgramaME.html.twig', array('cuerpos'=>$cuerpos));
    }
    public function publicacionesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuerpos = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://caii.itmexicali.edu.mx/es/caii/json/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $data = (Array)json_decode($response);
        $entities=(Array)$data["entities"];
        $tipos=(Array)$data["tipos"];
        $miembros=(Array)$data["miembros"];
        $publicaciones=(Array)$data["publicaciones"];
        $publicacionesid=(Array)$data["publicacionesid"];
        $p=array();
        $i=0;
        foreach ($entities as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $entities=$p;
        $p=array();
        $i=0;
        foreach ($tipos as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $tipos=$p;
        $p=array();
        $i=0;
        foreach ($miembros as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $miembros=$p;
        $p=array();
        $i=0;
        foreach ($publicaciones as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $publicaciones=$p;
        $p=array();
        $i=0;
        foreach ($publicacionesid as $entity) {
            $p[$i]=(Array)$entity;
            $i++;
        }
        $publicacionesid=$p;
        return $this->render('AppBundle:default:Publicaciones.html.twig', array('cuerpos'=>$cuerpos,"entities"=>$entities,"tipos"=>$tipos,"miembros"=>$miembros,"publicaciones"=>$publicaciones,"publicacionesid"=>$publicacionesid));
    }
    public function loginAction(Request $request)
    {
         $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
 

        return $this->render('AppBundle:default:login.html.twig',
            array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );

    }
    /**
     * Displays a form to create a new Miembro entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method("GET")
     * @Template("AppBundle:Default:nuevoUsuario.html.twig")
     */
    public function newAction(Request $peticion)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        
        $formulario = $this->createForm(new UsuarioType(), $usuario);
        $formulario->handleRequest($peticion);

        if ($formulario->isValid()) {
            $usuario->setSalt(md5(time()));

            $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
            $passwordCodificado = $encoder->encodePassword(
                $usuario->getPassword(),
                $usuario->getSalt()
            );
            $usuario->setPassword($passwordCodificado);

            $em->persist($usuario);
            $em->flush();
            

            $token = new UsernamePasswordToken($usuario, null, 'usuarios', $usuario->getRoles());
            $this->container->get('security.context')->setToken($token);

            return $this->redirect($this->generateUrl('app_backend', array()));
        }
        return $this->render('AppBundle:default:nuevoUsuario.html.twig', array(
            'form' => $formulario->createView()
        ));
    }
}

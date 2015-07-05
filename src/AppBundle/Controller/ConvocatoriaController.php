<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Convocatoria;
use AppBundle\Form\ConvocatoriaType;

/**
 * Convocatoria controller.
 *
 */
class ConvocatoriaController extends Controller
{

    /**
     * Lists all Convocatoria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Convocatoria')->findAll();

        return $this->render('AppBundle:Convocatoria:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Convocatoria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Convocatoria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->upload();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('convocatoria_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Convocatoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
/*So check your php.ini file (/etc/php5/apache2/php.ini on Linux) and increase max_upload_size to fit your field :

upload_max_filesize = 20M
Don't forget to restart apache : apache2ctl restart
*/
    /**
     * Creates a form to create a Convocatoria entity.
     *
     * @param Convocatoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Convocatoria $entity)
    {
        $form = $this->createForm(new ConvocatoriaType(), $entity, array(
            'action' => $this->generateUrl('convocatoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Convocatoria entity.
     *
     */
    public function newAction()
    {
        $entity = new Convocatoria();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Convocatoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Convocatoria entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Convocatoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Convocatoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Convocatoria:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Convocatoria entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Convocatoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Convocatoria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Convocatoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Convocatoria entity.
    *
    * @param Convocatoria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Convocatoria $entity)
    {
        $form = $this->createForm(new ConvocatoriaType(), $entity, array(
            'action' => $this->generateUrl('convocatoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Convocatoria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Convocatoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Convocatoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->upload();
            $em->flush();

            return $this->redirect($this->generateUrl('convocatoria_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Convocatoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Convocatoria entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Convocatoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Convocatoria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('convocatoria'));
    }

    /**
     * Creates a form to delete a Convocatoria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('convocatoria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

<?php

namespace Taller\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Taller\BookBundle\Entity\Book as Book;
use Taller\BookBundle\Form\BookType;

/**
 * Book controller.
 *
 */
class BookController extends Controller
{
    /**
     * Lists all Books entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('Taller\BookBundle\Entity\Book')->findAll();
        return $this->render(
                'BookBundle:Book:index.html.twig',
                array(
                    'entities' => $entities
                )
        );
    }

    /**
     * Display a form to create a new Book entity.
     *
     */
    public function addAction(){
        $entity = new Book();
        $form = $this->createForm(new BookType(), $entity);

        return $this->render('BookBundle:Book:add.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a Book entity.
     *
     */
    public function showAction($id)
    {
    }

    /**
     * Displays a form to edit an existing Book entity.
     *
     */
    public function editAction($id)
    {
    }

    /**
     * Creates a new Book entity.
     *
     */
    public function createAction()
    {
        $request = $this->getRequest();

        $entity = new Book();
        $form = $this->createForm(new BookType(), $entity);

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('book_index'));
        }else{
            return $this->render('BookBundle:Book:add.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView()
            ));
        }
    }

    /**
     * Edit an existing Book entity.
     *
     */
    public function updateAction($id)
    {
    }

    /**
     * Delete a Book entity.
     *
     */
    public function deleteAction($id)
    {
    }
}

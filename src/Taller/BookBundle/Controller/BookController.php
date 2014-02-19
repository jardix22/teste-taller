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
        $books = $em->getRepository('Taller\BookBundle\Entity\Book')->findAll();
        return $this->render(
                'BookBundle:Book:index.html.twig',
                array(
                    'books' => $books
                )
        );
    }

    /**
     * Display a form to create a new Book entity.
     *
     */
    public function addAction(){
        $book = new Book();
        $form = $this->createForm(new BookType(), $book);

        return $this->render('BookBundle:Book:add.html.twig', array(
            'book' => $book,
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

        $book = new Book();
        $form = $this->createForm(new BookType(), $book);

        $form->bind($request);

        if ($form->isValid()) {

            // Copy the image uploaded and save the directory path
            $book->loadImage($this->container->getParameter('taller.directory.images'));

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($book);
            $em->flush();

            return $this->redirect($this->generateUrl('book_index'));
        }else{
            return $this->render('BookBundle:Book:add.html.twig', array(
                'book' => $book,
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

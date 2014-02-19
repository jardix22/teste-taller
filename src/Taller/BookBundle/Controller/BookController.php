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
        $em = $this->getDoctrine()->getManager();

        $book = $em->getRepository('BookBundle:Book')->find($id);

        if (!$book) {
            throw $this->createNotFoundException('the Book does not exist.');
        }

        $editForm = $this->createForm(new BookType(), $book);
        //$deleteForm = $this->createDeleteForm($id);

        return $this->render('BookBundle:Book:edit.html.twig', array(
            'book' => $book,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView()
        ));
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
        $em = $this->getDoctrine()->getManager();

        $book = $em->getRepository('BookBundle:Book')->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Book doest not exist.');
        }

        $editForm = $this->createForm(new BookType(), $book);
        //$deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        // Save the path directory of the original image
        $pathOriginalImage = $editForm->getData()->getImage();

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if (null == $book->getImage()) {
                // the user don't change the original image
                $book->setImage($pathOriginalImage);
            } else {
                // the user changed the image: copy the upload image and save the new path directory
                $book->loadImage($this->container->getParameter('taller.directory.images'));

                // remove the old image
                if (!empty($pathOriginalImage)) {
                    $fs = new Filesystem();
                    $fs->remove($this->container->getParameter('taller.directory.images').$pathOriginalImage);
                }
            }
            $em->persist($book);
            $em->flush();

            return $this->redirect($this->generateUrl('book_edit', array('id' => $id)));
        }

        return $this->render('BookBundle:Book:edit.html.twig', array(
            'book' => $book,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Delete a Book entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $book = $em->getRepository('BookBundle:Book')->find($id);

            if (!$book) {
                throw $this->createNotFoundException("the Book does not exist.");
            }
            $em->remove($book);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('book_index'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
        ;
    }
}

<?php

namespace Taller\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Taller\BookBundle\Entity\Book as Book;
use Taller\BookBundle\Form\BookType;
use Doctrine\ORM\EntityRepository;

/**
 * Order controller.
 *
 */
class OrderController extends Controller
{
    /**
     * Lists all Books entities that title inilitalize with the $letter.
     *
     */
    public function titleAction($letter)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT p
            FROM BookBundle:Book p
            WHERE p.title like :letter'
        )->setParameter('letter', $letter.'%');

        $books = $query->getResult();

        return $this->render(
            'BookBundle:Order:index.html.twig', array(
                'letter_title' => $letter,
                'books' => $books
            )
        );
    }
}

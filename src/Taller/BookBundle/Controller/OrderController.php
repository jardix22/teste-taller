<?php

namespace Taller\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Taller\BookBundle\Entity\Book as Book;
use Taller\BookBundle\Form\BookType;
use Doctrine\ORM\EntityRepository;
//use Symfony\Component\Serializer\Exception;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
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
        // validate if $letter is an alphabetic character
        if (!preg_match("/^[a-z]{1}$/",$letter)) {
            throw $this->createNotFoundException('The term is invalid.');
        }

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

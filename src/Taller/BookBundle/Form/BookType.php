<?php

namespace Taller\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('summary')
            ->add('edition_date', 'birthday')
        ;
    }

    public function getName()
    {
        return 'taller_bookbundle_booktype';
    }
}

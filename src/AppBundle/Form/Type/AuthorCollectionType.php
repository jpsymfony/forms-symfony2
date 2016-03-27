<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorCollectionType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'entry_type' => 'appbundle_author',
                'allow_add' => true,
                'allow_delete' => true,
                'max_limit' => 2,
                'by_reference' => false,
                'prototype' => true,

            )
        );
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // pour le passer au template et s'en servir dans la vue twig
        $view->vars['max_limit'] = $options['max_limit'];
    }

    public function getParent()
    {
        return 'collection';
    }
    
    public function getName()
    {
        return 'authors';
    }
}
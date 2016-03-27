<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileCollectionType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'type' => 'appbundle_file',
                'allow_add' => true,
                'allow_delete' => true,
            )
        );
    }

    public function getParent()
    {
        return 'collection';
    }
    
    public function getName()
    {
        return 'files';
    }
}
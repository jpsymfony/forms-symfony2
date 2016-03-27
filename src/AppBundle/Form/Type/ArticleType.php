<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\ArrayToDelimitedStringDataTransformer;
use AppBundle\Form\DataTransformer\TextToDateTimeDataTransformer;
use AppBundle\Entity\Article;
use AppBundle\Entity\File;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add(
                $builder->create(
                    'tags', 'choice',
                    array(
                    'choices' => array(
                        'tag1' => 'tag 1',
                        'tag2' => 'tag 2',
                        'tag3' => 'tag 3',
                        'tag4' => 'tag 4'
                    ),
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'empty_value' => false
                    )
                )
                ->addModelTransformer(new ArrayToDelimitedStringDataTransformer())
            )
            ->add(
                $builder->create(
                    'publicationDate', 'text',
                    array(
                    'attr' => array('class' => 'datepicker')
                    )
                )
                ->addModelTransformer(new TextToDateTimeDataTransformer())
            )
            ->add('files', 'files')
            ->add('authors', 'authors')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
            $article = $event->getData();
            if (!$article instanceof Article) {
                return;
            }

            $nbFiles = count($article->getFiles());
            $max     = Article::FILES_LIMIT - $nbFiles;

            for ($i = $nbFiles; $i < $max; $i++) {
                $article->addFile(new File());
            }
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_article';
    }
}
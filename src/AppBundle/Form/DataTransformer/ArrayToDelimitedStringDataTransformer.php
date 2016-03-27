<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ArrayToDelimitedStringDataTransformer implements DataTransformerInterface
{
    // quand info revient de l'extérieur (base de données, url, fichier texte, etc.), à l'affichage du formulaire lors d'un edit
    public function transform($string)
    {
        if (null !== $string && !is_string($string)) {
            throw new TransformationFailedException('Expected a string.');
        }
        $string = trim($string);

        if (empty($string)) {
            return array();
        }

        $values = explode(',', $string);
        if (0 === count($values)) {
            return array();
        }

        foreach ($values as &$value) {
            $value = trim($value);
        }

        return $values;
    }

    // quand le formulaire est soumis
    public function reverseTransform($array)
    {
        if (null === $array) {
            return '';
        }

        if (!is_array($array)) {
            throw new TransformationFailedException('Expected an array.');
        }

        $string = trim(implode(',', $array));

        return $string;
    }
}
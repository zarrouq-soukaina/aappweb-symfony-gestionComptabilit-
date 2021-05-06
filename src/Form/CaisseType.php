<?php

namespace App\Form;

use App\Entity\Caisse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaisseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Montant')
            ->add('dateModif')
            ->add('Motif')
            ->add('sortiecheques')
            ->add('paiementvente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caisse::class,
        ]);
    }
}

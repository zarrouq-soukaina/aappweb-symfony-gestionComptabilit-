<?php

namespace App\Form;

use App\Entity\Commandeachat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeachatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('dateAchat')
            ->add('refFacture')
            ->add('total')
            ->add('tva')
            ->add('fournisseurs')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commandeachat::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Commandevente;
use App\Entity\Client;
use App\Form\CommandeventeProduitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
class CommandeventeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DateVente')
            ->add('Clients', EntityType::class , array(
                'class' => Client::class ,
                'placeholder' =>'Client'
            ))
            ->add('commandeventeProduits', CollectionType::class,array(
                'label' =>true,
                'entry_type' =>CommandeventeProduitType::class, 
                'allow_add' =>true,
                'allow_delete' =>true,
                'by_reference' => false
            )
            )
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commandevente::class,
        ]);
    }
}

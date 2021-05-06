<?php

namespace App\Form;

use App\Entity\CommandeventeProduit;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
class CommandeventeProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('QteCom', IntegerType::class )
            
            ->add('produit', EntityType::class , array(
                'class' => Produit::class ,
                'placeholder' =>'Produit'
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeventeProduit::class,
        ]);
    }
}

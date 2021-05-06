<?php

namespace App\Form;

use App\Entity\Depense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('Montant')
            ->add('Motif')
            ->add('DateDepense')
            ->add('modePai', ChoiceType::class, [
                'choices'  => [
                    'Chèque' => 'Chèque',
                    'espèces' => 'espèces',
                    
                ],
            ])
            ->add('achats')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Depense::class,
        ]);
    }
}

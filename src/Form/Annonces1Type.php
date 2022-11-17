<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class Annonces1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('region')     
            ->add('prix')        
            ->add('type')      
            ->add('email')      
            ->add('categorie', ChoiceType::class, [
                'choices'  => [
                    'A Vendre'=>'a vendre' ,
                    'A louer'=>'a louer',
                ],
            ])
         ->add('duree')    
       
         ;  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}

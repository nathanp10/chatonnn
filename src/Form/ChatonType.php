<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Chaton;

use App\Entity\Proprietaires;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChatonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Sterilise')
            ->add('Photo')
            ->add('Categorie', EntityType::class, [
                'class'=>Categorie::class,
                'choice_label'=>"titre",
                'multiple'=>false,
                'expanded'=>false
            ])
            ->add('Proprietaires', EntityType::class, [
                'class'=>Proprietaires::class,
                'choice_label'=>"nom",
                'multiple'=>true,
                'expanded'=>false
            ])

            ->add("ok", SubmitType::class, ["label"=>"OK"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chaton::class,
        ]);
    }
}

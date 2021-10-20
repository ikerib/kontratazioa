<?php

namespace App\Form;

use App\Entity\Kontratista;
use App\Entity\Kontratua;
use App\Entity\Mota;
use App\Entity\Prozedura;
use App\Entity\Saila;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KontratuaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('espedientea')
            ->add('izena_eus')
            ->add('izena_es')

            ->add('espedienteElektronikoa')

            ->add('mota', EntityType::class, [
                'class' => Mota::class,
                'attr' => ['class' => 'form-control select2']
            ])
            ->add('oharrak', CKEditorType::class,[])
            ->add('prozedura', EntityType::class, [
                'class' => Prozedura::class,
                'attr' => ['class' => 'form-control select2']
            ])
            ->add('saila', EntityType::class, [
                'class' => Saila::class,
                'attr' => ['class' => 'form-control select2']
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Kontratua::class,
        ]);
    }
}

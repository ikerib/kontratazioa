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
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('aurrekontuaIva',null,[
                'label_attr' => ['class'=>'col-12 col-sm-12'],
                'attr' => ['class'=>'col-3 col-sm-3']
            ])
            ->add('aurrekontuaIvaGabe',null,[
                'label_attr' => ['class'=>'col-12 col-sm-12'],
                'attr' => ['class'=>'col-3 col-sm-3']
            ])
            ->add('sinadura', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker col-2 col-sm-2'],
            ])
            ->add('iraupena')
            ->add('adjudikazioaIva',null,[
                'label_attr' => ['class'=>'col-12 col-sm-12'],
                'attr' => ['class'=>'col-3 col-sm-3']
            ])
            ->add('adjudikazioaIvaGabe',null,[
                'label_attr' => ['class'=>'col-12 col-sm-12'],
                'attr' => ['class'=>'col-3 col-sm-3']
            ])
            ->add('amaitua')
            ->add('luzapena')
            ->add('oharrak', CKEditorType::class,[

            ])
            ->add('espedienteElektronikoa')
            ->add('mota', EntityType::class, [
                'class' => Mota::class,
                'attr' => ['class' => 'form-control select2']
            ])
            ->add('prozedura', EntityType::class, [
                'class' => Prozedura::class,
                'attr' => ['class' => 'form-control select2']
            ])
            ->add('kontratista', EntityType::class, [
                'class' => Kontratista::class,
                'attr' => ['class' => 'form-control select2']
            ])
            ->add('saila', EntityType::class, [
                'class' => Saila::class,
                'label_attr' => ['class'=>'col-12 col-sm-12'],
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

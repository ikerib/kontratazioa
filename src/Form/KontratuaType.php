<?php

namespace App\Form;

use App\Entity\Kontratua;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KontratuaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('espedientea')
            ->add('izena_eus')
            ->add('izena_es')
            ->add('aurrekontuaIva')
            ->add('aurrekontuaIvaGabe')
            ->add('sinadura')
            ->add('iraupena')
            ->add('adjudikazioaIva')
            ->add('adjudikazioaIvaGabe')
            ->add('amaitua')
            ->add('luzapena')
            ->add('oharrak')
            ->add('espedienteElektronikoa')
            ->add('created')
            ->add('updated')
            ->add('mota')
            ->add('prozedura')
            ->add('kontratista')
            ->add('saila')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Kontratua::class,
        ]);
    }
}

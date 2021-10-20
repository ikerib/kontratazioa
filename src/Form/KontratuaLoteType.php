<?php

namespace App\Form;

use App\Entity\Kontratista;
use App\Entity\KontratuaLote;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KontratuaLoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Lotea',
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('aurrekontuaIva',null,[
                'label' => 'BEZ',
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('aurrekontuaIvaGabe',null,[
                'label' => 'BEZ gabe',
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('sinadura', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker col-2 col-sm-2'],
            ])
            ->add('iraupena',null,[
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('adjudikazioaIva',null,[
                'label' => 'BEZ',
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('adjudikazioaIvaGabe',null,[
                'label' => 'BEZ gabe',
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('amaitua')
            ->add('luzapena', null,[
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('kontratista', EntityType::class, [
                'class' => Kontratista::class,
                'attr' => ['class' => 'form-control select2'],
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('kontratua',null,[
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => KontratuaLote::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Kontratista;
use App\Entity\KontratuaLote;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
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
            ->add('sinadura', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'datepicker col-2 col-sm-2',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('iraupena',null,[
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('fetxaIraupena', null,[
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'datepicker col-2 col-sm-2 datetimepicker-input',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('prorroga1', null,[
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'datepicker col-2 col-sm-2 datetimepicker-input',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('prorroga2', null,[
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'datepicker col-2 col-sm-2 datetimepicker-input',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('prorroga3', null,[
                'label' => 'Prorroga 3',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'datepicker col-2 col-sm-2 datetimepicker-input',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('aurrekontuaIva',MoneyType::class,[
                'label' => 'BEZ',
                'attr'  => [
                    'autocomplete' => 'off'
                ]

            ])
            ->add('aurrekontuaIvaGabe',MoneyType::class,[
                'label' => 'BEZ gabe',
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('adjudikazioaIva',MoneyType::class,[
                'label' => 'BEZ',
                'attr'  => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('adjudikazioaIvaGabe',MoneyType::class,[
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

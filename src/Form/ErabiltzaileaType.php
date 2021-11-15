<?php

namespace App\Form;

use App\Entity\Erabiltzailea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ErabiltzaileaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('roles')
            ->add('deparment')
            ->add('displayname')
            ->add('dn')
            ->add('enabled')
            ->add('firstname')
            ->add('hizkuntza')
            ->add('lanpostua')
            ->add('ldapsaila')
            ->add('nan')
            ->add('notes')
            ->add('sailburuada')
            ->add('email')
            ->add('surname')
            ->add('ldapTaldeak')
            ->add('ldapRolak')
            ->add('Password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Erabiltzailea::class,
        ]);
    }
}

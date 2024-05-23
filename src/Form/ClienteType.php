<?php

namespace App\Form;

use App\Entity\Ciudad;
use App\Entity\CliTemplate;
use App\Entity\CliTipo;
use App\Entity\Cliente;
use App\Entity\TipoDocIdent;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('documento')
            ->add('razonsocial')
            ->add('email')
            ->add('telefono')
            ->add('direccion')
            ->add('inactivo')
            ->add('eliminar')
            ->add('regimen')
            ->add('dateIn')
            ->add('tipdoc', EntityType::class, [
                'class' => TipoDocIdent::class,
'choice_label' => 'id',
            ])
            ->add('agente', EntityType::class, [
                'class' => Usuario::class,
'choice_label' => 'id',
            ])
            ->add('ciudad', EntityType::class, [
                'class' => Ciudad::class,
'choice_label' => 'id',
            ])
            ->add('template', EntityType::class, [
                'class' => CliTemplate::class,
'choice_label' => 'id',
            ])
            ->add('CliTipo', EntityType::class, [
                'class' => CliTipo::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\CatProceso;
use App\Entity\Cliente;
use App\Entity\ProEstados;
use App\Entity\ProEtiquetas;
use App\Entity\ProTransaccion;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProTransaccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('procesoNombre')
            ->add('fechaInicio')
            ->add('FechaVence')
            ->add('cliente', EntityType::class, [
                'class' => Cliente::class,
'choice_label' => 'id',
            ])
            ->add('proceso', EntityType::class, [
                'class' => CatProceso::class,
'choice_label' => 'id',
            ])
            ->add('etiqueta', EntityType::class, [
                'class' => ProEtiquetas::class,
'choice_label' => 'id',
            ])
            ->add('estado', EntityType::class, [
                'class' => ProEstados::class,
'choice_label' => 'id',
            ])
            ->add('usuario', EntityType::class, [
                'class' => Usuario::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProTransaccion::class,
        ]);
    }
}
